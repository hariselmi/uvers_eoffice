<?php

namespace App\Http\Controllers;

use App\Document;
use App\Schedule;
use App\User;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class DocumentController extends Controller
{
    public function __construct(Document $document)
    {
        $this->middleware('auth');
        $this->document = $document;
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
                Session::put('document_filter', $search);
            } else if( Session::get('document_filter')) {
                $search = Session::get('document_filter');
            }
            $data['documents'] = $this->document->getAll('paginate', $search);
            return $this->sendCommonResponse($data, null, 'index');
        }
        $data['documents'] = $this->document->getAll('paginate');
        return view('document.index', $data);
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
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $data['document'] = Document::select('schedules.id as schedule_id', 'schedules.schedule_date', 'schedules.clock_start_id', 'schedules.clock_finish_id', 'schedules.period_id', 'auditor.id as auditor_id', 'auditor.name as auditor_name', 'auditee.id as auditee_id', 'auditee.name as auditee_name','schedules.division_id')
        ->rightJoin('schedules', 'documents.schedule_id', 'schedules.id')
        ->leftJoin('users as auditor', 'schedules.auditor_id', 'auditor.id')
        ->leftJoin('users as auditee', 'schedules.auditee_id', 'auditee.id')
        ->where('documents.id',$id)
        ->first();


        $data['documentDetails'] = DB::table('document_details')
        ->where([['document_details.dlt', '0'], ['document_details.document_id', $id]])
        ->get();



        $data['documents'] = DB::table('documents')
        ->select('document_details.id', 'document_details.document', 'document_details.document_file')
        ->leftJoin('document_details', 'documents.id', 'document_details.document_id')
        ->where([['documents.dlt', '0'], ['document_details.dlt', '0'], ['documents.schedule_id', $data['document']->schedule_id], ['document_details.document', '<>', null]])
        ->get();

        $totalFile = [];

        for ($i=0; $i < count($data['documents']); $i++) { 
            # code...
            $documentUploaded = DB::table('upload_document_details')
            ->select('document_detail_id', 'document_file_name', 'document_upload')
            ->where([['upload_document_details.dlt', '0'], ['upload_document_details.document_detail_id', $data['documents'][$i]->id]])
            ->get();

            array_push($totalFile, $documentUploaded);

        }

        $data['totalFile'] = $totalFile;

        // dd($data['document']);

        return $this->sendCommonResponse($data, null, 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['document'] = Document::find($id);
        $data['documentDetails'] = DB::table('document_details')
        ->where([['document_details.dlt', '0'], ['document_details.document_id', $data['document']->id]])
        ->get();
        // dd($data['documentDetails']);
        return $this->sendCommonResponse($data, null, 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $document = $request->document;
        $detailId = $request->id;

        if ($document == null) {
            # code...
                DB::table('document_details')->where('document_id', $id)->update([
                    'dlt' => '1',
                    "created_at" =>  Carbon::now(), # new \Datetime()
                    "updated_at" => Carbon::now(),  # new \Datetime()
                ]);
        }else{
            for ($i=0; $i < count($document); $i++) { 
                # code...
                $checkExist = DB::table('document_details')
                ->where([['dlt', '0'], ['id', $detailId[$i]]])
                ->count();
    
                if ($checkExist > 0) {
                    # code...
                    DB::table('document_details')->where('id', $detailId[$i])->update([
                        'document_id' => $id,
                        'document' => $document[$i],
                        'dlt' => '0',
                        "created_at" =>  Carbon::now(), # new \Datetime()
                        "updated_at" => Carbon::now(),  # new \Datetime()
                    ]);
                } else {
                    # code...
                    DB::table('document_details')->insert([
                        'document_id' => $id,
                        'document' => $document[$i],
                        'dlt' => '0',
                        "created_at" =>  Carbon::now(), # new \Datetime()
                        "updated_at" => Carbon::now(),  # new \Datetime()
                    ]);
                }
                
            }
        }

        
        $data['document'] = Document::find($id);
        $data['documentDetails'] = DB::table('document_details')
        ->where([['document_details.dlt', '0'], ['document_details.document_id', $id]])
        ->get();
        return $this->sendCommonResponse($data, 'You have successfully updated member', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }

    public function print(Request $request, $id){
        
        $document = Document::select('schedules.id as schedule_id', 'schedules.schedule_date', 'schedules.clock_start_id', 'schedules.clock_finish_id', 'schedules.period_id', 'auditor.id as auditor_id', 'auditor.name as auditor_name', 'auditee.id as auditee_id', 'auditee.name as auditee_name','schedules.division_id')
        ->rightJoin('schedules', 'documents.schedule_id', 'schedules.id')
        ->leftJoin('users as auditor', 'schedules.auditor_id', 'auditor.id')
        ->leftJoin('users as auditee', 'schedules.auditee_id', 'auditee.id')
        ->where('documents.id',$id)
        ->first();
        $documentDetails = DB::table('document_details')
        ->where([['document_details.dlt', '0'], ['document_details.document_id', $id]])
        ->get();
        $pdf = PDF::loadView('document.print', ['document'=>$document, 'documentDetails'=>$documentDetails])->setPaper('a4', 'landscape');
        return $pdf->stream('document.pdf');
    }


    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'document'=>'required|max:185',
        ]);
    }

    private function sendCommonResponse($data=[], $notify = '', $option = null) 
    {
        $documentObj = new Document();
        $response = $this->processNotification($notify);
        if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editDocument'] = view('document.form', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showDocument'] = view('document.profile', $data)->render();
        }
        if ( in_array($option, ['index', 'add', 'update', 'delete', 'import'])) {
            if (empty($data['documents'])) {
                $data['documents'] = $documentObj->getAll('paginate');
            }
            $response['replaceWith']['#documentTable'] = view('document.table', $data)->render();
        }
        return $this->sendResponse($response);
    }
}
