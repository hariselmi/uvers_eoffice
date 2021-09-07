<?php

namespace App\Http\Controllers;

use App\Sliders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SlidersController extends Controller
{

    public function __construct(sliders $sliders)
    {
        $this->middleware('auth');
        $this->sliders = $sliders;
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
                Session::put('sliders_filter', $search);
            } else if( Session::get('sliders_filter')) {
                $search = Session::get('sliders_filter');
            }
            $data['sliders'] = $this->sliders->getAll('paginate', $search);
            return $this->sendCommonResponse($data, null, 'index');
        }

        $data['sliders'] = $this->sliders->getAll('paginate');
        return view('sliders.index', $data);

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
        $sliders = new sliders;
        $sliders->saveSliders($input);
        
        return $this->sendCommonResponse($data=[], 'You have successfully added sliders', 'add');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\sliders  $sliders
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $data['sliders'] = sliders::find($id);
        return $this->sendCommonResponse($data, null, 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sliders  $sliders
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['slider'] = Sliders::find($id);
        return $this->sendCommonResponse($data, null, 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sliders  $sliders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $imgNewName = $request->Oldthumbnail;

        if ($request->file('thumbnail')) {
            # code...

            $thumbnail =  $request->file('thumbnail');

            $nameGenerate = hexdec(uniqid());
            $imgName = strtolower($thumbnail->getClientOriginalName());
            $imgNewName = $nameGenerate.'_'.$imgName;
            $uploadLocation = public_path().'/images/slider';
            # code...
            $thumbnail->move($uploadLocation,$imgNewName);
        }

        $sliders = (new Sliders())->getById($id);
        $sliders->title = $request->title;
        $sliders->status = $request->status;
        $sliders->thumbnail = $imgNewName;
        $sliders->save();

        $data['slider'] = $sliders;
         
        return $this->sendCommonResponse($data, 'You have successfully updated sliders', 'update');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sliders  $sliders
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //
        try {
            $sliders = Sliders::find($id);
            $sliders->dlt = '1';
            $sliders->save();

            return $this->sendCommonResponse([], 'You have successfully deleted slider', 'delete');
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->sendCommonResponse([], ['danger'=>__('Integrity constraint violation: You Cannot delete a parent row')]);
        }
    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'thumbnail'=>'mimes:jpeg,bmp,png|max:5120kb',
            'status'=>'required',
            'title'=>'required',
        ]);
    }

    private function sendCommonResponse($data=[], $notify = '', $option = null) 
    {


        $slidersObj = new Sliders();

        $response = $this->processNotification($notify);
        
        if ($option == 'add') {
            $response['replaceWith']['#addSliders'] = view('sliders.formadd', $data)->render();
        } else if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editSliders'] = view('sliders.formedit', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showSliders'] = view('sliders.profile', $data)->render();
        }

        


        if ( in_array($option, ['index', 'add', 'update', 'delete', 'import'])) {
            if (empty($data['sliders'])) {
                $data['sliders'] = $slidersObj->getAll('paginate');
            }
                    
            $response['replaceWith']['#slidersTable'] = view('sliders.table', $data)->render();
        }
        return $this->sendResponse($response);
    }
}
