<?php

namespace App\Http\Controllers;

use App\CheckList;
use App\Schedule;
use App\User;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class CheckListController extends Controller
{
    public function __construct(CheckList $checklist)
    {
        $this->middleware('auth');
        $this->checklist = $checklist;
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
                Session::put('checklist_filter', $search);
            } else if( Session::get('checklist_filter')) {
                $search = Session::get('checklist_filter');
            }
            $data['checklists'] = $this->checklist->getAll('paginate', $search);
            return $this->sendCommonResponse($data, null, 'index');
        }
        $data['checklists'] = $this->checklist->getAll('paginate');
        return view('checklist.index', $data);
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
     * @param  \App\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $data['checklist'] = CheckList::select('schedules.id as schedule_id', 'schedules.schedule_date', 'schedules.clock_start_id', 'schedules.clock_finish_id', 'schedules.period_id', 'auditor.id as auditor_id', 'auditor.name as auditor_name', 'auditee.id as auditee_id', 'auditee.name as auditee_name','schedules.division_id')
        ->rightJoin('schedules', 'check_lists.schedule_id', 'schedules.id')
        ->leftJoin('users as auditor', 'schedules.auditor_id', 'auditor.id')
        ->leftJoin('users as auditee', 'schedules.auditee_id', 'auditee.id')
        ->where('check_lists.id',$id)
        ->first();


        $data['checklistDetails'] = DB::table('check_list_details')
        ->where([['check_list_details.dlt', '0'], ['check_list_details.checklist_id', $id]])
        ->get();

        return $this->sendCommonResponse($data, null, 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['checklist'] = CheckList::find($id);
        $data['checklistDetails'] = DB::table('check_list_details')
        ->where([['check_list_details.dlt', '0'], ['check_list_details.checklist_id', $data['checklist']->id]])
        ->get();
        return $this->sendCommonResponse($data, null, 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $checklist = $request->checklist;

        $reference      = $request->reference;
        $question       = $request->question;
        $answer         = $request->answer;
        $special_note   = $request->special_note;
        $audit          = $request->audit;
        $detailId       = $request->id;

        if ($reference == null) {
            # code...
            DB::table('check_list_details')->where('checklist_id', $id)->update([
                'dlt' => '1',
                "created_at" => Carbon::now(), # new \Datetime()
                "updated_at" => Carbon::now(),  # new \Datetime()
            ]);
        } else {
            # code...
            for ($i=0; $i < count($reference); $i++) { 
                # code...

                $checkExist = DB::table('check_list_details')
                ->where([['dlt', '0'], ['id', $detailId[$i]]])
                ->count();

                if ($checkExist > 0) {
                    # code...
                    DB::table('check_list_details')->where('id', $detailId[$i])->update([
                        'checklist_id' => $id,
                        'reference' => $reference[$i] ? $reference[$i] : null,
                        'question' => $question[$i] ? $question[$i] : null,
                        'special_note' => $special_note[$i] ? $special_note[$i] : null,
                        'audit' => $audit[$i] ? $audit[$i] : null,
                        'answer' => $answer[$i] ? $answer[$i] : null,
                        'dlt' => '0',
                        "created_at" => Carbon::now(), # new \Datetime()
                        "updated_at" => Carbon::now(),  # new \Datetime()
                    ]);
                } else {
                    # code...
                    DB::table('check_list_details')->insert([
                        'checklist_id' => $id,
                        'reference' => $reference[$i] ? $reference[$i] : null,
                        'question' => $question[$i] ? $question[$i] : null,
                        'special_note' => $special_note[$i] ? $special_note[$i] : null,
                        'audit' => $audit[$i] ? $audit[$i] : null,
                        'answer' => $answer[$i] ? $answer[$i] : null,
                        'dlt' => '0',
                        "created_at" => Carbon::now(), # new \Datetime()
                        "updated_at" => Carbon::now(),  # new \Datetime()
                    ]);
                }
            }
        }
        
        $data['checklist'] = CheckList::find($id);
        $data['checklistDetails'] = DB::table('check_list_details')
        ->where([['check_list_details.dlt', '0'], ['check_list_details.checklist_id', $id]])
        ->get();
        return $this->sendCommonResponse($data, 'You have successfully updated member', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckList $checkList)
    {
        //
    }

    public function print(Request $request, $id){
        
        $checklist = CheckList::select('schedules.id as schedule_id', 'schedules.schedule_date', 'schedules.clock_start_id', 'schedules.clock_finish_id', 'schedules.period_id', 'auditor.id as auditor_id', 'auditor.name as auditor_name', 'auditee.id as auditee_id', 'auditee.name as auditee_name','schedules.division_id')
        ->rightJoin('schedules', 'check_lists.schedule_id', 'schedules.id')
        ->leftJoin('users as auditor', 'schedules.auditor_id', 'auditor.id')
        ->leftJoin('users as auditee', 'schedules.auditee_id', 'auditee.id')
        ->where('check_lists.id',$id)
        ->first();
        $checklistDetails = DB::table('check_list_details')
        ->where([['check_list_details.dlt', '0'], ['check_list_details.checklist_id', $id]])
        ->get();
        $pdf = PDF::loadView('checklist.print', ['checklist'=>$checklist, 'checklistDetails'=>$checklistDetails])->setPaper('a4', 'landscape');
        return $pdf->stream('checklist.pdf');
    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'reference'=>'required',
        ]);
    }

    private function sendCommonResponse($data=[], $notify = '', $option = null) 
    {
        $checklistObj = new Checklist();
        $response = $this->processNotification($notify);
        if ($option == 'add') {
            $response['replaceWith']['#addChecklist'] = view('checklist.form', $data)->render();
        } else if ($option == 'sale-add') {
            $data['checklists'] = $checklistObj->getAll();
            $response['replaceWith']['#checklist_dropdown'] = view('sale.checklist_dropdown', $data)->render();
            $response['replaceWith']['#addChecklist'] = view('checklist.form', ['checklist'=>''])->render();
        } else if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editChecklist'] = view('checklist.form', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showChecklist'] = view('checklist.profile', $data)->render();
        }
        if ( in_array($option, ['index', 'add', 'update', 'delete', 'import'])) {
            if (empty($data['checklists'])) {
                $data['checklists'] = $checklistObj->getAll('paginate');
            }
            $response['replaceWith']['#checklistTable'] = view('checklist.table', $data)->render();
        }
        return $this->sendResponse($response);
    }
}
