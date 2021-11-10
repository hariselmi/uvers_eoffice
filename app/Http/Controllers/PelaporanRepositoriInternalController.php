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
            $data['pelaporan_repositori'] = $this->pelaporanRepositoriInternal->getAll('paginate', $search);

            return $this->sendCommonResponse($data, null, 'index');
        }

        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;

            
            

        $data['status_laporan'] =  DB::table('status_laporan')->where('softdelete' , '0')->pluck('nama', 'id');
        
        $data['pelaporan_repositori'] = $this->pelaporanRepositoriInternal->getAll('paginate');
        return view('pelaporan_repositori.index', $data);
    }





    private function sendCommonResponse($data=[], $notify = '', $option = null) 
    {
        $pelaporanRepositoriInternalObj = new PelaporanRepositoriInternal();
        $response = $this->processNotification($notify);
        
        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;


        if ( in_array($option, ['index'])) {
            if (empty($data['pelaporan_repositori'])) {
                $data['pelaporan_repositori'] = $pelaporanRepositoriInternalObj->getAll('paginate');
            }
            $response['replaceWith']['#pelaporanRepositoriInternalTable'] = view('pelaporan_repositori.table', $data)->render();
        }
        return $this->sendResponse($response);
    }

}
