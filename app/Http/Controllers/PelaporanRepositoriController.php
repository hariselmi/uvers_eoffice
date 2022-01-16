<?php

namespace App\Http\Controllers;

use App\PelaporanRepositori;
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

class PelaporanRepositoriController extends Controller
{

    public function __construct(PelaporanRepositori $pelaporanRepositori)
    {
        $this->middleware('auth');
        $this->pelaporanRepositori = $pelaporanRepositori;
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
                Session::put('pelaporanRepositori_filter', $search);
            } else if( Session::get('pelaporanRepositori_filter')) {
                $search = Session::get('pelaporanRepositori_filter');
            }
            $data['pelaporan_repositori'] = $this->pelaporanRepositori->getAll('paginate', $search);

            return $this->sendCommonResponse($data, null, 'index');
        }

        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;

            
            

        $data['status_laporan'] =  DB::table('status_laporan')->where('softdelete' , '0')->pluck('nama', 'id');
        
        $data['pelaporan_repositori'] = $this->pelaporanRepositori->getAll('paginate');
        return view('pelaporan_repositori.index', $data);
    }

    public function repositori($id)
    {
         $unit_kerja = Get_field::get_data(Auth::user()->pegawai_id, 'pegawai', 'unit_kerja_id');

        if($unit_kerja == 1 OR $unit_kerja == 2){

            $data['repositori_id'] = $id;

            $data['surat_masuk'] = DB::table('surat_masuk')
            ->select('surat_masuk.*')
            ->where(['surat_masuk.dlt'=> '0', 'surat_masuk.id'=>$id])
            ->where('surat_masuk.file_surat','>', 0)
            ->get();

            $data['history_surat_masuk'] = DB::table('history_surat_masuk')
            ->select('history_surat_masuk.*')
            ->where(['history_surat_masuk.dlt'=> '0', 'history_surat_masuk.surat_masuk_id'=>$id])
            ->where('history_surat_masuk.file_surat','>', 0)
            ->get();

            $data['surat_masuk_laporan'] = DB::table('surat_masuk_laporan')
            ->select('surat_masuk_laporan.*')
            ->where(['surat_masuk_laporan.status'=> '5', 'surat_masuk_laporan.dlt'=> '0', 'surat_masuk_laporan.surat_masuk_id'=>$id])
            ->where('surat_masuk_laporan.laporan_file','>', 0)
            ->get();

        }else{

            $data['repositori_id'] = $id;

            $data['surat_masuk'] = DB::table('surat_masuk')
            ->select('surat_masuk.*')
            ->where(['surat_masuk.dlt'=> '0', 'surat_masuk.id'=>$id])
            ->where('surat_masuk.file_surat','>', 0)
            ->get();

            $data['history_surat_masuk'] = DB::table('history_surat_masuk')
            ->select('history_surat_masuk.*')
            ->where(['history_surat_masuk.dlt'=> '0', 'history_surat_masuk.surat_masuk_id'=>$id, 'history_surat_masuk.pegawai_id'=>Auth::user()->pegawai_id])
            ->where('history_surat_masuk.file_surat','>', 0)
            ->get();

            $data['surat_masuk_laporan'] = DB::select("SELECT
                `surat_masuk_laporan`.* 
            FROM
                `surat_masuk_laporan` 
            WHERE
                `surat_masuk_laporan`.`status` = 5 AND `surat_masuk_laporan`.`dlt` = 0 AND `surat_masuk_laporan`.`surat_masuk_id` = $id AND `surat_masuk_laporan`.`laporan_file` > 0 
                AND `surat_masuk_laporan`.`laporan_pegawai_id` = '".Auth::user()->pegawai_id."' OR `surat_masuk_laporan`.`laporan_pegawai_approval_id` = '".Auth::user()->pegawai_id."'");

        }


        return $this->sendCommonResponse($data, null, 'repositori');
    }



    private function sendCommonResponse($data=[], $notify = '', $option = null) 
    {
        $pelaporanRepositoriObj = new PelaporanRepositori();
        $response = $this->processNotification($notify);
        
        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;


        if ($option == 'repositori') {
            $response['replaceWith']['#lihatRepositori'] = view('pelaporan_repositori.repositori', $data)->render();
        }

        if ( in_array($option, ['index','repositori'])) {

            if (empty($data['pelaporan_repositori'])) {
                $data['pelaporan_repositori'] = $pelaporanRepositoriObj->getAll('paginate');
            }

            $response['replaceWith']['#pelaporanRepositoriTable'] = view('pelaporan_repositori.table', $data)->render();
        }
        return $this->sendResponse($response);
    }

}
