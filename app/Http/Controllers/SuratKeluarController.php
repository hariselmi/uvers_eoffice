<?php

namespace App\Http\Controllers;

use App\SuratKeluar;
use App\Pegawai;
use App\JenisSurat;
use App\PrioritasSurat;
use App\SifatSurat;
use App\UnitKerja;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Get_field;

class SuratKeluarController extends Controller
{

    public function __construct(SuratKeluar $suratKeluar)
    {
        $this->middleware('auth');
        $this->suratKeluar = $suratKeluar;
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
                Session::put('suratKeluar_filter', $search);
            } else if( Session::get('suratKeluar_filter')) {
                $search = Session::get('suratKeluar_filter');
            }
            $data['semua_surat_keluar'] = $this->suratKeluar->getAll('paginate', $search);

            return $this->sendCommonResponse($data, null, 'index');
        }

        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;

        $data['pegawaiID'] = Auth::user()->pegawai_id;

            $data['jenisSurat'] = JenisSurat::where('softdelete', '0')->pluck('nama', 'id');

            $data['unitKerja'] = UnitKerja::where('softdelete', '0')->where('id', '!=' , '1')->pluck('nama', 'id');
        
            $data['semua_surat_keluar'] = $this->suratKeluar->getAll('paginate');

            $data['fileSurat'] = '';

        return view('surat_keluar.index', $data);
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

        $validateData = $request->validate([
            'fileSurat' => 'file|mimes:png,jpg,jpeg,pdf,doc,docx,xls,xlsx|between:0,2048',
        ],[
            'fileSurat.mimes' => 'Extensi file unggahan tidak didukung',
            'fileSurat.between' => 'Ukuran file unggahan max 2MB',
        ]);

            # code...
            $nameGenerate = hexdec(uniqid());
            $imgExtention = strtolower($fileSurat->getClientOriginalExtension());
            $imgOriName = strtolower($fileSurat->getClientOriginalName());
            $newName = $nameGenerate.'_'.$imgExtention;
            $uploadLocation = public_path().'/document';
            $lastImage = $uploadLocation.$newName;
            $fileSurat->move($uploadLocation,$newName);
        }


        // $this->id;
        $surat = new SuratKeluar;
        $surat->no_surat = $request->no_surat;
        $surat->pegawai_id = Auth::user()->pegawai_id;
        $surat->perihal = $request->perihal;
        $surat->asal_surat = Auth::user()->pegawai_id;
        $surat->status = '1';
        $surat->unit_kerja_id = Get_field::get_data(Auth::user()->pegawai_id, 'pegawai', 'unit_kerja_id');
        $surat->tujuan_surat = $request->tujuan_surat;
        $surat->tgl_surat = $request->tgl_surat;
        $surat->jenis_id = $request->jenis_id;
        $surat->isi_ringkasan = $request->isi_ringkasan;
        $surat->laporan_unit_kerja_id = Get_field::get_data(Auth::user()->pegawai_id, 'pegawai', 'unit_kerja_id');
        $surat->laporan_pegawai_id = Auth::user()->pegawai_id;
        $surat->file_surat = $fileSurat ? $newName : null;
        $surat->dlt = '0';
        $surat->save();

        $data['jenisSurat'] = JenisSurat::where('softdelete', '0')->pluck('nama', 'id');

        $data['pegawaiID'] = Auth::user()->pegawai_id;

        $data['unitKerja'] = UnitKerja::where('softdelete', '0')->where('id', '!=' , '1')->pluck('nama', 'id');


        return $this->sendCommonResponse($data, 'Anda telah berhasil menambahkan surat keluar', 'add');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $data['surat_keluar'] = SuratKeluar::find($id);
        $data['jenisSurat'] = JenisSurat::where('softdelete', '0')->pluck('nama', 'id');

        $data['pegawaiID'] = Auth::user()->pegawai_id;
        $data['unitKerja'] = UnitKerja::where('softdelete', '0')->pluck('nama', 'id');
        return $this->sendCommonResponse($data, null, 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        //
        $data['surat_keluar'] = SuratKeluar::find($id);
        $data['jenisSurat'] = JenisSurat::where('softdelete', '0')->pluck('nama', 'id');
        $data['pegawaiID'] = Auth::user()->pegawai_id;

        $data['unitKerja'] = UnitKerja::where('softdelete', '0')->where('id', '!=' , '1')->pluck('nama', 'id');

        $data['fileSurat'] = Get_field::get_data($id, 'surat_keluar', 'file_surat');

        return $this->sendCommonResponse($data, null, 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        //
        $input = $request->all();
        $this->validator($input)->validate();
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
        
        $suratKeluar = (new SuratKeluar())->getById($id);
        $suratKeluar->no_surat = $request->no_surat;
        $suratKeluar->perihal = $request->perihal;
        $suratKeluar->asal_surat = Auth::user()->pegawai_id;
        $suratKeluar->tujuan_surat = $request->tujuan_surat;
        $suratKeluar->tgl_surat = $request->tgl_surat;
        $surat->unit_kerja_id = Get_field::get_data(Auth::user()->pegawai_id, 'pegawai', 'unit_kerja_id');
        $suratKeluar->jenis_id = $request->jenis_id;
        $suratKeluar->isi_ringkasan = $request->isi_ringkasan;
        $suratKeluar->file_surat = $fileSurat ? $newName : Get_field::get_data($id, 'surat_keluar', 'file_surat');
        $suratKeluar->dlt = '0';
        $suratKeluar->save();

        $data['surat_keluar'] = SuratKeluar::find($id);
        $data['jenisSurat'] = JenisSurat::where('softdelete', '0')->pluck('nama', 'id');
        $data['pegawaiID'] = Auth::user()->pegawai_id;
        $data['unitKerja'] = UnitKerja::where('softdelete', '0')->where('id', '!=' , '1')->pluck('nama', 'id');

        $data['fileSurat'] = Get_field::get_data($id, 'surat_keluar', 'file_surat');

        return $this->sendCommonResponse($data, 'Anda telah berhasil memperbarui surat keluar', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $suratKeluar = SuratKeluar::find($id);
            $suratKeluar->dlt = '1';
            $suratKeluar->save();

            return $this->sendCommonResponse([], 'Anda telah berhasil menghapus surat keluar', 'delete');
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->sendCommonResponse([], ['danger'=>__('Integrity constraint violation: You Cannot delete a parent row')]);
        }
    }


    public function posisi($id)
    {
        //
        $data['history_surat_keluar'] = DB::table('history_surat_keluar')
        ->select('history_surat_keluar.*')
        ->leftJoin('surat_keluar', 'history_surat_keluar.surat_keluar_id', 'surat_keluar.id')
        ->where(['history_surat_keluar.dlt'=> '0', 'history_surat_keluar.surat_keluar_id'=>$id])
        ->get();

        return $this->sendCommonResponse($data, null, 'posisi');
    }


    public function disposisi($id)
    {
        
        $data['perintahDisposisi'] =  DB::table('status_keluar')->where([['softdelete' , '0'],['id', '<', '5']])->pluck('nama', 'id');

        $data['pegawai'] = Pegawai::where('softdelete', '0')->pluck('nama', 'id');

        $data['statusNow'] = Get_field::get_data($id, 'surat_keluar', 'status');


        $data['history_surat_keluar'] = DB::table('history_surat_keluar')
        ->select('history_surat_keluar.*')
        ->where(['history_surat_keluar.dlt'=> '0', 'history_surat_keluar.surat_keluar_id'=>$id])
        ->get();

        $data['pegawaiID'] = Auth::user()->pegawai_id;

        $data['surat_keluar_id'] = $id;

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

        //update surat keluar
        if($request->status == '3'){

            DB::table('surat_keluar')->where('id', $request->surat_keluar_id)->update([
                'status' => $request->status,
                'laporan' => '1',
                'status_laporan_id' => '1'
            ]);
        }else{

            DB::table('surat_keluar')->where('id', $request->surat_keluar_id)->update([
                'status' => $request->status
            ]);
        }

    



        DB::table('history_surat_keluar')->insert([
            'surat_keluar_id' => $request->surat_keluar_id,
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

        $data['pegawai'] = Pegawai::where('softdelete', '0')->pluck('nama', 'id');
        $data['jenisSurat'] = JenisSurat::where('softdelete', '0')->pluck('nama', 'id');
        $data['pegawaiID'] = Auth::user()->pegawai_id;

        $data['unitKerja'] = UnitKerja::where('softdelete', '0')->where('id', '!=' , '1')->pluck('nama', 'id');

        $data['history_surat_keluar'] = DB::table('history_surat_keluar')
        ->select('history_surat_keluar.*')
        ->where(['history_surat_keluar.dlt'=> '0', 'history_surat_keluar.surat_keluar_id'=>$request->surat_keluar_id])
        ->get();


        $data['perintahDisposisi'] =  DB::table('status_keluar')->where([['softdelete' , '0'],['id', '<', '5']])->pluck('nama', 'id');

        $data['pegawai'] = Pegawai::where('softdelete', '0')->pluck('nama', 'id');

        $data['statusNow'] = Get_field::get_data($request->surat_keluar_id, 'surat_keluar', 'status');

        $data['surat_keluar_id'] = $request->surat_keluar_id;
        
        return $this->sendCommonResponse($data, 'Anda telah berhasil memperbarui surat keluar', 'disposisi');
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
            'isi_ringkasan'=>'required',
            'tgl_surat'=>'required',
            'jenis_id'=>'required'
        ]);
    }

    private function sendCommonResponse($data=[], $notify = '', $option = null) 
    {
        $suratKeluarObj = new SuratKeluar();
        $response = $this->processNotification($notify);
        
        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;

        
        if ($option == 'add') {
            $response['replaceWith']['#addSuratKeluar'] = view('surat_keluar.formadd', $data)->render();
        } else if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editSuratKeluar'] = view('surat_keluar.formedit', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showSuratKeluar'] = view('surat_keluar.profile', $data)->render();
        } else if ($option == 'posisi') {
            $response['replaceWith']['#posisiSuratKeluar'] = view('surat_keluar.posisi', $data)->render();
        } else if ($option == 'disposisi') {
            $response['replaceWith']['#disposisiSuratKeluar'] = view('surat_keluar.disposisi', $data)->render();
        }
        if ( in_array($option, ['index', 'add', 'update', 'delete', 'import','disposisi'])) {
            if (empty($data['semua_surat_keluar'])) {
                $data['semua_surat_keluar'] = $suratKeluarObj->getAll('paginate');
            }
            $response['replaceWith']['#suratKeluarTable'] = view('surat_keluar.table', $data)->render();
        }
        return $this->sendResponse($response);
    }

}
