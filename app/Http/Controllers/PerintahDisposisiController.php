<?php

namespace App\Http\Controllers;

use App\PerintahDisposisi;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PerintahDisposisiController extends Controller
{

    public function __construct(PerintahDisposisi $perintah_disposisi)
    {
        $this->middleware('auth');
        $this->perintah_disposisi = $perintah_disposisi;
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
                Session::put('perintah_disposisi_filter', $search);
            } else if( Session::get('perintah_disposisi_filter')) {
                $search = Session::get('perintah_disposisi_filter');
            }
            $data['semua_perintah_disposisi'] = $this->perintah_disposisi->getAll('paginate', $search);

            return $this->sendCommonResponse($data, null, 'index');
        }

        $data['semua_perintah_disposisi'] = $this->perintah_disposisi->getAll('paginate');
        return view('perintah_disposisi.index', $data);
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
        $semua_perintah_disposisi = new PerintahDisposisi;
        $semua_perintah_disposisi->SavePerintahDisposisi($input);
        
        return $this->sendCommonResponse($data=[], 'Data berhasil ditambahkan', 'add');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PerintahDisposisi  $perintah_disposisi
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $data['perintah_disposisi'] = PerintahDisposisi::find($id);
        return $this->sendCommonResponse($data, null, 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PerintahDisposisi  $perintah_disposisi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['perintah_disposisi'] = PerintahDisposisi::find($id);
        return $this->sendCommonResponse($data, null, 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PerintahDisposisi  $perintah_disposisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //
        $input = $request->all();
        $this->validator($input)->validate();
        $semua_perintah_disposisi = (new PerintahDisposisi())->getById($id);
        
        $semua_perintah_disposisi->SavePerintahDisposisi($input);
        $data['perintah_disposisi'] = $semua_perintah_disposisi;
        return $this->sendCommonResponse($data, 'Data berhasil diedit', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PerintahDisposisi  $perintah_disposisi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $perintah_disposisi = PerintahDisposisi::find($id);
            $perintah_disposisi->updated_at = date('Y-m-d H:i:s');
            $perintah_disposisi->softdelete = '1';
            $perintah_disposisi->save();

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
        $perintah_disposisiObj = new PerintahDisposisi();
        $response = $this->processNotification($notify);
        
        if ($option == 'add') {
            $response['replaceWith']['#addPerintahDisposisi'] = view('perintah_disposisi.formadd', $data)->render();
        } else if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editPerintahDisposisi'] = view('perintah_disposisi.formedit', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showPerintahDisposisi'] = view('perintah_disposisi.profile', $data)->render();
        }
        if ( in_array($option, ['index', 'add', 'update', 'delete', 'import'])) {
            if (empty($data['semua_perintah_disposisi'])) {
                $data['semua_perintah_disposisi'] = $perintah_disposisiObj->getAll('paginate');
            }
            $response['replaceWith']['#PerintahDisposisiTable'] = view('perintah_disposisi.table', $data)->render();
        }
        return $this->sendResponse($response);
    }
}
