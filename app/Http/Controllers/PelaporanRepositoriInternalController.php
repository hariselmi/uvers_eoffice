<?php

namespace App\Http\Controllers;

use App\PelaporanRepositoriInternal;
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

class PelaporanRepositoriInternalController extends Controller
{

    public function __construct(PelaporanRepositoriInternal $pelaporanRepositoriInternal)
    {
        $this->middleware('auth');
        $this->pelaporanRepositoriInternal = $pelaporanRepositoriInternal;
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
                Session::put('pelaporanRepositoriInternal_filter', $search);
            } else if( Session::get('pelaporanRepositoriInternal_filter')) {
                $search = Session::get('pelaporanRepositoriInternal_filter');
            }
            $data['pelaporan_repositori_internal'] = $this->pelaporanRepositoriInternal->getAll('paginate', $search);

            return $this->sendCommonResponse($data, null, 'index');
        }

        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;

            
            

        $data['status_laporan'] =  DB::table('status_laporan')->where('softdelete' , '0')->pluck('nama', 'id');
        
        $data['pelaporan_repositori_internal'] = $this->pelaporanRepositoriInternal->getAll('paginate');
        return view('pelaporan_repositori_internal.index', $data);
    }


    public function repositori($id)
    {

        $unit_kerja = Get_field::get_data(Auth::user()->pegawai_id, 'pegawai', 'unit_kerja_id');

        if($unit_kerja == 1 OR $unit_kerja == 2){

            $data['repositori_id'] = $id;

            $data['surat_keluar'] = DB::table('surat_keluar')
            ->select('surat_keluar.*')
            ->where(['surat_keluar.dlt'=> '0', 'surat_keluar.id'=>$id])
            ->where('surat_keluar.file_surat','>', 0)
            ->get();

            $data['history_surat_keluar'] = DB::table('history_surat_keluar')
            ->select('history_surat_keluar.*')
            ->where(['history_surat_keluar.dlt'=> '0', 'history_surat_keluar.surat_keluar_id'=>$id])
            ->where('history_surat_keluar.file_surat','>', 0)
            ->get();

            $data['surat_keluar_laporan'] = DB::table('surat_keluar')
            ->select('surat_keluar.*')
            ->where(['surat_keluar.dlt'=> '0', 'surat_keluar.id'=>$id, 'surat_keluar.status_laporan_id'=> '4'])
            ->where('surat_keluar.laporan_file','>', 0)
            ->get();
        }else{

            $data['repositori_id'] = $id;

            $data['surat_keluar'] = DB::table('surat_keluar')
            ->select('surat_keluar.*')
            ->where(['surat_keluar.dlt'=> '0', 'surat_keluar.id'=>$id])
            ->where('surat_keluar.file_surat','>', 0)
            ->get();

            $data['history_surat_keluar'] = DB::table('history_surat_keluar')
            ->select('history_surat_keluar.*')
            ->where(['history_surat_keluar.dlt'=> '0', 'history_surat_keluar.surat_keluar_id'=>$id])
            ->where('history_surat_keluar.file_surat','>', 0)
            ->get();


            $data['surat_keluar_laporan'] = DB::select("SELECT
                `surat_keluar`.* 
            FROM
                `surat_keluar` 
            WHERE
                `surat_keluar`.`dlt` = 0 AND `surat_keluar`.`id` = $id AND `surat_keluar`.`laporan_file` > 0 
                AND `surat_keluar`.`laporan_pegawai_id` = '".Auth::user()->pegawai_id."' OR `surat_keluar`.`laporan_pegawai_approval_id` = '".Auth::user()->pegawai_id."'");
        }


        return $this->sendCommonResponse($data, null, 'repositori');
    }


    private function sendCommonResponse($data=[], $notify = '', $option = null) 
    {
        $pelaporanRepositoriInternalObj = new PelaporanRepositoriInternal();
        $response = $this->processNotification($notify);
        
        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;

        if ($option == 'repositori') {
            $response['replaceWith']['#lihatRepositoriInternal'] = view('pelaporan_repositori_internal.repositori', $data)->render();
        }

        if ( in_array($option, ['index','repositori'])) {
            if (empty($data['pelaporan_repositori_internal'])) {
                $data['pelaporan_repositori_internal'] = $pelaporanRepositoriInternalObj->getAll('paginate');
            }
            $response['replaceWith']['#pelaporanRepositoriInternalTable'] = view('pelaporan_repositori_internal.table', $data)->render();
        }
        return $this->sendResponse($response);
    }

}
