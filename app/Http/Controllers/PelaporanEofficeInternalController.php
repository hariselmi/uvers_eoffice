<?php

namespace App\Http\Controllers;

use App\PelaporanEofficeInternal;
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

class PelaporanEofficeInternalController extends Controller
{

    public function __construct(PelaporanEofficeInternal $pelaporanEofficeInternal)
    {
        $this->middleware('auth');
        $this->pelaporanEofficeInternal = $pelaporanEofficeInternal;
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
                Session::put('pelaporanEofficeInternal_filter', $search);
            } else if( Session::get('pelaporanEofficeInternal_filter')) {
                $search = Session::get('pelaporanEofficeInternal_filter');
            }
            $data['pelaporan_eoffice_internal'] = $this->pelaporanEofficeInternal->getAll('paginate', $search);

            return $this->sendCommonResponse($data, null, 'index');
        }

        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;

            
            

        $data['status_laporan'] =  DB::table('status_laporan')->where('softdelete' , '0')->pluck('nama', 'id');
        
        $data['pelaporan_eoffice_internal'] = $this->pelaporanEofficeInternal->getAll('paginate');
        return view('pelaporan_eoffice_internal.index', $data);
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
     * @param  \App\PelaporanEofficeInternal  $pelaporanEofficeInternal
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $data['pelaporan_eoffice_internal'] = PelaporanEofficeInternal::find($id);
        return $this->sendCommonResponse($data, null, 'show');
    }


    public function laporan($id)
    {


        $data['history_surat_keluar'] = DB::table('history_surat_keluar')
        ->select('history_surat_keluar.*')
        ->where(['history_surat_keluar.dlt'=> '0', 'history_surat_keluar.surat_keluar_id'=>$id])
        ->get();

        $data['surat_keluar_id'] = $id;

        return $this->sendCommonResponse($data, null, 'laporan');
    }


    public function validasi($id)
    {
        
        $data['validasipelaporaneoffice'] = PelaporanEofficeInternal::find($id);
        $data['status_laporan'] =  DB::table('status_laporan')->where('softdelete' , '0')->pluck('nama', 'id');
        $data['surat_keluar_id'] = $id;
        $data['status_laporan_id'] = Get_field::get_data($id, 'surat_keluar', 'status_laporan_id') ;

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
                # code...
                DB::table('surat_keluar')->where('id', $request->surat_keluar_id)->update([
                    'laporan_file' => $newName,
                ]);
            }

            DB::table('surat_keluar')->where('id', $request->surat_keluar_id)->update([
                'laporan_catatan' => $request->catatan_penting,
                'status_laporan_id' => '2',
            ]);
        
        $data['status_laporan'] =  DB::table('status_laporan')->where('softdelete' , '0')->pluck('nama', 'id');
        $data['surat_keluar_id'] = $request->surat_keluar_id;

        return $this->sendCommonResponse($data, 'Anda telah berhasil memperbarui surat masuk', 'laporan');
    }


    public function storeValidasi(Request $request)
    {
        // dd($request->all());
        $input = $request->all();
        $this->validatorValidasi($input)->validate();

            DB::table('surat_keluar')->where('id', $request->surat_keluar_id)->update([
                'status_laporan_id' => $request->status_laporan_id,
                'laporan_pegawai_approval_id' => Auth::user()->pegawai_id,
            ]);

            if ($request->status_laporan_id == '3'){
                DB::table('surat_keluar')->where('id', $request->surat_keluar_id)->update([
                'status' => '4'
                ]);
            }elseif($request->status_laporan_id == '4') {
                DB::table('surat_keluar')->where('id', $request->surat_keluar_id)->update([
                'status' => '5'
            ]);
            }

        
        

        $data['surat_keluar_id'] = $request->surat_keluar_id;

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
        $pelaporanEofficeInternalObj = new PelaporanEofficeInternal();
        $response = $this->processNotification($notify);
        
        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;

        
        if ($option == 'laporan') {
            $response['replaceWith']['#laporanPelaporanEofficeInternal'] = view('pelaporan_eoffice_internal.laporan', $data)->render();
        } elseif ($option == 'validasi') {
            $response['replaceWith']['#validasiPelaporanEofficeInternal'] = view('pelaporan_eoffice_internal.validasi', $data)->render();
        }
        if ( in_array($option, ['index', 'add', 'laporan'])) {
            if (empty($data['pelaporan_eoffice_internal'])) {
                $data['pelaporan_eoffice_internal'] = $pelaporanEofficeInternalObj->getAll('paginate');
            }
            $response['replaceWith']['#pelaporanEofficeInternalTable'] = view('pelaporan_eoffice_internal.table', $data)->render();
        }
        return $this->sendResponse($response);
    }

}
