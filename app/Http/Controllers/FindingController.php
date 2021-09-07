<?php

namespace App\Http\Controllers;

use App\Finding;
use App\Schedule;
use App\User;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class FindingController extends Controller
{
    public function __construct(Finding $finding)
    {
        $this->middleware('auth');
        $this->finding = $finding;
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
                Session::put('finding_filter', $search);
            } else if( Session::get('finding_filter')) {
                $search = Session::get('finding_filter');
            }
            $data['findings'] = $this->finding->getAll('paginate', $search);
            return $this->sendCommonResponse($data, null, 'index');
        }
        $data['findings'] = $this->finding->getAll('paginate');
        return view('finding.index', $data);
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
     * @param  \App\Finding  $finding
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $data['finding'] = Finding::select('schedules.id as schedule_id', 'schedules.schedule_date', 'schedules.clock_start_id', 'schedules.clock_finish_id', 'schedules.period_id', 'auditor.id as auditor_id', 'auditor.name as auditor_name', 'auditee.id as auditee_id', 'auditee.name as auditee_name','schedules.division_id')
        ->rightJoin('schedules', 'findings.schedule_id', 'schedules.id')
        ->leftJoin('users as auditor', 'schedules.auditor_id', 'auditor.id')
        ->leftJoin('users as auditee', 'schedules.auditee_id', 'auditee.id')
        ->where('findings.id',$id)
        ->first();

        $data['findingDetails'] = DB::table('finding_details')
        ->where([['finding_details.dlt', '0'], ['finding_details.finding_id', $id]])
        ->get();
        // dd($data['finding']);

        return $this->sendCommonResponse($data, null, 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Finding  $finding
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['finding'] = Finding::find($id);
        $data['findingDetails'] = DB::table('finding_details')
        ->where([['finding_details.dlt', '0'], ['finding_details.finding_id', $data['finding']->id]])
        ->get();
        return $this->sendCommonResponse($data, null, 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Finding  $finding
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $category = $request->category;
        $reference = $request->reference;
        $statement = $request->statement;
        $reason = $request->reason;
        $answer = $request->answer;
        $detailId = $request->id;

        if ($reference == null) {
            # code...
            DB::table('finding_details')->where('finding_id', $id)->update([
                'dlt' => '0',
                "created_at" =>  Carbon::now(), # new \Datetime()
                "updated_at" => Carbon::now(),  # new \Datetime()
            ]);
        } else {
            # code...

            for ($i=0; $i < count($category); $i++) { 
                # code...
                $checkExist = DB::table('finding_details')
                ->where([['dlt', '0'], ['id', $detailId[$i]]])
                ->count();

                if ($checkExist > 0) {
                    # code...
                    DB::table('finding_details')->where('id', $detailId[$i])->update([
                        'finding_id' => $id,
                        'category' => $category[$i],
                        'reference' => $reference[$i],
                        'statement' => $statement[$i],
                        'reason' => $reason[$i],
                        'answer' => $answer[$i],
                        'dlt' => '0',
                        "created_at" =>  Carbon::now(), # new \Datetime()
                        "updated_at" => Carbon::now(),  # new \Datetime()
                    ]);
                } else {
                    # code...
                    DB::table('finding_details')->insert([
                        'finding_id' => $id,
                        'category' => $category[$i],
                        'reference' => $reference[$i],
                        'statement' => $statement[$i],
                        'reason' => $reason[$i],
                        'answer' => $answer[$i],
                        'dlt' => '0',
                        "created_at" =>  Carbon::now(), # new \Datetime()
                        "updated_at" => Carbon::now(),  # new \Datetime()
                    ]);
                }
                
            }
        }
        
        
        $data['finding'] = Finding::find($id);
        $data['findingDetails'] = DB::table('finding_details')
        ->where([['finding_details.dlt', '0'], ['finding_details.finding_id', $id]])
        ->get();
        return $this->sendCommonResponse($data, 'You have successfully updated member', 'update');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Finding  $finding
     * @return \Illuminate\Http\Response
     */
    public function destroy(Finding $finding)
    {
        //
    }

    public function print(Request $request, $id){
        
        $finding = Finding::select('schedules.id as schedule_id', 'schedules.schedule_date', 'schedules.clock_start_id', 'schedules.clock_finish_id', 'schedules.period_id', 'auditor.id as auditor_id', 'auditor.name as auditor_name', 'auditee.id as auditee_id', 'auditee.name as auditee_name','schedules.division_id')
        ->rightJoin('schedules', 'findings.schedule_id', 'schedules.id')
        ->leftJoin('users as auditor', 'schedules.auditor_id', 'auditor.id')
        ->leftJoin('users as auditee', 'schedules.auditee_id', 'auditee.id')
        ->where('findings.id',$id)
        ->first();
        $findingDetails = DB::table('finding_details')
        ->where([['finding_details.dlt', '0'], ['finding_details.finding_id', $id]])
        ->get();
        $pdf = PDF::loadView('finding.print', ['finding'=>$finding, 'findingDetails'=>$findingDetails])->setPaper('a4', 'landscape');
        return $pdf->stream('finding.pdf');
    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'avatar'=>'mimes:jpeg,bmp,png|max:5120kb',
            'name'=>'required|max:185',
            'email'=>'max:100',
            'telp'=>'max:20',
        ]);
    }

    private function sendCommonResponse($data=[], $notify = '', $option = null) 
    {
        $findingObj = new Finding();
        $response = $this->processNotification($notify);
        $data['auditor'] = User::where('role', 'member')->pluck('name', 'id');
        if ($option == 'add') {
            $response['replaceWith']['#addFinding'] = view('finding.form', $data)->render();
        } else if ($option == 'sale-add') {
            $data['findings'] = $findingObj->getAll();
            $response['replaceWith']['#finding_dropdown'] = view('sale.finding_dropdown', $data)->render();
            $response['replaceWith']['#addFinding'] = view('finding.form', ['finding'=>''])->render();
        } else if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editFinding'] = view('finding.form', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showFinding'] = view('finding.profile', $data)->render();
        }
        if ( in_array($option, ['index', 'add', 'update', 'delete', 'import'])) {
            if (empty($data['findings'])) {
                $data['findings'] = $findingObj->getAll('paginate');
            }
            $response['replaceWith']['#findingTable'] = view('finding.table', $data)->render();
        }
        return $this->sendResponse($response);
    }
}
