<?php

namespace App\Http\Controllers;

use App\ReportAll;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class ReportAllController extends Controller
{
    public function __construct(ReportAll $report)
    {
        $this->middleware('auth');
        $this->report = $report;
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
                Session::put('reportalls_filter', $search);
            } else if( Session::get('reportalls_filter')) {
                $search = Session::get('reportalls_filter');
            }
            $data['reports'] = $this->report->getAll('paginate', $search);
            return $this->sendCommonResponse($data, null, 'index');
        }

        $data['reports'] = $this->report->getAll('paginate');
        return view('reportall.index', $data);
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
     * @param  \App\ReportAll  $reports
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReportAll  $reports
     * @return \Illuminate\Http\Response
     */
    public function edit(ReportAll $reports)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReportAll  $reports
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReportAll $reports)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReportAll  $reports
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportAll $reports)
    {
        //
    }



    private function sendCommonResponse($data=[], $notify = '', $option = null) 
    {
        $reportsObj = new ReportAll();
        $response = $this->processNotification($notify);


        if ( in_array($option, ['index'])) {;
            $response['replaceWith']['#reportsTable'] = view('reportall.table', $data)->render();
        }
        return $this->sendResponse($response);
    }


    public function print(Request $request, $period_id){
        
        $reports = DB::table('schedules')->select('schedules.id', 'schedules.standard_id', 'schedules.standard_detail_id', 'divisions.title as division', 'schedules.schedule_date', 'clock_start.nama as clock_start', 'clock_finish.nama as clock_finish', 'schedules.period_id', 'auditee.name as auditee_name',
        'auditor.name as auditor_name', 'member_one.name as member_one_name', 'member_two.name as member_two_name', 'schedules.status')
        ->leftJoin('users as auditor', 'schedules.auditor_id', 'auditor.id')
        ->leftJoin('users as auditee', 'schedules.auditee_id', 'auditee.id')
        ->leftJoin('users as member_one', 'schedules.member_one', 'member_one.id')
        ->leftJoin('users as member_two', 'schedules.member_two', 'member_two.id')
        ->leftJoin('divisions', 'schedules.division_id', 'divisions.id')
        ->leftJoin('clock as clock_start', 'schedules.clock_start_id', 'clock_start.id')
        ->leftJoin('clock as clock_finish', 'schedules.clock_finish_id', 'clock_finish.id')
        ->where(['schedules.period_id'=>$period_id, 'schedules.dlt'=>'0'])
        ->OrderBy('status','ASC')
        ->get();

        $pdf = PDF::loadView('reportall.print', ['reports'=>$reports, 'period_id'=> $period_id])->setPaper('a4', 'landscape');
        return $pdf->stream('reportall.pdf');
    }
}
