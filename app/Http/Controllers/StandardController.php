<?php

namespace App\Http\Controllers;

use App\Standard;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class StandardController extends Controller
{

    public function __construct(Standard $standard)
    {
        $this->middleware('auth');
        $this->standard = $standard;
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
                Session::put('standard_filter', $search);
            } else if( Session::get('standard_filter')) {
                $search = Session::get('standard_filter');
            }
            $data['standards'] = $this->standard->getAll('paginate', $search);

            return $this->sendCommonResponse($data, null, 'index');
        }

        $data['standards'] = $this->standard->getAll('paginate');
        return view('standard.index', $data);
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
        $input = $request->all();
        $this->validator($input)->validate();
        $standards = new Standard;
        $standards->saveStandard($input);
        
        return $this->sendCommonResponse($data=[], 'You have successfully added standard', 'add');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Standard  $standard
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $data['standard'] = Standard::find($id);
        return $this->sendCommonResponse($data, null, 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Standard  $standard
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['standard'] = Standard::find($id);
        return $this->sendCommonResponse($data, null, 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Standard  $standard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        //
        $input = $request->all();
        $this->validator($input)->validate();
        $standards = (new Standard())->getById($id);
        
        $standards->saveStandard($input);
        $data['standard'] = $standards;
        return $this->sendCommonResponse($data, 'You have successfully updated standard', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Standard  $standard
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $standard = Standard::find($id);
            $standard->dlt = '1';
            $standard->save();

            return $this->sendCommonResponse([], 'You have successfully deleted standard', 'delete');
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->sendCommonResponse([], ['danger'=>__('Integrity constraint violation: You Cannot delete a parent row')]);
        }
    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'standard'=>'required|max:185',
        ]);
    }

    private function sendCommonResponse($data=[], $notify = '', $option = null) 
    {
        $standardObj = new Standard();
        $response = $this->processNotification($notify);
        
        if ($option == 'add') {
            $response['replaceWith']['#addStandard'] = view('standard.formadd', $data)->render();
        } else if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editStandard'] = view('standard.formedit', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showStandard'] = view('standard.profile', $data)->render();
        }
        if ( in_array($option, ['index', 'add', 'update', 'delete', 'import'])) {
            if (empty($data['standards'])) {
                $data['standards'] = $standardObj->getAll('paginate');
            }
            $response['replaceWith']['#standardTable'] = view('standard.table', $data)->render();
        }
        return $this->sendResponse($response);
    }
}
