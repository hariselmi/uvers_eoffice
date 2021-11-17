<?php

namespace App\Http\Controllers;

use App\UnitKerja;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class UnitKerjaController extends Controller
{

    public function __construct(UnitKerja $unit_kerja)
    {
        $this->middleware('auth');
        $this->unit_kerja = $unit_kerja;
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
                Session::put('unit_kerja_filter', $search);
            } else if( Session::get('unit_kerja_filter')) {
                $search = Session::get('unit_kerja_filter');
            }
            $data['semua_unit_kerja'] = $this->unit_kerja->getAll('paginate', $search);

            return $this->sendCommonResponse($data, null, 'index');
        }

        $data['semua_unit_kerja'] = $this->unit_kerja->getAll('paginate');
        return view('unit_kerja.index', $data);
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
        $semua_unit_kerja = new UnitKerja;
        $semua_unit_kerja->SaveUnitKerja($input);
        
        return $this->sendCommonResponse($data=[], 'Data berhasil ditambahkan', 'add');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UnitKerja  $unit_kerja
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $data['unit_kerja'] = UnitKerja::find($id);
        return $this->sendCommonResponse($data, null, 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UnitKerja  $unit_kerja
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['unit_kerja'] = UnitKerja::find($id);
        return $this->sendCommonResponse($data, null, 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UnitKerja  $unit_kerja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //
        $input = $request->all();
        $this->validator($input)->validate();
        $semua_unit_kerja = (new UnitKerja())->getById($id);
        
        $semua_unit_kerja->SaveUnitKerja($input);
        $data['unit_kerja'] = $semua_unit_kerja;
        return $this->sendCommonResponse($data, 'Data berhasil diedit', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UnitKerja  $unit_kerja
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    
        if ($id == 1 OR $id == 2) {
            return $this->sendCommonResponse([], ['danger'=>__('Unit Kerja ini tidak boleh di hapus')]);
        } else{
            try {
                $unit_kerja = UnitKerja::find($id);
                $unit_kerja->updated_at = date('Y-m-d H:i:s');
                $unit_kerja->softdelete = '1';
                $unit_kerja->save();

            return $this->sendCommonResponse([], 'Data berhasil dihapus', 'delete');
            } catch (\Illuminate\Database\QueryException $e) {
                return $this->sendCommonResponse([], ['danger'=>__('Integrity constraint violation: You Cannot delete a parent row')]);
            }
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
        $unit_kerjaObj = new UnitKerja();
        $response = $this->processNotification($notify);
        
        if ($option == 'add') {
            $response['replaceWith']['#addUnitKerja'] = view('unit_kerja.formadd', $data)->render();
        } else if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editUnitKerja'] = view('unit_kerja.formedit', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showUnitKerja'] = view('unit_kerja.profile', $data)->render();
        }
        if ( in_array($option, ['index', 'add', 'update', 'delete', 'import'])) {
            if (empty($data['semua_unit_kerja'])) {
                $data['semua_unit_kerja'] = $unit_kerjaObj->getAll('paginate');
            }
            $response['replaceWith']['#UnitKerjaTable'] = view('unit_kerja.table', $data)->render();
        }
        return $this->sendResponse($response);
    }
}
