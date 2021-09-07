<?php

namespace App\Http\Controllers;

use App\Reports;
use App\Schedule;
use App\User;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class ReportsController extends Controller
{
    public function __construct(Reports $report)
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
                Session::put('report_filter', $search);
            } else if( Session::get('report_filter')) {
                $search = Session::get('report_filter');
            }
            $data['reports'] = $this->report->getAll('paginate', $search);
            return $this->sendCommonResponse($data, null, 'index');
        }
        $data['reports'] = $this->report->getAll('paginate');
        return view('report.index', $data);
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
     * @param  \App\Reports  $reports
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $data['report'] = Reports::select('schedules.id as schedule_id', 'schedules.schedule_date', 'schedules.clock_start_id', 'schedules.clock_finish_id', 'schedules.period_id', 'auditor.id as auditor_id', 'auditor.name as auditor_name', 'auditee.id as auditee_id', 'auditee.name as auditee_name', 'member_one.id as member_one', 'member_one.name as member_one_name', 'member_two.id as member_two', 'member_two.name as member_two_name','schedules.division_id')
        ->rightJoin('schedules', 'reports.schedule_id', 'schedules.id')
        ->leftJoin('users as auditor', 'schedules.auditor_id', 'auditor.id')
        ->leftJoin('users as auditee', 'schedules.auditee_id', 'auditee.id')
        ->leftJoin('users as member_one', 'schedules.member_one', 'member_one.id')
        ->leftJoin('users as member_two', 'schedules.member_two', 'member_two.id')
        ->where('reports.id',$id)
        ->first();

        // dd($data['report']);

        return $this->sendCommonResponse($data, null, 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reports  $reports
     * @return \Illuminate\Http\Response
     */
    public function edit(Reports $reports)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reports  $reports
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reports $reports)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reports  $reports
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reports $reports)
    {
        //
    }



    private function sendCommonResponse($data=[], $notify = '', $option = null) 
    {
        $reportsObj = new Reports();
        $response = $this->processNotification($notify);
        if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editReport'] = view('reports.form', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showReport'] = view('reports.profile', $data)->render();
        }
        if ( in_array($option, ['index', 'add', 'update', 'delete', 'import'])) {
            if (empty($data['reportss'])) {
                $data['reportss'] = $reportsObj->getAll('paginate');
            }
            $response['replaceWith']['#reportsTable'] = view('report.table', $data)->render();
        }
        return $this->sendResponse($response);
    }


    public function print(Request $request, $id){
        
        $report = Reports::select('schedules.division_id', 'schedules.id as schedule_id', 'schedules.schedule_date', 'schedules.clock_start_id', 'schedules.clock_finish_id', 'schedules.period_id', 'auditor.id as auditor_id', 'auditor.name as auditor_name', 'auditee.id as auditee_id', 'auditee.name as auditee_name', 'member_one.id as member_one', 'member_one.name as member_one_name', 'member_two.id as member_two', 'member_two.name as member_two_name')
        ->rightJoin('schedules', 'reports.schedule_id', 'schedules.id')
        ->leftJoin('users as auditor', 'schedules.auditor_id', 'auditor.id')
        ->leftJoin('users as auditee', 'schedules.auditee_id', 'auditee.id')
        ->leftJoin('users as member_one', 'schedules.member_one', 'member_one.id')
        ->leftJoin('users as member_two', 'schedules.member_two', 'member_two.id')
        ->where('reports.id',$id)
        ->first();

        $reportDetails = DB::table('schedules')
        ->select('*')
        ->leftJoin('findings', 'schedules.id', 'findings.schedule_id')
        ->leftJoin('finding_details', 'findings.id', 'finding_details.finding_id')
        ->where([['schedules.dlt', '0'], ['schedules.id', $report->schedule_id]])
        ->get();

        $pdf = PDF::loadView('report.print', ['report'=>$report, 'reportDetails'=>$reportDetails])->setPaper('a4', 'landscape');
        return $pdf->stream('report.pdf');
    }
}
