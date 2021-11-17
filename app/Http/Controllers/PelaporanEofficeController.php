<?php

namespace App\Http\Controllers;

use App\PelaporanEoffice;
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

class PelaporanEofficeController extends Controller
{

    public function __construct(PelaporanEoffice $pelaporanEoffice)
    {
        $this->middleware('auth');
        $this->pelaporanEoffice = $pelaporanEoffice;
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
                Session::put('pelaporanEoffice_filter', $search);
            } else if( Session::get('pelaporanEoffice_filter')) {
                $search = Session::get('pelaporanEoffice_filter');
            }
            $data['pelaporan_eoffice'] = $this->pelaporanEoffice->getAll('paginate', $search);

            return $this->sendCommonResponse($data, null, 'index');
        }

        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;

            
            

        $data['status_laporan'] =  DB::table('status_laporan')->where('softdelete' , '0')->pluck('nama', 'id');
        
        $data['pelaporan_eoffice'] = $this->pelaporanEoffice->getAll('paginate');
        return view('pelaporan_eoffice.index', $data);
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
     * Display the specified resource.
     *
     * @param  \App\PelaporanEoffice  $pelaporanEoffice
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $data['pelaporan_eoffice'] = PelaporanEoffice::find($id);
        return $this->sendCommonResponse($data, null, 'show');
    }


    public function laporan($id)
    {


        $data['history_surat_masuk'] = DB::table('history_surat_masuk')
        ->select('history_surat_masuk.*')
        ->where(['history_surat_masuk.dlt'=> '0', 'history_surat_masuk.surat_masuk_id'=>$id])
        ->get();

        $data['surat_masuk_id'] = $id;

        return $this->sendCommonResponse($data, null, 'laporan');
    }


    public function validasi($id)
    {
        
        $data['validasipelaporaneoffice'] = PelaporanEoffice::find($id);
        $data['status_laporan'] =  DB::table('status_laporan')->where('softdelete' , '0')->pluck('nama', 'id');
        $data['surat_masuk_id'] = $id;

        return $this->sendCommonResponse($data, null, 'validasi');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeLaporan(Request $request)
    {
        // dd($request->all());
        $input = $request->all();
        $this->validatorLaporan($input)->validate();

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

            if ($fileSurat) {
                DB::table('surat_masuk_laporan')->where('id', $request->surat_masuk_id)->update([
                    'laporan_file' => $newName,
                ]);
            }

            DB::table('surat_masuk_laporan')->where('id', $request->surat_masuk_id)->update([
                'laporan_catatan' => $request->catatan_penting,
                'status_laporan_id' => '2',
            ]);
        
        $data['status_laporan'] =  DB::table('status_laporan')->where('softdelete' , '0')->pluck('nama', 'id');
        $data['surat_masuk_id'] = $request->surat_masuk_id;

        return $this->sendCommonResponse($data, 'Anda telah berhasil memperbarui surat masuk', 'laporan');
    }


    public function storeValidasi(Request $request)
    {
        // dd($request->all());
        $input = $request->all();
        $this->validatorValidasi($input)->validate();

            DB::table('surat_masuk_laporan')->where('id', $request->surat_masuk_id)->update([
                'status_laporan_id' => $request->status_laporan_id,
                'laporan_pegawai_approval_id' => Auth::user()->pegawai_id,
            ]);

            if ($request->status_laporan_id == '3'){
                DB::table('surat_masuk_laporan')->where('id', $request->surat_masuk_id)->update([
                'status' => '4'
                ]);
            }elseif($request->status_laporan_id == '4') {
                DB::table('surat_masuk_laporan')->where('id', $request->surat_masuk_id)->update([
                'status' => '5'
            ]);
            }
        

        $data['surat_masuk_id'] = $request->surat_masuk_id;

        return $this->sendCommonResponse($data, 'Anda telah berhasil memperbarui surat masuk', 'laporan');
    }


    protected function validatorLaporan(Array $data)
    {
        return Validator::make($data, [
            'catatan_penting'=>'required',
            'fileSurat'=>'required',
        ]);
    }

    protected function validatorValidasi(Array $data)
    {
        return Validator::make($data, [
            'status_laporan_id'=>'required',
        ]);
    }


    private function sendCommonResponse($data=[], $notify = '', $option = null) 
    {
        $pelaporanEofficeObj = new PelaporanEoffice();
        $response = $this->processNotification($notify);
        
        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;

        
        if ($option == 'laporan') {
            $response['replaceWith']['#laporanPelaporanEoffice'] = view('pelaporan_eoffice.laporan', $data)->render();
        } elseif ($option == 'validasi') {
            $response['replaceWith']['#validasiPelaporanEoffice'] = view('pelaporan_eoffice.validasi', $data)->render();
        }
        if ( in_array($option, ['index', 'add', 'laporan'])) {
            if (empty($data['pelaporan_eoffice'])) {
                $data['pelaporan_eoffice'] = $pelaporanEofficeObj->getAll('paginate');
            }
            $response['replaceWith']['#pelaporanEofficeTable'] = view('pelaporan_eoffice.table', $data)->render();
        }
        return $this->sendResponse($response);
    }

}
