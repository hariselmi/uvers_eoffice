<?php

namespace App\Http\Controllers;

use App\Member;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{

    public function __construct(Member $member)
    {
        $this->middleware('auth');
        $this->member = $member;
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
                Session::put('member_filter', $search);
            } else if( Session::get('member_filter')) {
                $search = Session::get('member_filter');
            }
            $data['members'] = $this->member->getAll('paginate', $search);

            return $this->sendCommonResponse($data, null, 'index');
        }

        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;

        if ($userRole != 'admin') {
            # code...
            $data['auditor'] = User::where('id', $userId)->pluck('name', 'id');
            $data['users'] = User::where('role', 'member')->pluck('name', 'id');
        } else {
            # code...
            $data['auditor'] = User::where('role', 'member')->pluck('name', 'id');
            $data['users'] = User::where('role', 'member')->pluck('name', 'id');
        }
        
        $data['members'] = $this->member->getAll('paginate');
        return view('member.index', $data);
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
        $members = new Member;
        $members->saveMember($input);
        
        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;

        if ($userRole == 'member') {
            # code...
            $data['auditor'] = User::where('id', $userId)->pluck('name', 'id');
            $data['users'] = DB::table('users')->where('role', 'member')->pluck('name', 'id');
        } else {
            # code...
            $data['auditor'] = User::where('role', 'member')->pluck('name', 'id');
            $data['users'] = DB::table('users')->where('role', 'member')->pluck('name', 'id');
        }
        return $this->sendCommonResponse($data, 'You have successfully added member', 'add');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $data['member'] = Member::find($id);
        return $this->sendCommonResponse($data, null, 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['member'] = Member::find($id);



        $data['auditor'] = User::where('role', 'member')->pluck('name', 'id');


        $data['users'] = User::where('role', 'member')
                ->where('id', '!=', $data['member']->auditor_id)
                ->whereNotIn('id', DB::table('members')->select('users_id')->where('dlt','0')->where('users_id','!=',$data['member']->users_id)) 
                ->pluck('name', 'id');

        return $this->sendCommonResponse($data, null, 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        //
        $input = $request->all();
        $this->validator($input)->validate();
        $members = (new Member())->getById($id);
        
        $members->saveMember($input);
        $data['member'] = $members;
        return $this->sendCommonResponse($data, 'You have successfully updated member', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $member = Member::find($id);
            $member->dlt = '1';
            $member->save();

            return $this->sendCommonResponse([], 'You have successfully deleted member', 'delete');
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->sendCommonResponse([], ['danger'=>__('Integrity constraint violation: You Cannot delete a parent row')]);
        }
    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'auditor_id'=>'required',
            'users_id'=>'required',
        ]);
    }

    private function sendCommonResponse($data=[], $notify = '', $option = null) 
    {
        $memberObj = new Member();
        $response = $this->processNotification($notify);
        
        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;

        
        if ($option == 'add') {
            $response['replaceWith']['#addMember'] = view('member.formadd', $data)->render();
        } else if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editMember'] = view('member.formedit', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showMember'] = view('member.profile', $data)->render();
        }
        if ( in_array($option, ['index', 'add', 'update', 'delete', 'import'])) {
            if (empty($data['members'])) {
                $data['members'] = $memberObj->getAll('paginate');
            }
            $response['replaceWith']['#memberTable'] = view('member.table', $data)->render();
        }
        return $this->sendResponse($response);
    }

    public function getMember($id){


        $members = DB::select("SELECT users.id, users.name FROM members 
            JOIN users ON users.id = members.users_id
            WHERE members.auditor_id = '$id'
            AND members.dlt = '0'");

        return $members;
    }

    public function getMembers($id){

        $members = DB::select("SELECT id, name from users WHERE id != '$id' AND id NOT IN (SELECT users_id FROM members WHERE dlt = '0' and auditor_id='$id')  AND role = 'member'");


        return $members;

    }
}
