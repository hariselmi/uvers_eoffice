<?php

namespace App\Http\Controllers;

use App\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DivisionController extends Controller
{

    public function __construct(Division $division)
    {
        $this->middleware('auth');
        $this->division = $division;
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
                Session::put('division_filter', $search);
            } else if( Session::get('division_filter')) {
                $search = Session::get('division_filter');
            }
            $data['divisions'] = $this->division->getAll('paginate', $search);
            $data['parents'] = DB::table('divisions')->where('dlt', '0')->pluck('title', 'id');
            return $this->sendCommonResponse($data, null, 'index');
        }

        $data['divisions'] = $this->division->getAll('paginate');
        $data['parents'] = DB::table('divisions')->where('dlt', '0')->pluck('title', 'id');
        return view('division.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['parents'] = DB::table('divisions')->where('dlt', '0')->pluck('title', 'id');
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
        $input = $request->all();
        $this->validator($input)->validate();
        $divisions = new Division;
        $divisions->saveDivision($input);

        $data['parents'] = DB::table('divisions')->where('dlt', '0')->pluck('title', 'id');
        
        return $this->sendCommonResponse($data, 'You have successfully added division', 'add');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $data['division'] = Division::find($id);
        $data['parents'] = DB::table('divisions')->where('dlt', '0')->pluck('title', 'id');
        return $this->sendCommonResponse($data, null, 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['division'] = Division::find($id);
        $data['parents'] = DB::table('divisions')->where('dlt', '0')->pluck('title', 'id');
        return $this->sendCommonResponse($data, null, 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $division = (new Division())->getById($id);
        $division->title = $request->title;
        $division->save();

        $data['division'] = $division;
        $data['parents'] = DB::table('divisions')->where('dlt', '0')->pluck('title', 'id');
        return $this->sendCommonResponse($data, 'You have successfully updated division', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $member = Division::find($id);
            $member->dlt = '1';
            $member->save();

            return $this->sendCommonResponse([], 'You have successfully deleted division', 'delete');
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
        $divisionObj = new Division();
        $response = $this->processNotification($notify);
        
        if ($option == 'add') {
            $response['replaceWith']['#addDivision'] = view('division.formadd', $data)->render();
        } else if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editDivision'] = view('division.formedit', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showDivision'] = view('division.profile', $data)->render();
        }
        if ( in_array($option, ['index', 'add', 'update', 'delete', 'import'])) {
            if (empty($data['divisions'])) {
                $data['divisions'] = $divisionObj->getAll('paginate');
                $data['parents'] = DB::table('divisions')->where('dlt', '0')->pluck('title', 'id');
            }
            $response['replaceWith']['#divisionTable'] = view('division.table', $data)->render();
        }
        return $this->sendResponse($response);
    }
}
