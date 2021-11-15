<?php

namespace App\Http\Controllers;

use App\Jabatan;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class JabatanController extends Controller
{

    public function __construct(Jabatan $jabatan)
    {
        $this->middleware('auth');
        $this->jabatan = $jabatan;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $search = [];
            if(!empty($request->filter)) {
                $search = $request->filter;
                Session::put('jabatan_filter', $search);
            } else if( Session::get('jabatan_filter')) {
                $search = Session::get('jabatan_filter');
            }
            $data['semua_jabatan'] = $this->jabatan->getAll('paginate', $search);

            return $this->sendCommonResponse($data, null, 'index');
        }

        $data['semua_jabatan'] = $this->jabatan->getAll('paginate');
        return view('jabatan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->all();
        $this->validator($input)->validate();
        $semua_jabatan = new Jabatan;
        $semua_jabatan->SaveJabatan($input);

        $data['semua_jabatan'] = $this->jabatan->getAll('paginate');
        
        return $this->sendCommonResponse($data, 'Data berhasil ditambahkan', 'add');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $data['jabatan'] = Jabatan::find($id);

        return $this->sendCommonResponse($data, null, 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['jabatan'] = Jabatan::find($id);
        return $this->sendCommonResponse($data, null, 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //
        $input = $request->all();
        $this->validator($input)->validate();
        $semua_jabatan = (new Jabatan())->getById($id);
        
        $semua_jabatan->SaveJabatan($input);
        $data['jabatan'] = $semua_jabatan;
        return $this->sendCommonResponse($data, 'Data berhasil diedit', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $jabatan = Jabatan::find($id);
            $jabatan->updated_at = date('Y-m-d H:i:s');
            $jabatan->softdelete = '1';
            $jabatan->save();

            return $this->sendCommonResponse([], 'Data berhasil dihapus', 'delete');
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->sendCommonResponse([], ['danger'=>__('Integrity constraint violation: You Cannot delete a parent row')]);
        }
    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'nama'=>'required|max:185',
        ]);
    }

    private function sendCommonResponse($data=[], $notify = '', $option = null) 
    {
        $jabatanObj = new Jabatan();
        $response = $this->processNotification($notify);
        
        if ($option == 'add') {
            $response['replaceWith']['#addJabatan'] = view('jabatan.formadd', $data)->render();
        } else if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editJabatan'] = view('jabatan.formedit', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showJabatan'] = view('jabatan.profile', $data)->render();
        }
        if ( in_array($option, ['index', 'add', 'update', 'delete', 'import'])) {
            if (empty($data['semua_jabatan'])) {
                $data['semua_jabatan'] = $jabatanObj->getAll('paginate');
            }
            $response['replaceWith']['#JabatanTable'] = view('jabatan.table', $data)->render();
        }
        return $this->sendResponse($response);
    }
}
