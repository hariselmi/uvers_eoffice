<?php

namespace App\Http\Controllers;

use App\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{

    public function __construct(Pages $pages)
    {
        $this->middleware('auth');
        $this->pages = $pages;
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
                Session::put('pages_filter', $search);
            } else if( Session::get('pages_filter')) {
                $search = Session::get('pages_filter');
            }
            $data['pages'] = $this->pages->getAll('paginate', $search);
            return $this->sendCommonResponse($data, null, 'index');
        }

        $data['pages'] = $this->pages->getAll('paginate');
        return view('pages.index', $data);
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
        $pages = new Pages;
        $pages->savePages($input);
        
        return $this->sendCommonResponse($data=[], 'You have successfully added pages', 'add');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $data['pages'] = Pages::find($id);
        return $this->sendCommonResponse($data, null, 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['pages'] = Pages::find($id);
        return $this->sendCommonResponse($data, null, 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $pages = (new Pages())->getById($id);
        $pages->nama = $request->nama;
        $pages->content = $request->content;
        $pages->save();

        $data['pages'] = $pages;
        return $this->sendCommonResponse($data, 'You have successfully updated pages', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pages $pages)
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
        $pagesObj = new Pages();
        $response = $this->processNotification($notify);
        
        if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editPages'] = view('pages.formedit', $data)->render();
        } 
        if ( in_array($option, ['index', 'edit' , 'update'])) {
            if (empty($data['pagess'])) {
                $data['pages'] = $pagesObj->getAll('paginate');
            }
            $response['replaceWith']['#pagesTable'] = view('pages.table', $data)->render();
        }
        return $this->sendResponse($response);
    }
}
