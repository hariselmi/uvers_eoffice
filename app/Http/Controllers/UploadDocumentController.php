<?php

namespace App\Http\Controllers;

use App\UploadDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class UploadDocumentController extends Controller
{
    public function __construct(UploadDocument $uploaddocument)
    {
        $this->middleware('auth');
        $this->uploaddocument = $uploaddocument;
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
                Session::put('uploaddocument_filter', $search);
            } else if( Session::get('uploaddocument_filter')) {
                $search = Session::get('uploaddocument_filter');
            }
            $data['uploaddocuments'] = $this->uploaddocument->getAll('paginate', $search);
            return $this->sendCommonResponse($data, null, 'index');
        }
        $data['uploaddocuments'] = $this->uploaddocument->getAll('paginate');
        return view('uploaddocument.index', $data);
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
     * @param  \App\UploadDocument  $uploadDocument
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $data['uploaddocument'] = UploadDocument::select('schedules.id as schedule_id', 'schedules.schedule_date', 'schedules.clock_start_id', 'schedules.clock_finish_id', 'schedules.period_id', 'auditor.id as auditor_id', 'auditor.name as auditor_name', 'auditee.id as auditee_id', 'auditee.name as auditee_name','schedules.division_id')
        ->rightJoin('schedules', 'upload_documents.schedule_id', 'schedules.id')
        ->leftJoin('users as auditor', 'schedules.auditor_id', 'auditor.id')
        ->leftJoin('users as auditee', 'schedules.auditee_id', 'auditee.id')
        ->where([['upload_documents.id',$id]])
        ->first();
        
        $data['uploaddocumentDetails'] = DB::table('upload_document_details')
        ->where([['upload_document_details.dlt', '0'], ['upload_document_details.upload_document_id', $data['uploaddocument']->id]])
        ->selectRaw('upload_document_details.document_detail_id, COALESCE(COUNT(upload_document_details.document_detail_id), 0) as totalfile')
        ->groupBy('upload_document_details.document_detail_id')
        ->get();

        $data['documents'] = DB::table('documents')
        ->select('document_details.id', 'document_details.document', 'document_details.document_file')
        ->leftJoin('document_details', 'documents.id', 'document_details.document_id')
        ->where([['documents.dlt', '0'], ['document_details.dlt', '0'], ['documents.schedule_id', $data['uploaddocument']->schedule_id], ['document_details.document', '<>', null]])
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

        return $this->sendCommonResponse($data, null, 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UploadDocument  $uploadDocument
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['uploaddocument'] = UploadDocument::find($id);
        $data['uploaddocumentDetails'] = DB::table('upload_document_details')
        ->where([['upload_document_details.dlt', '0'], ['upload_document_details.upload_document_id', $data['uploaddocument']->id]])
        ->selectRaw('upload_document_details.document_detail_id, COALESCE(COUNT(upload_document_details.document_detail_id), 0) as totalfile')
        ->groupBy('upload_document_details.document_detail_id')
        ->get();

        $data['documents'] = DB::table('documents')
        ->select('document_details.id', 'document_details.document', 'document_details.document_file')
        ->leftJoin('document_details', 'documents.id', 'document_details.document_id')
        ->where([['documents.dlt', '0'], ['document_details.dlt', '0'], ['documents.schedule_id', $data['uploaddocument']->schedule_id], ['document_details.document', '<>', null]])
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

        return $this->sendCommonResponse($data, null, 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UploadDocument  $uploadDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $documentid = $request->documentid;
        $oldFile = $request->oldFile;
        $documentFile = $request->documentFile;
        $uploadDocs = [];
        $uploadRequest = [];

        for ($indexA=0; $indexA < count($documentid); $indexA++) { 
            # code...
            array_push($uploadDocs, 'documentFile'.$documentid[$indexA]);
        }

        foreach($uploadDocs as $item){
            array_push($uploadRequest, $request->$item);
        }


        for ($indexB=0; $indexB < count($uploadRequest); $indexB++) { 
            # code...
            $imgNewName = [];


            if ($uploadRequest[$indexB] != null) {
                # code...

                $checkExist = DB::table('upload_document_details')
                ->where(['upload_document_id'=>$id,'document_detail_id'=>$documentid[$indexB]])
                ->count();

                // if ($checkExist>0) {
                //     # code...
                //     DB::table('upload_document_details')->where(['document_detail_id'=>$documentid[$indexB]])->delete();
                // }


                for ($i=0; $i < count($uploadRequest[$indexB]); $i++) { 
                    # code...
                    $nameGenerate = hexdec(uniqid());
                    $imgExtention = strtolower($uploadRequest[$indexB][$i]->getClientOriginalExtension());
                    $imgOriName = strtolower($uploadRequest[$indexB][$i]->getClientOriginalName());
                    $newName = $nameGenerate.'_'.$imgExtention;
                    $uploadLocation = public_path().'/document';
                    $lastImage = $uploadLocation.$newName;
                    $uploadRequest[$indexB][$i]->move($uploadLocation,$newName);

                    // array_push($imgNewName, $newName);

                    DB::table('upload_document_details')
                    ->insert([
                        'upload_document_id' => $id,
                        'document_detail_id' => $documentid[$indexB],
                        'document_upload' => $newName,
                        'document_file_name' => $imgOriName,
                        'dlt' => '0',
                    ]);
                }
            }

            // DB::table('upload_document_details')
            // ->where('id', $documentid[$indexB])
            // ->update([
            //     'document_file' => $imgNewName
            // ]);


        }


        $data['uploaddocument'] = UploadDocument::find($id);
        $data['uploaddocumentDetails'] = DB::table('upload_document_details')
        ->where([['upload_document_details.dlt', '0'], ['upload_document_details.upload_document_id', $data['uploaddocument']->id]])
        ->selectRaw('upload_document_details.document_detail_id, COUNT(upload_document_details.document_detail_id) as totalfile')
        ->groupBy('upload_document_details.document_detail_id')
        ->get();

        $data['documents'] = DB::table('documents')
        ->leftJoin('document_details', 'documents.id', 'document_details.document_id')
        ->where([['documents.dlt', '0'], ['document_details.dlt', '0'], ['documents.schedule_id', $data['uploaddocument']->schedule_id], ['document_details.document', '<>', null]])
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

        return $this->sendCommonResponse($data, 'You have successfully updated member', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UploadDocument  $uploadDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(UploadDocument $uploadDocument)
    {
        //
    }


    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'uploaddocument'=>'required',
        ]);
    }

    private function sendCommonResponse($data=[], $notify = '', $option = null) 
    {
        $uploaddocumentObj = new UploadDocument();
        $response = $this->processNotification($notify);
        if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editUploadDocument'] = view('uploaddocument.form', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showUploadDocument'] = view('uploaddocument.profile', $data)->render();
        }
        if ( in_array($option, ['index', 'add', 'update', 'delete', 'import'])) {
            if (empty($data['uploaddocuments'])) {
                $data['uploaddocuments'] = $uploaddocumentObj->getAll('paginate');
            }
            $response['replaceWith']['#uploaddocumentTable'] = view('uploaddocument.table', $data)->render();
        }
        return $this->sendResponse($response);
    }
}
