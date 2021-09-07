<?php

namespace App\Http\Controllers;

use App\Identity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class IdentityController extends Controller
{

    public function __construct(Identity $identity)
    {
        $this->middleware('auth');
        $this->identity = $identity;
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
                Session::put('identity_filter', $search);
            } else if( Session::get('identity_filter')) {
                $search = Session::get('identity_filter');
            }
            $data['identity'] = $this->identity->getAll('paginate', $search);
            return $this->sendCommonResponse($data, null, 'index');
        }

        $data['identity'] = $this->identity->getAll('paginate');
        return view('identity.index', $data);
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
        $identity = new Identity;
        $identity->saveIdentity($input);
        
        return $this->sendCommonResponse($data=[], 'You have successfully added identity', 'add');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Identity  $identity
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $data['identity'] = Identity::find($id);
        return $this->sendCommonResponse($data, null, 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Identity  $identity
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['identity'] = Identity::find($id);
        return $this->sendCommonResponse($data, null, 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Identity  $identity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $identity = (new Identity())->getById($id);
        $identity->nama = $request->nama;
        $identity->facebook = $request->facebook;
        $identity->whatsapp = $request->whatsapp;
        $identity->instagram = $request->instagram;
        $identity->email = $request->email;
        $identity->phone = $request->phone;
        $identity->save();

        $data['identity'] = $identity;
        return $this->sendCommonResponse($data, 'You have successfully updated identity', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Identity  $identity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Identity $identity)
    {
        //
    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'nama'=>'required',
            'content'=>'required'
        ]);
    }

    private function sendCommonResponse($data=[], $notify = '', $option = null) 
    {
        $identityObj = new Identity();
        $response = $this->processNotification($notify);
        
        if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editIdentity'] = view('identity.formedit', $data)->render();
        } 
        if ( in_array($option, ['index', 'edit', 'update'])) {
            if (empty($data['identities'])) {
                $data['identity'] = $identityObj->getAll('paginate');
            }
            $response['replaceWith']['#identityTable'] = view('identity.table', $data)->render();
        }
        return $this->sendResponse($response);
    }
}
