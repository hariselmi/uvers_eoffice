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





    private function sendCommonResponse($data=[], $notify = '', $option = null) 
    {
        $pelaporanRepositoriObj = new PelaporanRepositori();
        $response = $this->processNotification($notify);
        
        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;


        if ( in_array($option, ['index'])) {
            if (empty($data['pelaporan_repositori'])) {
                $data['pelaporan_repositori'] = $pelaporanRepositoriObj->getAll('paginate');
            }
            $response['replaceWith']['#pelaporanRepositoriTable'] = view('pelaporan_repositori.table', $data)->render();
        }
        return $this->sendResponse($response);
    }

}
