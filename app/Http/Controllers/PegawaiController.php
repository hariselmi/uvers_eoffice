<?php

namespace App\Http\Controllers;

use App\Pegawai;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class PegawaiController extends Controller
{

    public function __construct(Pegawai $pegawai)
    {
        $this->middleware('auth');
        $this->pegawai = $pegawai;
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
                Session::put('pegawai_filter', $search);
            } else if( Session::get('pegawai_filter')) {
                $search = Session::get('pegawai_filter');
            }
            $data['semua_pegawai'] = $this->pegawai->getAll('paginate', $search);

            return $this->sendCommonResponse($data, null, 'index');
        }

        $data['semua_pegawai'] = $this->pegawai->getAll('paginate');
        $data['unitkerja'] = DB::table('unit_kerja')->where('softdelete', '0')->pluck('nama', 'id');

        $data['jabatan'] = DB::table('jabatan')->where('softdelete', '0')->pluck('nama', 'id');

        $data['kepalaunit'] = DB::table('kepala_unit')->pluck('nama', 'id');

        return view('pegawai.index', $data);
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

        //update kepala unit
        if($request->kepala_unit == '2')
        {
            DB::table('pegawai')->where('unit_kerja_id', $request->unit_kerja_id)->update([
                'kepala_unit' => '1'
                ]);
        }

        $semua_pegawai = new Pegawai;
        $semua_pegawai->SavePegawai($input);

        //update kepala unit
        if($request->kepala_unit == '2')
        {
            DB::table('unit_kerja')->where('id', $request->unit_kerja_id)->update([
                'pegawai_id' => $semua_pegawai
            ]);
        }

        $data['unitkerja'] = DB::table('unit_kerja')->where('softdelete', '0')->pluck('nama', 'id');
        $data['jabatan'] = DB::table('jabatan')->where('softdelete', '0')->pluck('nama', 'id');
        $data['kepalaunit'] = DB::table('kepala_unit')->pluck('nama', 'id');
        
        return $this->sendCommonResponse($data, 'Data berhasil ditambahkan', 'add');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
       $data['unitkerja'] = DB::table('unit_kerja')->where('softdelete', '0')->pluck('nama', 'id');
        $data['jabatan'] = DB::table('jabatan')->where('softdelete', '0')->pluck('nama', 'id');
        $data['kepalaunit'] = DB::table('kepala_unit')->pluck('nama', 'id');

        return $this->sendCommonResponse($data, null, 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['pegawai'] = Pegawai::find($id);
       $data['unitkerja'] = DB::table('unit_kerja')->where('softdelete', '0')->pluck('nama', 'id');
        $data['jabatan'] = DB::table('jabatan')->where('softdelete', '0')->pluck('nama', 'id');
        $data['kepalaunit'] = DB::table('kepala_unit')->pluck('nama', 'id');
        return $this->sendCommonResponse($data, null, 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //
        $input = $request->all();
        $this->validator($input)->validate();

        //update kepala unit
        if($request->kepala_unit == '2')
        {
            DB::table('pegawai')->where('unit_kerja_id', $request->unit_kerja_id)->update([
                'kepala_unit' => '1'
                ]);
        }

        $semua_pegawai = (new Pegawai())->getById($id);
        $semua_pegawai->SavePegawai($input);

        //update kepala unit
        if($request->kepala_unit == '2')
        {
            DB::table('unit_kerja')->where('id', $request->unit_kerja_id)->update([
                'pegawai_id' => $id,
            ]);
        }

        $data['pegawai'] = $semua_pegawai;

       $data['unitkerja'] = DB::table('unit_kerja')->where('softdelete', '0')->pluck('nama', 'id');

        $data['jabatan'] = DB::table('jabatan')->where('softdelete', '0')->pluck('nama', 'id');
        $data['kepalaunit'] = DB::table('kepala_unit')->pluck('nama', 'id');


        
        return $this->sendCommonResponse($data, 'Data berhasil diedit', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $pegawai = Pegawai::find($id);
            //$pegawai->updated_at = date('Y-m-d H:i:s');
            $pegawai->softdelete = '1';
            $pegawai->save();

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
        $pegawaiObj = new Pegawai();
        $response = $this->processNotification($notify);
        
        if ($option == 'add') {
            $response['replaceWith']['#addPegawai'] = view('pegawai.formadd', $data)->render();
        } else if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editPegawai'] = view('pegawai.formedit', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showPegawai'] = view('pegawai.profile', $data)->render();
        }
        if ( in_array($option, ['index', 'add', 'update', 'delete', 'import'])) {
            if (empty($data['semua_pegawai'])) {
                $data['semua_pegawai'] = $pegawaiObj->getAll('paginate');
            }
            $response['replaceWith']['#PegawaiTable'] = view('pegawai.table', $data)->render();
        }
        return $this->sendResponse($response);
    }

    public function getJabatan($id){
        
        $jabatan = DB::select("SELECT id, nama FROM jabatan 
            WHERE unit_kerja_id = '$id'
            AND softdelete = '0'");

        return $jabatan;
    }
}
