<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Pegawai;
use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use Illuminate\Support\Facades\Input;
use \Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use \Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;


class EmployeeController extends Controller
{

    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $data['roles'] = Role::all();
        $data['user'] = Auth::user();
        if ($request->ajax()) {
            $search = [];
            if(!empty($request->filter)) {
                $search = $request->filter;
                Session::put('employee_filter', $search);
            } else if( Session::get('employee_filter')) {
                $search = Session::get('employee_filter');
            }
            $data['employees'] = $this->user->getAll('paginate', $search);
            return $this->sendCommonResponse($data, null, 'index');
        }
        $data['employees'] = $this->user->getAll('paginate');


        $data['pegawai'] = DB::table('pegawai')
            ->select('nama','id')
             ->where('softdelete', '0')
             ->pluck('nama', 'id');



        
        return view('employee.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
            return view('employee.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users',
            'name'=>'required',
            'pegawai_id'=>'required',
            'password'=>'required|min:6',
            'password_confirmation'=>'required|same:password',
            'role' => 'required'
        ]);
        // store
        $user = new User;
        $user->name = $request->name;
        $user->pegawai_id = $request->pegawai_id;
        $user->email = $request->email;
        $user->role = $request->role[0];
        $user->password = Hash::make($request->password);
        $user->save();
        $this->assignRoles($user, $request->role);
        
        $data['roles'] = Role::all();

        //update pegawai
        $updatePegawai = Pegawai::find($request->pegawai_id);
        $updatePegawai->status = '1';
        $updatePegawai->save();

        $data['pegawai'] = DB::table('pegawai')
            ->select('nama','id')
             ->where('softdelete', '0')
             ->where('status', '0')
             ->pluck('nama', 'id');



    
        return $this->sendCommonResponse($data, __('You have successfully added employee'), 'add');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $data['employee'] = User::find($id);
        $data['roles'] = Role::all();
        $data['pegawai'] = DB::table('pegawai')
            ->select('nama','id')
             ->where('softdelete', '0')
             ->pluck('nama', 'id');
        
