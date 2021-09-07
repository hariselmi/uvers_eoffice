<?php

namespace App\Http\Controllers;

use App\Verification;
use App\Schedule;
use App\User;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class VerificationController extends Controller
{
    public function __construct(Verification $verification)
    {
        $this->middleware('auth');
        $this->verification = $verification;
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
                Session::put('verification_filter', $search);
            } else if( Session::get('verification_filter')) {
                $search = Session::get('verification_filter');
            }
            $data['verifications'] = $this->verification->getAll('paginate', $search);
            return $this->sendCommonResponse($data, null, 'index');
        }
        $data['verifications'] = $this->verification->getAll('paginate');
        return view('verification.index', $data);
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
     * @param  \App\Verification  $verification
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Verification  $verification
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['verification'] = Verification::find($id);
        // $data['schedules'] = DB::table('schedules')->select('id')->where(['period_id'=>$id])->get();

        $data['findingDetails'] =  DB::table('schedules')
            ->select('finding_details.id','reference', 'respon', 'division_id', 'auditee_id', 'deadline', 'verification', 'notes', 'statement')
            ->join('findings', 'schedules.id', 'findings.schedule_id')
            ->join('finding_details', 'findings.id', 'finding_details.finding_id')
            ->where(['schedules.period_id'=>$id, 'schedules.dlt'=>'0'])
            ->get();
        // dd($data['findingDetails']);
        return $this->sendCommonResponse($data, null, 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Verification  $verification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // dd($request->all());
        $id = $request->id;
        $verification = $request->verification;
        $notes = $request->notes;

        if (!empty($id)) {
            # code...
            for ($i=0; $i < count($id); $i++) { 
                # code...
                DB::table('finding_details')->where('id', $id[$i])->update([
                    "verification" =>  $verification[$i] ? $verification[$i] : null, # new \Datetime()
                    "notes" => $notes[$i] ? $notes[$i] : null,  # new \Datetime()
                ]);
            }

        }

        
        $data['verification'] = Verification::find($id)->first();

        $data['findingDetails'] =  DB::table('schedules')
            ->select('finding_details.id','reference', 'respon', 'division_id', 'auditee_id', 'deadline', 'verification', 'notes', 'statement')
            ->join('findings', 'schedules.id', 'findings.schedule_id')
            ->join('finding_details', 'findings.id', 'finding_details.finding_id')
            ->where(['schedules.period_id'=>$id, 'schedules.dlt'=>'0'])
            ->get();
        return $this->sendCommonResponse($data, 'You have successfully updated member', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Verification  $verification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Verification $verification)
    {
        //
    }

    public function print(Request $request, $id){


        $verification =  DB::table('schedules')
            ->select('finding_details.id','reference', 'respon', 'division_id', 'auditee_id', 'deadline', 'verification', 'notes', 'statement')
            ->join('findings', 'schedules.id', 'findings.schedule_id')
            ->join('finding_details', 'findings.id', 'finding_details.finding_id')
            ->where(['schedules.period_id'=>$id, 'schedules.dlt'=>'0'])
            ->get();

        $pdf = PDF::loadView('verification.print', ['verification'=>$verification])->setPaper('a4', 'landscape');
        return $pdf->stream('verification.pdf');
    }


    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'verification'=>'required|max:185',
        ]);
    }

    private function sendCommonResponse($data=[], $notify = '', $option = null) 
    {
        $verificationObj = new Verification();
        $response = $this->processNotification($notify);
        if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editVerification'] = view('verification.form', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showVerification'] = view('verification.profile', $data)->render();
        }
        if ( in_array($option, ['index', 'add', 'update', 'delete', 'import'])) {
            if (empty($data['verifications'])) {
                $data['verifications'] = $verificationObj->getAll('paginate');
            }
            $response['replaceWith']['#verificationTable'] = view('verification.table', $data)->render();
        }
        return $this->sendResponse($response);
    }
}
