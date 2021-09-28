<?php

namespace App\Http\Controllers;

use App\JenisSurat;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class JenisSuratController extends Controller
{

    public function __construct(JenisSurat $jenis_surat)
    {
        $this->middleware('auth');
        $this->jenis_surat = $jenis_surat;
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
                Session::put('jenis_surat_filter', $search);
            } else if( Session::get('jenis_surat_filter')) {
                $search = Session::get('jenis_surat_filter');
            }
            $data['semua_jenis_surat'] = $this->jenis_surat->getAll('paginate', $search);

            return $this->sendCommonResponse($data, null, 'index');
        }

        $data['semua_jenis_surat'] = $this->jenis_surat->getAll('paginate');
        return view('jenis_surat.index', $data);
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
        $semua_jenis_surat = new JenisSurat;
        $semua_jenis_surat->SaveJenisSurat($input);
        
        return $this->sendCommonResponse($data=[], 'Data berhasil ditambahkan', 'add');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JenisSurat  $jenis_surat
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $data['jenis_surat'] = JenisSurat::find($id);
        return $this->sendCommonResponse($data, null, 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JenisSurat  $jenis_surat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['jenis_surat'] = JenisSurat::find($id);
        return $this->sendCommonResponse($data, null, 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JenisSurat  $jenis_surat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //
        $input = $request->all();
        $this->validator($input)->validate();
        $semua_jenis_surat = (new JenisSurat())->getById($id);
        
        $semua_jenis_surat->SaveJenisSurat($input);
        $data['jenis_surat'] = $semua_jenis_surat;
        return $this->sendCommonResponse($data, 'Data berhasil diedit', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JenisSurat  $jenis_surat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $jenis_surat = JenisSurat::find($id);
            $jenis_surat->updated_at = date('Y-m-d H:i:s');
            $jenis_surat->softdelete = '1';
            $jenis_surat->save();

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
        $jenis_suratObj = new JenisSurat();
        $response = $this->processNotification($notify);
        
        if ($option == 'add') {
            $response['replaceWith']['#addJenisSurat'] = view('jenis_surat.formadd', $data)->render();
        } else if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editJenisSurat'] = view('jenis_surat.formedit', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showJenisSurat'] = view('jenis_surat.profile', $data)->render();
        }
        if ( in_array($option, ['index', 'add', 'update', 'delete', 'import'])) {
            if (empty($data['semua_jenis_surat'])) {
                $data['semua_jenis_surat'] = $jenis_suratObj->getAll('paginate');
            }
            $response['replaceWith']['#JenisSuratTable'] = view('jenis_surat.table', $data)->render();
        }
        return $this->sendResponse($response);
    }
}
