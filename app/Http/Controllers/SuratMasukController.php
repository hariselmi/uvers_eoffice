<?php

namespace App\Http\Controllers;

use App\SuratMasuk;
use App\Pegawai;
use App\JenisSurat;
use App\PrioritasSurat;
use App\SifatSurat;
use App\MediaSurat;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SuratMasukController extends Controller
{

    public function __construct(SuratMasuk $suratMasuk)
    {
        $this->middleware('auth');
        $this->suratMasuk = $suratMasuk;
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
                Session::put('suratMasuk_filter', $search);
            } else if( Session::get('suratMasuk_filter')) {
                $search = Session::get('suratMasuk_filter');
            }
            $data['surat_masuk'] = $this->suratMasuk->getAll('paginate', $search);

            return $this->sendCommonResponse($data, null, 'index');
        }

        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;

            $data['pegawai'] = Pegawai::where('softdelete', '0')->pluck('nama', 'id');
            $data['jenisSurat'] = JenisSurat::where('softdelete', '0')->pluck('nama', 'id');
            $data['prioritasSurat'] = PrioritasSurat::where('softdelete', '0')->pluck('nama', 'id');
            $data['sifatSurat'] = SifatSurat::where('softdelete', '0')->pluck('nama', 'id');
            $data['mediaSurat'] = MediaSurat::where('softdelete', '0')->pluck('nama', 'id');

            // $data['users'] = User::where('role', 'suratMasuk')->pluck('name', 'id');
        
            $data['surat_masuk'] = $this->suratMasuk->getAll('paginate');
        return view('surat_masuk.index', $data);
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
        $suratMasuk = new SuratMasuk;
        $suratMasuk->saveSuratMasuk($input);
        

        $data['pegawai'] = Pegawai::where('softdelete', '0')->pluck('nama', 'id');
        $data['jenisSurat'] = JenisSurat::where('softdelete', '0')->pluck('nama', 'id');
        $data['prioritasSurat'] = PrioritasSurat::where('softdelete', '0')->pluck('nama', 'id');
        $data['sifatSurat'] = SifatSurat::where('softdelete', '0')->pluck('nama', 'id');
        $data['mediaSurat'] = MediaSurat::where('softdelete', '0')->pluck('nama', 'id');
        // $data['users'] = DB::table('users')->where('role', 'suratMasuk')->pluck('name', 'id');
        return $this->sendCommonResponse($data, 'You have successfully added suratMasuk', 'add');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $data['surat_masuk'] = SuratMasuk::find($id);
        return $this->sendCommonResponse($data, null, 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['surat_masuk'] = SuratMasuk::find($id);
        $data['pegawai'] = Pegawai::where('softdelete', '0')->pluck('nama', 'id');
        $data['jenisSurat'] = JenisSurat::where('softdelete', '0')->pluck('nama', 'id');
        $data['prioritasSurat'] = PrioritasSurat::where('softdelete', '0')->pluck('nama', 'id');
        $data['sifatSurat'] = SifatSurat::where('softdelete', '0')->pluck('nama', 'id');
        $data['mediaSurat'] = MediaSurat::where('softdelete', '0')->pluck('nama', 'id');
        return $this->sendCommonResponse($data, null, 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        //
        $input = $request->all();
        $this->validator($input)->validate();
        $suratMasuk = (new SuratMasuk())->getById($id);
        
        $suratMasuk->saveSuratMasuk($input);

        $data['pegawai'] = Pegawai::where('softdelete', '0')->pluck('nama', 'id');
        $data['jenisSurat'] = JenisSurat::where('softdelete', '0')->pluck('nama', 'id');
        $data['prioritasSurat'] = PrioritasSurat::where('softdelete', '0')->pluck('nama', 'id');
        $data['sifatSurat'] = SifatSurat::where('softdelete', '0')->pluck('nama', 'id');
        $data['mediaSurat'] = MediaSurat::where('softdelete', '0')->pluck('nama', 'id');
        return $this->sendCommonResponse($data, 'You have successfully updated suratMasuk', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $suratMasuk = SuratMasuk::find($id);
            $suratMasuk->dlt = '1';
            $suratMasuk->save();

            return $this->sendCommonResponse([], 'You have successfully deleted suratMasuk', 'delete');
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->sendCommonResponse([], ['danger'=>__('Integrity constraint violation: You Cannot delete a parent row')]);
        }
    }


    public function posisi($id)
    {
        //
        $data['history_surat_masuk'] = DB::table('history_surat_masuk')->where(['dlt'=> '0', 'surat_masuk_id'=>$id])->get();
        return $this->sendCommonResponse($data, null, 'posisi');
    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'no_surat'=>'required',
            'perihal'=>'required',
            'asal_surat'=>'required',
            'tujuan_surat'=>'required',
            'isi_ringkasan'=>'required',
            'tgl_surat'=>'required',
            'jenis_id'=>'required',
            'prioritas_id'=>'required',
            'sifat_id'=>'required',
            'media_id'=>'required',
            'lokasi_penyimpanan'=>'required',
        ]);
    }

    private function sendCommonResponse($data=[], $notify = '', $option = null) 
    {
        $suratMasukObj = new SuratMasuk();
        $response = $this->processNotification($notify);
        
        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;

        
        if ($option == 'add') {
            $response['replaceWith']['#addSuratMasuk'] = view('surat_masuk.formadd', $data)->render();
        } else if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editSuratMasuk'] = view('surat_masuk.formedit', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showSuratMasuk'] = view('surat_masuk.profile', $data)->render();
        } else if ($option == 'posisi') {
            $response['replaceWith']['#posisiSuratMasuk'] = view('surat_masuk.posisi', $data)->render();
        } 
        if ( in_array($option, ['index', 'add', 'update', 'delete', 'import'])) {
            if (empty($data['surat_masuk'])) {
                $data['surat_masuk'] = $suratMasukObj->getAll('paginate');
            }
            $response['replaceWith']['#suratMasukTable'] = view('surat_masuk.table', $data)->render();
        }
        return $this->sendResponse($response);
    }

}