        return $this->sendCommonResponse($data, null, 'edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function userEdit($id)
    {
        $data['employee'] = User::find($id);
        $data['roles'] = Role::all();

        $data['pegawai'] = DB::table('pegawai')
            ->select('nama','id')
             ->where('softdelete', '0')
             ->pluck('nama', 'id');

        return $this->sendCommonResponse($data, null, 'userEdit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

           
            $rules = array(
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id .'',
            'pegawai_id' => 'required|unique:users,pegawai_id,' . $id .'',
            'password' => 'nullable|min:6|max:30|confirmed',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {

                 return Redirect::to('employees/' . $id . '/edit')
                ->withErrors($validator);
            } else {
                $user = User::find($id);
                $user->name = $request->name;
                $user->pegawai_id = $request->pegawai_id;
                $user->email = $request->email;
                $user->role = $request->role[0];
                if (!empty($request->password)) {
                    $user->password = Hash::make($request->password);
                }
                $user->save();

                $this->assignRoles($user, $request->role);
                $data['roles'] = Role::all();
                $data['employee'] = $user;

        $data['pegawai'] = DB::table('pegawai')
            ->select('nama','id')
             ->where('softdelete', '0')
             ->pluck('nama', 'id');
                return $this->sendCommonResponse($data, __('You have successfully updated employee'), 'update');
            }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function userUpdate(Request $request, $id)
    {
        if ($id == 1) {
            // Session::flash('message', 'You cannot edit admin on Lembaga Penjamin Mutu | Universitas Universal');
            // Session::flash('alert-class', 'alert-danger');
            //     return Redirect::to('employees');
            return $this->sendCommonResponse([], ['danger'=>__('You cannot edit super admin')]);    
        } else {
            $rules = array(
            'password' => 'nullable|min:6|max:30|confirmed',
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                 return Redirect::to('userEdit/' . $id)
                ->withErrors($validator);
            } else {
                $user = User::find($id);
                if (!empty($request->password)) {
                    $user->password = Hash::make($request->password);
                }
                $user->save();
                $data['roles'] = Role::all();
                $data['employee'] = $user;

                        $data['pegawai'] = DB::table('pegawai')
            ->select('nama','id')
             ->where('softdelete', '0')
             ->pluck('nama', 'id');

                return $this->sendCommonResponse($data, __('Berhasil memperbarui data'), 'userUpdate');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if ($id == 1) {;
            return $this->sendCommonResponse([], ['danger'=>__('You cannot delete super admin')]);
        } else {
            try {
                $users = User::find($id);
                $users->delete();
                return $this->sendCommonResponse([], __('You have successfully deleted employee'), 'delete');
            } catch (\Illuminate\Database\QueryException $e) {
                return $this->sendCommonResponse([], ['danger'=>__('Integrity constraint violation: You Cannot delete a parent row')]);
            }
        }
    }

    public function assignRoles($user, $role)
    {
        if ($user->id == 1) {
            Session::flash('message', 'You can not assign admin role');
            Session::flash('alert-class', 'alert-danger');
            return back();
        }
        $all_past_roles = $user->getRoleNames();

        foreach ($all_past_roles as $value) {
            $user->removeRole($value);
        }
        $user->assignRole($role);
    }

    public function roleCreate(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
        ]);
        Role::create(['name' => Str::slug($request->name)]);
        return $this->sendCommonResponse([], __('Role created successfully!'), 'role-create');
    }

    public function permissionList($role_id = null)
    {
        $roles = Role::pluck('name', 'id');
        $all_permissions = [];
        $permissions = Permission::all();
        foreach ($permissions as $key => $value) {
            $permission_set = '';
            $permission_name = explode(' ', $value->label);
            if ($key == 0) {
                $permission_set = $permission_name[1];
            }
            if (strtolower($permission_set) == strtolower($permission_name[1])) {
                $all_permissions[$permission_set][] = $value;
            } else {
                $permission_set = $permission_name[1];
                $all_permissions[$permission_set][] = $value;
            }
        }
        $role= Role::oldest()->first();
        if (!empty($role_id)) {
            $role = Role::findById($role_id);
        }
        $data = compact('permissions', 'roles', 'role', 'role_id', 'all_permissions');
        if (request()->ajax()) {
            return $this->sendCommonResponse($data, null, 'permission-list');
        }
        return view('employee.permissions', $data);
    }

    public function createPermission(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'label'=>'required',
        ]);
        Permission::create(['label'=>$request->label, 'name' => $request->name]);
        return back();
    }

    public function rolePermissionMapping(Request $request)
    {
        $this->validate($request, [
            'role_id'=>'required',
            'permissions'=>'required',
        ]);
        $role = Role::findById($request->role_id);
        if ($role->name == 'Admin') {
            return $this->sendCommonResponse([], ['danger'=>__('You can not edit admin permissions')]);
        }
        $permissions = $request->permissions;
        
        // Delete all Previous Permissions
        $this->deleteAllPrevPermissions($role->id);
       $all_permissions = Permission::pluck('name', 'id');
        foreach ($permissions as $value) {
            // $permission = Permission::findById($value);
            $role->givePermissionTo($all_permissions[$value]);
        }
        return $this->sendCommonResponse([], __('Permission given to role successfully!'));
    }

    public function deleteAllPrevPermissions($role_id)
    {
        DB::table('role_has_permissions')->where('role_id', $role_id)->delete();
    }

    private function sendCommonResponse($data=[], $notify = '', $option = null) 
    {
        // $customerObj = new Customer();
        $response = $this->processNotification($notify);
        if ($option == 'add') {
            $data['employee'] = [];
            $response['replaceWith']['#addEmployee'] = view('employee.form', $data)->render();
        
        } else if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editEmployee'] = view('employee.form', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showCustomer'] = view('customer.profile', $data)->render();
        }  else if ($option == 'permission-list') {
            $response['replaceWith']['#permissionList'] = view('employee.permission_list', $data)->render();
        } else if ($option == 'userEdit' || $option == 'userUpdate') {
            $response['replaceWith']['#editUser'] = view('employee.form_user', $data)->render();
        }
        if ( $option == 'index' || $option == 'add' || $option == 'update' || $option == 'delete' || $option == 'role-create') {
            if (empty($data['employees'])) {
                $data['employees'] = $this->user->getAll('paginate');
            $data['pegawai'] = DB::table('pegawai')
            ->select('nama','id')
             ->where('softdelete', '0')
             ->pluck('nama', 'id');
            }
            if (empty($data['roles'])) {
                $data['roles'] = Role::all();
            }
            if (empty($data['user'])) {
                $data['user'] = Auth::user();
            }
            $response['replaceWith']['#employeeTable'] = view('employee.table', $data)->render();
        }
        return $this->sendResponse($response);
    }
}
