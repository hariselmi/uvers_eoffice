<?php

namespace App\Http\Controllers;

use App\Standard;
use App\StandardDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StandardDetailController extends Controller
{

    public function __construct(StandardDetail $standardDetail)
    {
        $this->middleware('auth');
        $this->standarddetail = $standardDetail;
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
                Session::put('standarddetail_filter', $search);
            } else if( Session::get('standarddetail_filter')) {
                $search = Session::get('standarddetail_filter');
            }
            $data['standarddetails'] = $this->standarddetail->getAll('paginate', $search);

            return $this->sendCommonResponse($data, null, 'index');
        }

        $data['standarddetails'] = $this->standarddetail->getAll('paginate');
        $data['standards'] = DB::table('standards')->where('dlt', '0')->pluck('standard', 'id');
        return view('standarddetail.index', $data);
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
        $document = $request->document;
        $detailId = $request->id;

        $standard_detail = new StandardDetail;
        $standard_detail->standard_id = $request->standard_id;
        $standard_detail->standard_details = $request->standard_details;
        $standard_detail->no_document = 0;
        $standard_detail->save();

        if ($document) {
            # code...
            for ($i=0; $i < count($document); $i++) { 
                # code...
                DB::table('standard_documents')->insert([
                    'standard_detail_id' => $standard_detail->id,
                    'no_document' => '0',
                    'document' => $document[$i],
                    'dlt' => '0',
                    "created_at" => Carbon::now(), # new \Datetime()
                    "updated_at" => Carbon::now(),  # new \Datetime()
                ]);
                
            }
        
        }

        $data['standards'] = DB::table('standards')->where('dlt', '0')->pluck('standard', 'id');
        return $this->sendCommonResponse($data, 'You have successfully added standard', 'add');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StandardDetail  $standardDetail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data['standardDetail'] = StandardDetail::find($id);
        $data['standardDocuments'] = DB::table('standard_documents')
        ->where([['standard_documents.dlt', '0'], ['standard_documents.standard_detail_id', $data['standardDetail']->id]])
        ->get();
        $data['standards'] = DB::table('standards')->where('dlt', '0')->pluck('standard', 'id');

        // dd($data['standardDetail']);
        
        return $this->sendCommonResponse($data, null, 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StandardDetail  $standardDetail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['standardDetail'] = StandardDetail::find($id);
        $data['standardDocuments'] = DB::table('standard_documents')
        ->where([['standard_documents.dlt', '0'], ['standard_documents.standard_detail_id', $data['standardDetail']->id]])
        ->get();
        $data['standards'] = DB::table('standards')->where('dlt', '0')->pluck('standard', 'id');
        
        return $this->sendCommonResponse($data, null, 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StandardDetail  $standardDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $document = $request->document;
        $detailId = $request->id;


        DB::table('standard_details')->where('id', $id)->update([
            'standard_id' => $request->standard_id,
            'standard_details' => $request->standard_details,
        ]);


        if ($document == null) {
            # code...
                DB::table('standard_documents')->where('standard_detail_id', $id)->update([
                    'dlt' => '1',
                    "created_at" =>  Carbon::now(), # new \Datetime()
                    "updated_at" => Carbon::now(),  # new \Datetime()
                ]);
        }else{
            for ($i=0; $i < count($document); $i++) { 
                # code...
                $checkExist = DB::table('standard_documents')
                ->where([['dlt', '0'], ['id', $detailId[$i]]])
                ->count();
    
                if ($checkExist > 0) {
                    # code...
                    DB::table('standard_documents')->where('id', $detailId[$i])->update([
                        'standard_detail_id' => $id,
                        'document' => $document[$i],
                        'dlt' => '0',
                        "created_at" =>  Carbon::now(), # new \Datetime()
                        "updated_at" => Carbon::now(),  # new \Datetime()
                    ]);
                } else {
                    # code...
                    DB::table('standard_documents')->insert([
                        'standard_detail_id' => $id,
                        'document' => $document[$i],
                        'no_document' => '0',
                        'dlt' => '0',
                        "created_at" =>  Carbon::now(), # new \Datetime()
                        "updated_at" => Carbon::now(),  # new \Datetime()
                    ]);
                }
                
            }
        }

        $data['standardDetail'] = StandardDetail::find($id);
        $data['standardDocuments'] = DB::table('standard_documents')
        ->where([['standard_documents.dlt', '0'], ['standard_documents.standard_detail_id', $data['standardDetail']->id]])
        ->get();
        $data['standards'] = DB::table('standards')->where('dlt', '0')->pluck('standard', 'id');
        return $this->sendCommonResponse($data, 'You have successfully updated member', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StandardDetail  $standardDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $standarddetail = StandardDetail::find($id);
            $standarddetail->dlt = '1';
            $standarddetail->save();

            return $this->sendCommonResponse([], 'You have successfully deleted Standar Detail', 'delete');
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->sendCommonResponse([], ['danger'=>__('Integrity constraint violation: You Cannot delete a parent row')]);
        }
    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'standard_details'=>'required|max:185',
        ]);
    }

    private function sendCommonResponse($data=[], $notify = '', $option = null) 
    {
        $standarddetailObj = new StandardDetail();
        $response = $this->processNotification($notify);
        
        if ($option == 'add') {
            $response['replaceWith']['#addStandardDetail'] = view('standarddetail.formadd', $data)->render();
        } else if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editStandardDetail'] = view('standarddetail.formedit', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showStandardDetail'] = view('standarddetail.profile', $data)->render();
        }
        if ( in_array($option, ['index', 'add', 'update', 'delete', 'import'])) {
            if (empty($data['standarddetails'])) {
                $data['standarddetails'] = $standarddetailObj->getAll('paginate');
            }
            $response['replaceWith']['#standarddetailTable'] = view('standarddetail.table', $data)->render();
        }
        return $this->sendResponse($response);
    }
}
