<?php

namespace App\Http\Controllers;

use App\SifatSurat;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SifatSuratController extends Controller
{

    public function __construct(SifatSurat $sifat_surat)
    {
        $this->middleware('auth');
        $this->sifat_surat = $sifat_surat;
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
                Session::put('sifat_surat_filter', $search);
            } else if( Session::get('sifat_surat_filter')) {
                $search = Session::get('sifat_surat_filter');
            }
            $data['semua_sifat_surat'] = $this->sifat_surat->getAll('paginate', $search);

            return $this->sendCommonResponse($data, null, 'index');
        }

        $data['semua_sifat_surat'] = $this->sifat_surat->getAll('paginate');
        return view('sifat_surat.index', $data);
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
        $semua_sifat_surat = new SifatSurat;
        $semua_sifat_surat->SaveSifatSurat($input);
        
        return $this->sendCommonResponse($data=[], 'Data berhasil ditambahkan', 'add');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SifatSurat  $sifat_surat
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $data['sifat_surat'] = SifatSurat::find($id);
        return $this->sendCommonResponse($data, null, 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SifatSurat  $sifat_surat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['sifat_surat'] = SifatSurat::find($id);
        return $this->sendCommonResponse($data, null, 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SifatSurat  $sifat_surat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //
        $input = $request->all();
        $this->validator($input)->validate();
        $semua_sifat_surat = (new SifatSurat())->getById($id);
        
        $semua_sifat_surat->SaveSifatSurat($input);
        $data['sifat_surat'] = $semua_sifat_surat;
        return $this->sendCommonResponse($data, 'Data berhasil diedit', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SifatSurat  $sifat_surat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $sifat_surat = SifatSurat::find($id);
            $sifat_surat->updated_at = date('Y-m-d H:i:s');
            $sifat_surat->softdelete = '1';
            $sifat_surat->save();

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
        $sifat_suratObj = new SifatSurat();
        $response = $this->processNotification($notify);
        
        if ($option == 'add') {
            $response['replaceWith']['#addSifatSurat'] = view('sifat_surat.formadd', $data)->render();
        } else if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editSifatSurat'] = view('sifat_surat.formedit', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showSifatSurat'] = view('sifat_surat.profile', $data)->render();
        }
        if ( in_array($option, ['index', 'add', 'update', 'delete', 'import'])) {
            if (empty($data['semua_sifat_surat'])) {
                $data['semua_sifat_surat'] = $sifat_suratObj->getAll('paginate');
            }
            $response['replaceWith']['#SifatSuratTable'] = view('sifat_surat.table', $data)->render();
        }
        return $this->sendResponse($response);
    }
}
