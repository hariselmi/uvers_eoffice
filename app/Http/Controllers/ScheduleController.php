<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\User;
use App\Member;
use Auth;
use App\Helpers\Get_field;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{

    public function __construct(Schedule $schedule)
    {
        $this->middleware('auth');
        $this->schedule = $schedule;
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
                Session::put('schedule_filter', $search);
            } else if( Session::get('schedule_filter')) {
                $search = Session::get('schedule_filter');
            }
            $data['schedules'] = $this->schedule->getAll('paginate', $search);
            return $this->sendCommonResponse($data, null, 'index');
        }
        $data['schedules'] = $this->schedule->getAll('paginate');

        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;

        if ($userRole == 'member') {
            # code...
            $data['auditor'] = User::where('id', $userId)->pluck('name', 'id');

        } else {
            # code...
            $data['auditor'] = User::where('role', 'member')->pluck('name', 'id');
        }


        $data['auditee']    =  User::where('role', 'member')->pluck('name', 'id');
        $data['standards']  = DB::table('standards')->pluck('standard', 'id');
        $data['clocks']     = DB::table('clock')->pluck('nama', 'id');
        $data['periods']    = DB::table('periods')->select(DB::raw('CONCAT(title, " ", semester) AS periode_name'), 'id')->where('dlt', '0')->pluck('periode_name', 'id');      
        $data['parents']    = DB::table('divisions')->where('dlt', '0')->pluck('title', 'id');
        return view('schedule.index', $data);
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
        $schedules = new Schedule;
        $schedules->saveSchedule($input);
        

        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;

        if ($userRole == 'member') {
            # code...
            $data['auditor'] = User::where('id', $userId)->pluck('name', 'id');
            $data['auditorMembers'] = User::where('role', 'member')->pluck('name', 'id');
        } else {
            # code...
            $data['auditor'] = User::where('role', 'member')->pluck('name', 'id');
            $data['auditorMembers'] = User::where('role', 'member')->pluck('name', 'id');
        }
        
        $data['auditee'] =  User::where('role', 'member')->pluck('name', 'id');
        $data['standards'] = DB::table('standards')->pluck('standard', 'id');
        $data['clocks'] = DB::table('clock')->pluck('nama', 'id');
        $data['periods'] = DB::table('periods')->select(DB::raw('CONCAT(title, " ", semester) AS periode_name'), 'id')->where('dlt', '0')->pluck('periode_name', 'id'); 
        $data['parents'] = DB::table('divisions')->where('dlt', '0')->pluck('title', 'id');
        return $this->sendCommonResponse($data, 'You have successfully added schedule', 'add');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {




        //
        $data['scheduleShow']   = Schedule::select('standard_details.standard_details', 'schedules.standard_detail_id', 'schedules.standard_id', 'standards.standard', 'schedules.id as schedule_id', 'schedules.schedule_date', 'schedules.clock_start_id', 'schedules.clock_finish_id', 'schedules.period_id', 'auditor.id as auditor_id', 'auditor.name as auditor_name', 'auditee.id as auditee_id', 'auditee.name as auditee_name', 'schedules.status','schedules.division_id', 'schedules.member_one', 'schedules.member_two')
        ->leftJoin('users as auditor', 'schedules.auditor_id', 'auditor.id')
        ->leftJoin('users as auditee', 'schedules.auditee_id', 'auditee.id')
        ->leftJoin('standard_details', 'schedules.standard_detail_id', 'standard_details.id')
        ->leftJoin('standards', 'schedules.standard_id', 'standards.id')
        ->where([['schedules.id',$id], ['schedules.dlt', '0']])->first();

        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;

        if ($userRole == 'member') {
            # code...
            $data['auditor'] = User::where('id', $userId)->pluck('name', 'id');
            $data['auditorMembers'] = User::where('role', 'member')->pluck('name', 'id');
        } else {
            # code...
            $data['auditor'] = User::where('role', 'member')->pluck('name', 'id');
            $data['auditorMembers'] = User::where('role', 'member')->pluck('name', 'id');
        }

        $data['auditee']    =  User::where('role', 'member')->pluck('name', 'id');
        $data['standards']  = DB::table('standards')->pluck('standard', 'id');
        $data['clocks'] = DB::table('clock')->pluck('nama', 'id');
        $data['periods'] = DB::table('periods')->select(DB::raw('CONCAT(title, " ", semester) AS periode_name'), 'id')->where('dlt', '0')->pluck('periode_name', 'id');   
        $data['standard_details'] = DB::table('standard_details')->where('standard_id', $data['scheduleShow']->standard_id)->pluck('standard_details', 'id');

        $data['members'] = DB::select("SELECT users.id, users.name FROM members 
            JOIN users ON users.id = members.users_id
            WHERE members.auditor_id = '".$data['scheduleShow']->auditor_id."'
            AND members.dlt = '0'");

        




         $data['parents'] = DB::table('divisions')->where('dlt', '0')->pluck('title', 'id');
        return $this->sendCommonResponse($data, null, 'show', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['schedule']   = Schedule::select('schedules.id', 'standard_details.standard_details', 'schedules.standard_detail_id', 'schedules.standard_id', 'standards.standard', 'schedules.id as schedule_id', 'schedules.schedule_date', 'schedules.clock_start_id', 'schedules.clock_finish_id', 'schedules.period_id', 'auditor.id as auditor_id', 'auditor.name as auditor_name', 'auditee.id as auditee_id', 'auditee.name as auditee_name', 'schedules.status', 'schedules.division_id','schedules.member_one','schedules.member_two')
        ->leftJoin('users as auditor', 'schedules.auditor_id', 'auditor.id')
        ->leftJoin('users as auditee', 'schedules.auditee_id', 'auditee.id')
        ->leftJoin('standard_details', 'schedules.standard_detail_id', 'standard_details.id')
        ->leftJoin('standards', 'schedules.standard_id', 'standards.id')
        ->where([['schedules.id',$id], ['schedules.dlt', '0']])->first();

        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;

        if ($userRole == 'member') {
            # code...
            $data['auditor'] = User::where('id', $userId)->pluck('name', 'id');
            $data['auditorMembers'] = User::where('role', 'member')->pluck('name', 'id');
        } else {
            # code...
            $data['auditor'] = User::where('role', 'member')->pluck('name', 'id');
        }


        $auditor = $data['schedule']->auditor;
        $auditee = $data['schedule']->auditee;
        $tanggal = $data['schedule']->tanggal;

        $data['auditee'] =  User::where('role', 'member')->pluck('name', 'id');
        $data['standards'] = DB::table('standards')->pluck('standard', 'id');
        $data['clocks'] = DB::table('clock')->pluck('nama', 'id');
        $data['periods'] = DB::table('periods')->select(DB::raw('CONCAT(title, " ", semester) AS periode_name'), 'id')->where('dlt', '0')->pluck('periode_name', 'id');   
        $data['standard_details'] = DB::table('standard_details')->where('standard_id', $data['schedule']->standard_id)->pluck('standard_details', 'id');
        $data['members']    = DB::table('members')
        ->select('users.id', 'users.name')
        ->leftJoin('users', 'members.users_id', 'users.id')
        ->where('members.auditor_id',$data['schedule']->auditor_id)
        ->pluck('name', 'id');  

        $data['parents'] = DB::table('divisions')->where('dlt', '0')->pluck('title', 'id');
        
        return $this->sendCommonResponse($data, null, 'edit', $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $current_clock_start = Schedule::where([['id', '!=' ,$id],['dlt', '0'], ['clock_start_id',$request->clock_start_id], ['auditor_id',$request->auditor_id], ['auditee_id',$request->auditee_id]])->count();
        $current_clock_finish = Schedule::where([['id', '!=' ,$id],['dlt', '0'], ['clock_finish_id',$request->clock_finish_id], ['auditor_id',$request->auditor_id], ['auditee_id',$request->auditee_id]])->count();


        // dd($current_clock_start);

        if ($current_clock_start > 0 || $current_clock_start > 0) {
            # code...
            return $this->sendCommonResponse([], ['danger'=>__('Jam audit bentrok dengan jadwal lain')]);
        }



        $input = $request->all();
        $this->validator($input)->validate();

        $schedules = (new Schedule())->getById($id);
        $schedules->updateSchedule($input);
        $data['schedule']   = Schedule::select('schedules.id', 'standard_details.standard_details', 'schedules.standard_detail_id', 'schedules.standard_id', 'standards.standard', 'schedules.id as schedule_id', 'schedules.schedule_date', 'schedules.clock_start_id', 'schedules.clock_finish_id', 'schedules.period_id', 'auditor.id as auditor_id', 'auditor.name as auditor_name', 'auditee.id as auditee_id', 'auditee.name as auditee_name', 'schedules.status', 'schedules.division_id','schedules.member_one','schedules.member_two')
        ->leftJoin('users as auditor', 'schedules.auditor_id', 'auditor.id')
        ->leftJoin('users as auditee', 'schedules.auditee_id', 'auditee.id')
        ->leftJoin('standard_details', 'schedules.standard_detail_id', 'standard_details.id')
        ->leftJoin('standards', 'schedules.standard_id', 'standards.id')
        ->where([['schedules.id',$id], ['schedules.dlt', '0']])->first();

        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;

        if ($userRole == 'member') {
            # code...
            $data['auditor'] = User::where('id', $userId)->pluck('name', 'id');
            $data['auditorMembers'] = User::where('role', 'member')->pluck('name', 'id');
        } else {
            # code...
            $data['auditor'] = User::where('role', 'member')->pluck('name', 'id');
            $data['auditorMembers'] = User::where('role', 'member')->pluck('name', 'id');
        }

        $data['auditee'] =  User::where('role', 'member')->pluck('name', 'id');
        $data['standards'] = DB::table('standards')->pluck('standard', 'id');
        $data['clocks'] = DB::table('clock')->pluck('nama', 'id');
         $data['periods'] = DB::table('periods')->select(DB::raw('CONCAT(title, " ", semester) AS periode_name'), 'id')->where('dlt', '0')->pluck('periode_name', 'id');   
        $data['standard_details'] = DB::table('standard_details')->where('standard_id', $data['schedule']->standard_id)->pluck('standard_details', 'id');

        
        $data['members']    = DB::table('members')
        ->select('users.id', 'users.name')
        ->leftJoin('users', 'members.users_id', 'users.id')
        ->where('members.auditor_id',$data['schedule']->auditor_id)
        ->pluck('name', 'id');  

        


         $data['parents'] = DB::table('divisions')->where('dlt', '0')->pluck('title', 'id');
        return $this->sendCommonResponse($data, 'You have successfully updated member', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $schedule = Schedule::find($id);
            $schedule->dlt = '1';
            $schedule->save();

            return $this->sendCommonResponse([], 'You have successfully deleted schedule', 'delete');
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->sendCommonResponse([], ['danger'=>__('Integrity constraint violation: You Cannot delete a parent row')]);
        }
    }

    protected function validator(Array $data)
    {

        if(session('role') == 'auditor'){

        return Validator::make($data, [
            'status'=>'required'
        ]);

        }else{

        return Validator::make($data, [
            'auditor_id'=>'required',
            'auditee_id'=>'required',
            'period_id'=>'required',
            'member_one'=>'required',
            'member_two'=>'required',
            'division_id'=>'required',
            'standard_id'=>'required',
            'standard_detail_id'=>'required',
            'status'=>'required',
        ]);
        }


    }

    private function sendCommonResponse($data=[], $notify = '', $option = null, $id = null) 
    {
        $scheduleObj = new Schedule();
        $response = $this->processNotification($notify);

        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;

        if ($userRole == 'member') {
            # code...
            $data['auditor'] = User::where('id', $userId)->pluck('name', 'id');
            $data['auditorMembers'] = User::where('role', 'member')->pluck('name', 'id');
        } else {
            # code...
            $data['auditor'] = User::where('role', 'member')->pluck('name', 'id');
            $data['auditorMembers'] = User::where('role', 'member')->pluck('name', 'id');
        }

        
        $data['auditee'] =  User::where('role', 'member')->pluck('name', 'id');
        $data['standards'] = DB::table('standards')->pluck('standard', 'id');
        if ($option == 'add') {
            $response['replaceWith']['#addSchedule'] = view('schedule.formadd', $data)->render();
        }  else if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editSchedule'] = view('schedule.formedit', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showSchedule'] = view('schedule.profile', $data)->render();
        }
        if ( in_array($option, ['index', 'edit', 'add', 'update', 'delete', 'import'])) {
            if (empty($data['schedules'])) {
                $data['schedules'] = $scheduleObj->getAll('paginate');
                $data['clocks'] = DB::table('clock')->pluck('nama', 'id');
                $data['periods'] = DB::table('periods')->select(DB::raw('CONCAT(title, " ", semester) AS periode_name'), 'id')->where('dlt', '0')->pluck('periode_name', 'id');   
                $data['parents'] = DB::table('divisions')->where('dlt', '0')->pluck('title', 'id');
            }
            $response['replaceWith']['#scheduleTable'] = view('schedule.table', $data)->render();
        }
        return $this->sendResponse($response);
    }

    public function getStandardDetail($id){
        $standardDetails = DB::table('standard_details')->where('standard_id', $id)->get();
        return $standardDetails;
    }

    public function getclockstart(Request $request){

        $auditor = $request->auditor;
        $auditee = $request->auditee;
        $tanggal = $request->tanggal;


        $clock_used = DB::select("SELECT id, nama, status.clock_used as status from clock c
        left join (
        SELECT  clock_start_id AS clock_used
        FROM    schedules
        WHERE (schedule_date = '$tanggal'  and auditor_id in ('$auditor','$auditee') and dlt = '0') or (schedule_date = '$tanggal'  and auditee_id in ('$auditor','$auditee')  and dlt = '0')
        UNION
        SELECT  clock_finish_id AS clock_used
        FROM    schedules
        WHERE (schedule_date = '$tanggal'  and auditor_id in ('$auditor','$auditee') and dlt = '0') or (schedule_date = '$tanggal'  and auditee_id in ('$auditor','$auditee')  and dlt = '0')
        GROUP BY clock_used
        ORDER BY clock_used ASC
        ) status on c.id=status.clock_used
        ");


        foreach ($clock_used as $key => $value) {
            if ($value->status == null) {
                # code...
                $optionclock[] = "<option value='$value->id'>$value->nama</option>";
            } else {
                # code...
                $optionclock[] = "<option value='$value->id' disabled>$value->nama</option>";
            }
            
        }

        $data['clock'] = $optionclock;

        return $data;

    }

        public function getclockstartedit(Request $request){

        $auditor = $request->auditor;
        $auditee = $request->auditee;
        $tanggal = $request->tanggal;
        $scheduleid = $request->scheduleid;
    
        $clock_used = DB::select("SELECT id, nama, status.clock_used as status from clock c
        left join (
        SELECT  clock_start_id AS clock_used
        FROM    schedules
        WHERE (schedule_date = '$tanggal' and auditor_id in ('$auditor','$auditee') and schedules.id != '$scheduleid' and dlt = '0') or (schedule_date = '$tanggal'  and auditee_id in ('$auditor','$auditee')  and schedules.id != '$scheduleid' and dlt = '0')
        UNION
        SELECT  clock_finish_id AS clock_used
        FROM    schedules
        WHERE (schedule_date = '$tanggal' and auditor_id in ('$auditor','$auditee') and schedules.id != '$scheduleid' and dlt = '0') or (schedule_date = '$tanggal'  and auditee_id in ('$auditor','$auditee')  and schedules.id != '$scheduleid' and dlt = '0')
        GROUP BY clock_used
        ORDER BY clock_used ASC
        ) status on c.id=status.clock_used
        ");

        $clock_start_id =  Get_field::get_data($scheduleid, 'schedules', 'clock_start_id');
        $clock_finish_id =  Get_field::get_data($scheduleid, 'schedules', 'clock_finish_id');

        foreach ($clock_used as $key => $value) {
            if ($value->status == null) {
                # code...
                $selected = ($clock_start_id == $value->id) ? 'selected' : '';
                $optionclock[] = "<option value='$value->id' $selected>$value->nama</option>";
            } else {
                # code...
                $optionclock[] = "<option value='$value->id' disabled>$value->nama</option>";
            }
            
        }

        foreach ($clock_used as $key => $value) {
            if ($value->status == null) {
                # code...
                $selected = ($clock_finish_id == $value->id) ? 'selected' : '';
                $optionclock2[] = "<option value='$value->id' $selected>$value->nama</option>";
            } else {
                # code...
                $optionclock2[] = "<option value='$value->id' disabled>$value->nama</option>";
            }
            
        }

        $data['clock'] = $optionclock;
        $data['clock2'] = $optionclock2;

        return $data;

    }


}
