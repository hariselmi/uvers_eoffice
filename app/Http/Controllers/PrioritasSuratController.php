<?php

namespace App\Http\Controllers;

use App\PrioritasSurat;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PrioritasSuratController extends Controller
{

    public function __construct(PrioritasSurat $prioritas_surat)
    {
        $this->middleware('auth');
        $this->prioritas_surat = $prioritas_surat;
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
                Session::put('prioritas_surat_filter', $search);
            } else if( Session::get('prioritas_surat_filter')) {
                $search = Session::get('prioritas_surat_filter');
            }
            $data['semua_prioritas_surat'] = $this->prioritas_surat->getAll('paginate', $search);

            return $this->sendCommonResponse($data, null, 'index');
        }

        $data['semua_prioritas_surat'] = $this->prioritas_surat->getAll('paginate');
        return view('prioritas_surat.index', $data);
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
        $semua_prioritas_surat = new PrioritasSurat;
        $semua_prioritas_surat->SavePrioritasSurat($input);
        
        return $this->sendCommonResponse($data=[], 'Data berhasil ditambahkan', 'add');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PrioritasSurat  $prioritas_surat
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $data['prioritas_surat'] = PrioritasSurat::find($id);
        return $this->sendCommonResponse($data, null, 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PrioritasSurat  $prioritas_surat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['prioritas_surat'] = PrioritasSurat::find($id);
        return $this->sendCommonResponse($data, null, 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PrioritasSurat  $prioritas_surat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //
        $input = $request->all();
        $this->validator($input)->validate();
        $semua_prioritas_surat = (new PrioritasSurat())->getById($id);
        
        $semua_prioritas_surat->SavePrioritasSurat($input);
        $data['prioritas_surat'] = $semua_prioritas_surat;
        return $this->sendCommonResponse($data, 'Data berhasil diedit', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PrioritasSurat  $prioritas_surat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $prioritas_surat = PrioritasSurat::find($id);
            $prioritas_surat->updated_at = date('Y-m-d H:i:s');
            $prioritas_surat->softdelete = '1';
            $prioritas_surat->save();

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
        $prioritas_suratObj = new PrioritasSurat();
        $response = $this->processNotification($notify);
        
        if ($option == 'add') {
            $response['replaceWith']['#addPrioritasSurat'] = view('prioritas_surat.formadd', $data)->render();
        } else if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editPrioritasSurat'] = view('prioritas_surat.formedit', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showPrioritasSurat'] = view('prioritas_surat.profile', $data)->render();
        }
        if ( in_array($option, ['index', 'add', 'update', 'delete', 'import'])) {
            if (empty($data['semua_prioritas_surat'])) {
                $data['semua_prioritas_surat'] = $prioritas_suratObj->getAll('paginate');
            }
            $response['replaceWith']['#PrioritasSuratTable'] = view('prioritas_surat.table', $data)->render();
        }
        return $this->sendResponse($response);
    }
}
