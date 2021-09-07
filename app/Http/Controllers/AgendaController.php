<?php

namespace App\Http\Controllers;

use App\Agenda;
use App\Schedule;
use App\User;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class AgendaController extends Controller
{
    public function __construct(Agenda $agenda)
    {
        $this->middleware('auth');
        $this->agenda = $agenda;
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
                Session::put('agenda_filter', $search);
            } else if( Session::get('agenda_filter')) {
                $search = Session::get('agenda_filter');
            }
            $data['agendas'] = $this->agenda->getAll('paginate', $search);
            return $this->sendCommonResponse($data, null, 'index');
        }
        $data['agendas'] = $this->agenda->getAll('paginate');
        return view('agenda.index', $data);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['agenda'] = Agenda::find($id);
        $data['period'] = DB::table('periods')->where(['id'=>$id])->first();
        // $data['schedules'] = DB::table('schedules')->select('id')->where(['period_id'=>$id])->get();

        $data['findingDetails'] =  DB::table('schedules')
            ->select('finding_details.id','reference', 'respon', 'division_id', 'auditee_id', 'deadline', 'statement')
            ->join('findings', 'schedules.id', 'findings.schedule_id')
            ->join('finding_details', 'findings.id', 'finding_details.finding_id')
            ->where(['schedules.period_id'=>$id, 'schedules.dlt'=>'0'])
            ->get();
;
        // dd($data['findingDetails']);
        return $this->sendCommonResponse($data, null, 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // dd($request->all());
        $idDetail = $request->id;
        $respon = $request->respon;
        $deadline = $request->deadline;
        $date = $request->date;
        $participant = $request->participant;
        $agenda = $request->agenda;
        $time = $request->time;
        $pejabat1 = $request->pejabat1;
        $pejabat2 = $request->pejabat2;
        $location = $request->location;
        $jabatan1 = $request->jabatan1;
        $jabatan2 = $request->jabatan2;

        DB::table('periods')->where('id', $id)->update([
            'date' => $request->date,
            'participant' => $request->participant,
            'agenda' => $request->agenda,
            'time' => $request->time,
            'pejabat1' => $request->pejabat1,
            'pejabat2' => $request->pejabat2,
            'location' => $request->location,
            'jabatan1' => $request->jabatan1,
            'jabatan2' => $request->jabatan2,
        ]);

        if (!empty($idDetail)) {
            # code...
            for ($i=0; $i < count($idDetail); $i++) { 
                # code...
                DB::table('finding_details')->where('id', $idDetail[$i])->update([
                    "respon" =>  $respon[$i] ? $respon[$i] : null, # new \Datetime()
                    "deadline" => $deadline[$i] ? $deadline[$i] : null,  # new \Datetime()
                ]);
            }

        }

        
        $data['agenda'] = Agenda::find($id);
        

        $data['period'] = DB::table('periods')->where(['id'=>$id])->first();
        $data['findingDetails'] =  DB::table('schedules')
            ->select('finding_details.id','reference', 'respon', 'division_id', 'auditee_id', 'deadline', 'statement')
            ->join('findings', 'schedules.id', 'findings.schedule_id')
            ->join('finding_details', 'findings.id', 'finding_details.finding_id')
            ->where(['schedules.period_id'=>$id, 'schedules.dlt'=>'0'])
            ->get();
        return $this->sendCommonResponse($data, 'You have successfully updated member', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agenda $agenda)
    {
        //
    }

    public function print(Request $request, $id){

        $period = DB::table('periods')->where(['id'=>$id])->first();

        $agenda =  DB::table('schedules')
            ->select('finding_details.id','reference', 'respon', 'division_id', 'auditee_id', 'deadline', 'statement')
            ->join('findings', 'schedules.id', 'findings.schedule_id')
            ->join('finding_details', 'findings.id', 'finding_details.finding_id')
            ->where(['schedules.period_id'=>$id, 'schedules.dlt'=>'0'])
            ->get();


        $pdf = PDF::loadView('agenda.print', ['agenda'=>$agenda, 'period'=>$period])->setPaper('a4', 'portrait');
        return $pdf->stream('agenda.pdf');
    }


    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'agenda'=>'required|max:185',
        ]);
    }

    private function sendCommonResponse($data=[], $notify = '', $option = null) 
    {
        $agendaObj = new Agenda();
        $response = $this->processNotification($notify);
        if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editAgenda'] = view('agenda.form', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showAgenda'] = view('agenda.profile', $data)->render();
        }
        if ( in_array($option, ['index', 'add', 'update', 'delete', 'import'])) {
            if (empty($data['agendas'])) {
                $data['agendas'] = $agendaObj->getAll('paginate');
            }
            $response['replaceWith']['#agendaTable'] = view('agenda.table', $data)->render();
        }
        return $this->sendResponse($response);
    }
}
