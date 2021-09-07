<?php

namespace App\Http\Controllers;

use App\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PeriodController extends Controller
{

    public function __construct(Period $period)
    {
        $this->middleware('auth');
        $this->period = $period;
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
                Session::put('period_filter', $search);
            } else if( Session::get('period_filter')) {
                $search = Session::get('period_filter');
            }
            $data['periods'] = $this->period->getAll('paginate', $search);
            $data['parents'] = DB::table('periods')->where('dlt', '0')->pluck('title', 'id');
            return $this->sendCommonResponse($data, null, 'index');
        }

        $data['periods'] = $this->period->getAll('paginate');
        return view('period.index', $data);
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
        // dd($request->all());
        if ($request->status == '1') {
            # code...
            DB::table('periods')->update([
                'status'=> '0'
            ]);

            $input = $request->all();
            $this->validator($input)->validate();
            $periods = new Period;
            $periods->savePeriod($input);
        } else {
            # code...

            $input = $request->all();
            $this->validator($input)->validate();
            $periods = new Period;
            $periods->savePeriod($input);
        }
        
        
        return $this->sendCommonResponse($data=[], 'You have successfully added period', 'add');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $data['period'] = Period::find($id);
        return $this->sendCommonResponse($data, null, 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['period'] = Period::find($id);
        return $this->sendCommonResponse($data, null, 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $member = Period::find($id);
        if($member->status == '1' AND $request->status == '0'){

             return $this->sendCommonResponse([], ['danger'=>__('Silahkan Update Periode lain untuk diaktifkan')]);

        }else{


        if ($request->status == '1') {

        DB::table('periods')->update([
            'status'=> '0'
        ]);
        }

        $period = (new Period())->getById($id);
        $period->title = $request->title;
        $period->status = $request->status;
        $period->semester = $request->semester;
        $period->save();
        }    

        $data['period'] = $period;
        return $this->sendCommonResponse($data, 'You have successfully updated period', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $member = Period::find($id);

        if($member->status == '1')
        {
            return $this->sendCommonResponse([], ['danger'=>__('Periode Active tidak bisa di Hapus')]);

        }else{
            $member->dlt = '1';
            $member->save();
        }   


            return $this->sendCommonResponse([], 'You have successfully deleted period', 'delete');
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->sendCommonResponse([], ['danger'=>__('Integrity constraint violation: You Cannot delete a parent row')]);
        }
    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'title'=>'required'
        ]);
    }

    private function sendCommonResponse($data=[], $notify = '', $option = null) 
    {
        $periodObj = new Period();
        $response = $this->processNotification($notify);
        
        if ($option == 'add') {
            $response['replaceWith']['#addPeriod'] = view('period.formadd', $data)->render();
        } else if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editPeriod'] = view('period.formedit', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showPeriod'] = view('period.profile', $data)->render();
        }
        if ( in_array($option, ['index', 'add', 'update', 'delete', 'import'])) {
            if (empty($data['periods'])) {
                $data['periods'] = $periodObj->getAll('paginate');
            }
            $response['replaceWith']['#periodTable'] = view('period.table', $data)->render();
        }
        return $this->sendResponse($response);
    }
}
