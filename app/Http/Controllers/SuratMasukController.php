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
use Carbon\Carbon;
use Get_field;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SuratMasukExport;

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

            $data['jenisSurat'] = JenisSurat::where('softdelete', '0')->pluck('nama', 'id');
            $data['mediaSurat'] = MediaSurat::where('softdelete', '0')->pluck('nama', 'id');

            $data['fileSurat'] = '';

            $data['unitkerjaid'] = Get_field::get_data(Auth::user()->pegawai_id, 'pegawai', 'unit_kerja_id');
        
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

        $fileSurat = $request->file('fileSurat');

        if ($fileSurat) {
            # code...



        $validateData = $request->validate([
            'fileSurat' => 'file|mimes:png,jpg,jpeg,pdf|between:0,2048',
        ],[
            'fileSurat.mimes' => 'Extensi file surat tugas atau surat izin tidak didukung',
            'fileSurat.between' => 'Ukuran file surat tugas atau surat izin max 2MB',
        ]);


            $nameGenerate = hexdec(uniqid());
            $imgExtention = strtolower($fileSurat->getClientOriginalExtension());
            $imgOriName = strtolower($fileSurat->getClientOriginalName());
            $newName = $nameGenerate.'_'.$imgExtention;
            $uploadLocation = public_path().'/document';
            $lastImage = $uploadLocation.$newName;
            $fileSurat->move($uploadLocation,$newName);
        }




        // $this->id;
        $surat = new SuratMasuk;
        $surat->no_surat = $request->no_surat;
        $surat->pegawai_id = Auth::user()->pegawai_id;
        $surat->perihal = $request->perihal;
        $surat->asal_surat = $request->asal_surat;
        $surat->tujuan_surat = '0';
        $surat->status = '1';
        $surat->tgl_surat = $request->tgl_surat;
        $surat->jenis_id = $request->jenis_id;
        $surat->media_id = $request->media_id;
        $surat->isi_ringkasan = $request->isi_ringkasan;
        $surat->file_surat = $fileSurat ? $newName : null;
        $surat->dlt = '0';
        $surat->save();
        

        $data['jenisSurat'] = JenisSurat::where('softdelete', '0')->pluck('nama', 'id');
        $data['mediaSurat'] = MediaSurat::where('softdelete', '0')->pluck('nama', 'id');

        return $this->sendCommonResponse($data, 'Anda telah berhasil menambahkan surat masuk', 'add');
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
        $data['jenisSurat'] = JenisSurat::where('softdelete', '0')->pluck('nama', 'id');
        $data['mediaSurat'] = MediaSurat::where('softdelete', '0')->pluck('nama', 'id');
        $data['fileSurat'] = Get_field::get_data($id, 'surat_masuk', 'file_surat');
        $data['unitkerjaid'] = Get_field::get_data(Auth::user()->pegawai_id, 'pegawai', 'unit_kerja_id');
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
        $this->validatorUpdate($input)->validate();
        $fileSurat = $request->file('fileSurat');

        if ($fileSurat) {
            # code...
            $nameGenerate = hexdec(uniqid());
            $imgExtention = strtolower($fileSurat->getClientOriginalExtension());
            $imgOriName = strtolower($fileSurat->getClientOriginalName());
            $newName = $nameGenerate.'_'.$imgExtention;
            $uploadLocation = public_path().'/document';
            $lastImage = $uploadLocation.$newName;
            $fileSurat->move($uploadLocation,$newName);
        }
        
        $suratMasuk = (new SuratMasuk())->getById($id);
        $suratMasuk->no_surat = $request->no_surat;
        $suratMasuk->perihal = $request->perihal;
        $suratMasuk->asal_surat = $request->asal_surat;
        $suratMasuk->tujuan_surat = '0';
        $suratMasuk->tgl_surat = $request->tgl_surat;
        $suratMasuk->jenis_id = $request->jenis_id;
        $suratMasuk->media_id = $request->media_id;
        $suratMasuk->isi_ringkasan = $request->isi_ringkasan;
        $suratMasuk->file_surat = $fileSurat ? $newName : Get_field::get_data($id, 'surat_masuk', 'file_surat');
        $suratMasuk->dlt = '0';
        $suratMasuk->save();

        $data['jenisSurat'] = JenisSurat::where('softdelete', '0')->pluck('nama', 'id');
        $data['mediaSurat'] = MediaSurat::where('softdelete', '0')->pluck('nama', 'id');
        $data['fileSurat'] = Get_field::get_data($id, 'surat_masuk', 'file_surat');
        $data['unitkerjaid'] = Get_field::get_data(Auth::user()->pegawai_id, 'pegawai', 'unit_kerja_id');
        return $this->sendCommonResponse($data, 'Anda telah berhasil memperbarui surat masuk', 'update');
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

            return $this->sendCommonResponse([], 'Anda telah berhasil menghapus surat masuk', 'delete');
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->sendCommonResponse([], ['danger'=>__('Integrity constraint violation: You Cannot delete a parent row')]);
        }
    }


    public function posisi($id)
    {


        $unit_kerja_id = Get_field::get_data(Auth::user()->pegawai_id, 'pegawai', 'unit_kerja_id');

        if ($unit_kerja_id == '1' OR $unit_kerja_id == '2') {

        $data['history_surat_masuk'] = DB::table('history_surat_masuk')
        ->select('history_surat_masuk.*')
        ->leftJoin('surat_masuk', 'history_surat_masuk.surat_masuk_id', 'surat_masuk.id')
        ->where(['history_surat_masuk.dlt'=> '0', 'history_surat_masuk.surat_masuk_id'=>$id])
        ->orderBy('history_surat_masuk.surat_masuk_model','ASC')
        ->orderBy('history_surat_masuk.id','ASC')
        ->get();

        }else{

        $data['history_surat_masuk'] = DB::table('history_surat_masuk')
        ->select('history_surat_masuk.*')
        ->leftJoin('surat_masuk', 'history_surat_masuk.surat_masuk_id', 'surat_masuk.id')
        ->where(['history_surat_masuk.dlt' => '0', 'history_surat_masuk.surat_masuk_id' => $id, 'history_surat_masuk.asal_surat' => Auth::user()->pegawai_id])
        ->orWhere(function($query) {
                $query->where('history_surat_masuk.dlt', '0')
                        ->where('history_surat_masuk.tujuan_surat', Auth::user()->pegawai_id);
                })
        ->orderBy('history_surat_masuk.surat_masuk_model','ASC')
        ->orderBy('history_surat_masuk.id','ASC')
        ->get();


        }


        return $this->sendCommonResponse($data, null, 'posisi');
    }


    public function disposisi($id)
    {
        
        $data['perintahDisposisi'] =  DB::table('perintah_disposisi')->where([['softdelete' , '0'],['id', '>', '1'],['id', '<', '5']])->pluck('nama', 'id');


        $data['pegawai'] = Pegawai::select(DB::raw("CONCAT(pegawai.nama,' [',unit_kerja.nama, '] [', jabatan.nama,']') AS namajabatanpegawai"), 'pegawai.id')
                            ->leftJoin('unit_kerja', 'unit_kerja.id', 'pegawai.unit_kerja_id')
                            ->leftJoin('jabatan', 'jabatan.id', 'pegawai.jabatan_id')
                            ->where('pegawai.softdelete', '0')
                            ->where('pegawai.id', '!=' , Auth::user()->pegawai_id)
                            ->where('pegawai.id', '!=' , '1')
                            ->orderBy('pegawai.unit_kerja_id','ASC')
                            ->orderBy('pegawai.jabatan_id','ASC')
                            ->get()->pluck('namajabatanpegawai', 'id');


        $data['unitkerjaid'] = Get_field::get_data(Auth::user()->pegawai_id, 'pegawai', 'unit_kerja_id');

        $unit_kerja_id = Get_field::get_data(Auth::user()->pegawai_id, 'pegawai', 'unit_kerja_id');

        if ($unit_kerja_id == '1' OR $unit_kerja_id == '2') {

        $data['history_surat_masuk'] = DB::table('history_surat_masuk')
        ->select('history_surat_masuk.*')
        ->leftJoin('surat_masuk', 'history_surat_masuk.surat_masuk_id', 'surat_masuk.id')
        ->where(['history_surat_masuk.dlt'=> '0', 'history_surat_masuk.surat_masuk_id'=>$id])
        ->orderBy('history_surat_masuk.surat_masuk_model','ASC')
        ->orderBy('history_surat_masuk.id','ASC')
        ->get();

        }else{

        $data['history_surat_masuk'] = DB::table('history_surat_masuk')
        ->select('history_surat_masuk.*')
        ->leftJoin('surat_masuk', 'history_surat_masuk.surat_masuk_id', 'surat_masuk.id')
        ->where(['history_surat_masuk.dlt' => '0', 'history_surat_masuk.surat_masuk_id' => $id, 'history_surat_masuk.asal_surat' => Auth::user()->pegawai_id])
        ->orWhere(function($query) {
                $query->where('history_surat_masuk.dlt', '0')
                        ->where('history_surat_masuk.tujuan_surat', Auth::user()->pegawai_id);
                })
        ->orderBy('history_surat_masuk.surat_masuk_model','ASC')
        ->orderBy('history_surat_masuk.id','ASC')
        ->get();


        }






        $data['surat_masuk_id'] = $id;

        return $this->sendCommonResponse($data, null, 'disposisi');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDisposisi(Request $request)
    {
        //
        // dd($request->all());
        $input = $request->all();
        $this->validatorDisposisi($input)->validate();

        $fileSurat = $request->file('fileSurat');

        if ($fileSurat) {
            # code...
            $nameGenerate = hexdec(uniqid());
            $imgExtention = strtolower($fileSurat->getClientOriginalExtension());
            $imgOriName = strtolower($fileSurat->getClientOriginalName());
            $newName = $nameGenerate.'_'.$imgExtention;
            $uploadLocation = public_path().'/document';
            $lastImage = $uploadLocation.$newName;
            $fileSurat->move($uploadLocation,$newName);
        }

        if ($request->status == '3') {

        $unit_kerja_id = Get_field::get_data(Auth::user()->pegawai_id, 'pegawai', 'unit_kerja_id');

        if ($unit_kerja_id == '1' OR $unit_kerja_id == '2') {
            DB::table('surat_masuk')->where('id', $request->surat_masuk_id)->update([
            'status' => $request->status,
            ]);

        }

            DB::table('surat_masuk_laporan')->insert([

                'surat_masuk_id' => $request->surat_masuk_id,
                'pegawai_id' => Get_field::get_data($request->surat_masuk_id, 'surat_masuk', 'pegawai_id'),
                'status' => $request->status,
                'no_surat' => Get_field::get_data($request->surat_masuk_id, 'surat_masuk', 'no_surat'),
                'perihal' => Get_field::get_data($request->surat_masuk_id, 'surat_masuk', 'perihal'),
                'asal_surat' => Get_field::get_data($request->surat_masuk_id, 'surat_masuk', 'asal_surat'),
                'tujuan_surat' => Get_field::get_data($request->surat_masuk_id, 'surat_masuk', 'tujuan_surat'),
                'isi_ringkasan' => Get_field::get_data($request->surat_masuk_id, 'surat_masuk', 'isi_ringkasan'),
                'tgl_surat' => Get_field::get_data($request->surat_masuk_id, 'surat_masuk', 'tgl_surat'),
                'jenis_id' => Get_field::get_data($request->surat_masuk_id, 'surat_masuk', 'jenis_id'),
                'media_id' => Get_field::get_data($request->surat_masuk_id, 'surat_masuk', 'media_id'),
                'file_surat' => Get_field::get_data($request->surat_masuk_id, 'surat_masuk', 'file_surat'),
                'laporan' => '1',
                'status_laporan_id' => '1',
                'laporan_unit_kerja_id' => Get_field::get_data(Auth::user()->pegawai_id, 'pegawai', 'unit_kerja_id'),
                'laporan_pegawai_id' => Auth::user()->pegawai_id,
                'dlt' => '0',
            ]);
            

        }

        if ($request->status == '2' OR $request->status == '4') {

            DB::table('surat_masuk')->where('id', $request->surat_masuk_id)->update([
            'status' => $request->status,
            ]);

        }



        $cari_model_surat = DB::table('history_surat_masuk')
            ->select('surat_masuk_model')
            ->where('surat_masuk_id', '=', $request->surat_masuk_id)
            ->where('tujuan_surat', '=', Auth::user()->pegawai_id)
            ->where('dlt','0')->first();

        if(!empty($cari_model_surat)){
            $surat_masuk_model = $cari_model_surat->surat_masuk_model;
        }else{
            $hitung_masuk_model = DB::table('history_surat_masuk')
             ->where('pegawai_id', '=', Auth::user()->pegawai_id)
             ->where('surat_masuk_id', '=', $request->surat_masuk_id)
             ->count();

             $surat_masuk_model = $hitung_masuk_model + 1;
        }

        DB::table('history_surat_masuk')->insert([
            'surat_masuk_id' => $request->surat_masuk_id,
            'surat_masuk_model' => $surat_masuk_model,
            'pegawai_id' => Auth::user()->pegawai_id,
            'asal_surat' => Auth::user()->pegawai_id,
            'tujuan_surat' => $request->tujuan_surat,
            'tanggal' => date('Y-m-d'),
            'catatan_penting' => $request->catatan_penting,
            'status' => $request->status,
            'file_surat' => $fileSurat ? $newName : null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'dlt' => '0',
            'unit_id' => Get_field::get_data(Auth::user()->pegawai_id, 'pegawai', 'unit_kerja_id'),
        ]);

        $data['pegawai'] = Pegawai::select(DB::raw("CONCAT(pegawai.nama,' [',unit_kerja.nama, '] [', jabatan.nama,']') AS namajabatanpegawai"), 'pegawai.id')
                            ->leftJoin('unit_kerja', 'unit_kerja.id', 'pegawai.unit_kerja_id')
                            ->leftJoin('jabatan', 'jabatan.id', 'pegawai.jabatan_id')
                            ->where('pegawai.softdelete', '0')
                            ->where('pegawai.id', '!=' , Auth::user()->pegawai_id)
                            ->where('pegawai.id', '!=' , '1')
                            ->orderBy('pegawai.jabatan_id','ASC')
                            ->orderBy('pegawai.unit_kerja_id','ASC')
                            ->get()->pluck('namajabatanpegawai', 'id');


        $data['jenisSurat'] = JenisSurat::where('softdelete', '0')->pluck('nama', 'id');
        $data['mediaSurat'] = MediaSurat::where('softdelete', '0')->pluck('nama', 'id');

        $unit_kerja_id = Get_field::get_data(Auth::user()->pegawai_id, 'pegawai', 'unit_kerja_id');

        if ($unit_kerja_id == '1' OR $unit_kerja_id == '2') {

        $data['history_surat_masuk'] = DB::table('history_surat_masuk')
        ->select('history_surat_masuk.*')
        ->leftJoin('surat_masuk', 'history_surat_masuk.surat_masuk_id', 'surat_masuk.id')
        ->where(['history_surat_masuk.dlt'=> '0', 'history_surat_masuk.surat_masuk_id'=>$request->surat_masuk_id])
        ->orderBy('history_surat_masuk.surat_masuk_model','ASC')
        ->orderBy('history_surat_masuk.id','ASC')
        ->get();

        }else{

        $data['history_surat_masuk'] = DB::table('history_surat_masuk')
        ->select('history_surat_masuk.*')
        ->leftJoin('surat_masuk', 'history_surat_masuk.surat_masuk_id', 'surat_masuk.id')
        ->where(['history_surat_masuk.dlt' => '0', 'history_surat_masuk.surat_masuk_id' => $request->surat_masuk_id, 'history_surat_masuk.asal_surat' => Auth::user()->pegawai_id])
        ->orWhere(function($query) {
                $query->where('history_surat_masuk.dlt', '0')
                        ->where('history_surat_masuk.tujuan_surat', Auth::user()->pegawai_id);
                })
        ->orderBy('history_surat_masuk.surat_masuk_model','ASC')
        ->orderBy('history_surat_masuk.id','ASC')
        ->get();


        }

        $data['perintahDisposisi'] =  DB::table('perintah_disposisi')->where([['softdelete' , '0'],['id', '<', '4']])->pluck('nama', 'id');

        $data['surat_masuk_id'] = $request->surat_masuk_id;

        $data['unitkerjaid'] = Get_field::get_data(Auth::user()->pegawai_id, 'pegawai', 'unit_kerja_id');

        return $this->sendCommonResponse($data, 'Anda telah berhasil memperbarui surat masuk', 'disposisi');
    }


    protected function validatorDisposisi(Array $data)
    {
        return Validator::make($data, [
            'catatan_penting'=>'required',
            'status'=>'required',
        ]);
    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'no_surat'=>'required',
            'perihal'=>'required',
            'asal_surat'=>'required',
            'isi_ringkasan'=>'required',
            'tgl_surat'=>'required',
            'jenis_id'=>'required',
            'media_id'=>'required',
            'fileSurat'=>'required',
            
        ]);
    }

        protected function validatorUpdate(Array $data)
    {
        return Validator::make($data, [
            'no_surat'=>'required',
            'perihal'=>'required',
            'asal_surat'=>'required',
            'isi_ringkasan'=>'required',
            'tgl_surat'=>'required',
            'jenis_id'=>'required',
            'media_id'=>'required',
            
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
        } else if ($option == 'disposisi') {
            $response['replaceWith']['#disposisiSuratMasuk'] = view('surat_masuk.disposisi', $data)->render();
        } 
        if ( in_array($option, ['index', 'add', 'update', 'delete', 'import','disposisi'])) {
            if (empty($data['surat_masuk'])) {
                $data['surat_masuk'] = $suratMasukObj->getAll('paginate');
                $data['unitkerjaid'] = Get_field::get_data(Auth::user()->pegawai_id, 'pegawai', 'unit_kerja_id');
            }
            $response['replaceWith']['#suratMasukTable'] = view('surat_masuk.table', $data)->render();
        }
        return $this->sendResponse($response);
    }

    public function autocomplete(Request $request){
        return SuratMasuk::select('asal_surat')
        ->where('asal_surat', 'like', "%{$request->term}%")
        ->groupBy('asal_surat')
        ->pluck('asal_surat');
    }

    public function excel(Request $request)
    {
        return Excel::download(new SuratMasukExport, 'surat_masuk_uvers_'.date('His').'.xlsx');
    }



}
