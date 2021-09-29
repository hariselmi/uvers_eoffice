<?php

namespace App\Http\Controllers;

use App\MediaSurat;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class MediaSuratController extends Controller
{

    public function __construct(MediaSurat $media_surat)
    {
        $this->middleware('auth');
        $this->media_surat = $media_surat;
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
                Session::put('media_surat_filter', $search);
            } else if( Session::get('media_surat_filter')) {
                $search = Session::get('media_surat_filter');
            }
            $data['semua_media_surat'] = $this->media_surat->getAll('paginate', $search);

            return $this->sendCommonResponse($data, null, 'index');
        }

        $data['semua_media_surat'] = $this->media_surat->getAll('paginate');
        return view('media_surat.index', $data);
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
        $semua_media_surat = new MediaSurat;
        $semua_media_surat->SaveMediaSurat($input);
        
        return $this->sendCommonResponse($data=[], 'Data berhasil ditambahkan', 'add');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MediaSurat  $media_surat
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $data['media_surat'] = MediaSurat::find($id);
        return $this->sendCommonResponse($data, null, 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MediaSurat  $media_surat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['media_surat'] = MediaSurat::find($id);
        return $this->sendCommonResponse($data, null, 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MediaSurat  $media_surat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //
        $input = $request->all();
        $this->validator($input)->validate();
        $semua_media_surat = (new MediaSurat())->getById($id);
        
        $semua_media_surat->SaveMediaSurat($input);
        $data['media_surat'] = $semua_media_surat;
        return $this->sendCommonResponse($data, 'Data berhasil diedit', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MediaSurat  $media_surat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $media_surat = MediaSurat::find($id);
            $media_surat->updated_at = date('Y-m-d H:i:s');
            $media_surat->softdelete = '1';
            $media_surat->save();

            return $this->sendCommonResponse([], 'Data berhasil dihapus', 'delete');
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->sendCommonResponse([], ['danger'=>__('Integrity constraint violation: You Cannot delete a parent row')]);
        }
    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'nama'=>'required|max:185',
        ]);
    }

    private function sendCommonResponse($data=[], $notify = '', $option = null) 
    {
        $media_suratObj = new MediaSurat();
        $response = $this->processNotification($notify);
        
        if ($option == 'add') {
            $response['replaceWith']['#addMediaSurat'] = view('media_surat.formadd', $data)->render();
        } else if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editMediaSurat'] = view('media_surat.formedit', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showMediaSurat'] = view('media_surat.profile', $data)->render();
        }
        if ( in_array($option, ['index', 'add', 'update', 'delete', 'import'])) {
            if (empty($data['semua_media_surat'])) {
                $data['semua_media_surat'] = $media_suratObj->getAll('paginate');
            }
            $response['replaceWith']['#MediaSuratTable'] = view('media_surat.table', $data)->render();
        }
        return $this->sendResponse($response);
    }
}
