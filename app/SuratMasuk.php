<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use Get_field;

class SuratMasuk extends Model
{
    use HasFactory;
    protected $table = 'surat_masuk';
    public $timestamps = true;
    public function getAll($option=null, $search=null) {

        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;

        $results = $this->select('users.id')
        ->leftJoin('users', 'surat_masuk.users_id', 'users.id');

         if ($userRole == 'Admin') {


            $results = $this->select('*')->where('dlt','0')->orderBy('surat_masuk.created_at','DESC');


        } elseif ($userRole == 'Staff') {


            $results = $this->select('*')->where('dlt','0')->orderBy('surat_masuk.created_at','DESC');


        } else{


            $jabatan_id = Get_field::get_data(Auth::user()->pegawai_id, 'pegawai', 'jabatan_id');
            $unit_kerja_id = Get_field::get_data(Auth::user()->pegawai_id, 'pegawai', 'unit_kerja_id');

            if ($unit_kerja_id == '1' OR $unit_kerja_id == '2') {
                $results = $this->select('*')->where('dlt','0')->orderBy('surat_masuk.created_at','DESC');
            }else{

                $results = $this->select('surat_masuk.*', 'history_surat_masuk.surat_masuk_model')
                ->join('history_surat_masuk', 'history_surat_masuk.surat_masuk_id', 'surat_masuk.id')
                ->where([['surat_masuk.dlt','0'], ['history_surat_masuk.tujuan_surat', Auth::user()->pegawai_id]])
                ->orderBy('surat_masuk.created_at','DESC');
                

            }
        }



        $per_page = !empty($search['per_page']) ? $search['per_page'] : 10;
        if(!empty($search)) {
            if(!empty($search['search'])) {
                $results = $results->where([['perihal', 'LIKE', '%'.$search['search'].'%'], ['dlt','0']])
                ->orWhere([['no_surat', 'LIKE', '%'.$search['search'].'%'], ['dlt','0']])
                ->orWhere([['tgl_surat', 'LIKE', '%'.$search['search'].'%'], ['dlt','0']])
                ->orWhere([['asal_surat', 'LIKE', '%'.$search['search'].'%'], ['dlt','0']]);
            }
        }
        if($option=='paginate') {
            return $results->paginate($per_page);
        } else if ($option == 'select') {
            return $results->pluck('perihal', 'id');
        } else {
            return $results->get();
        }
    }

    public function saveSuratMasuk(Array $data)
    {
        // $this->id;
        $this->no_surat = $data['no_surat'];
        $this->perihal = $data['perihal'];
        $this->asal_surat = $data['asal_surat'];
        $this->tujuan_surat = $data['tujuan_surat'];
        $this->tgl_surat = $data['tgl_surat'];
        $this->jenis_id = $data['jenis_id'];
        $this->prioritas_id = $data['prioritas_id'];
        $this->sifat_id = $data['sifat_id'];
        $this->media_id = $data['media_id'];
        $this->dlt = '0';
        $this->save();

        DB::table('history_surat_masuk')->insert([
            'surat_masuk_id' => $this->id,
            'no_surat' => $data['no_surat'],
            'asal_surat' => $data['asal_surat'],
            'tujuan_surat' => $data['tujuan_surat'],
            'tgl_posisi' => $data['tgl_surat'],
            'isi_ringkasan' => $data['isi_ringkasan'],
            'status' => '0',
            'dlt' => '0',
        ]);
    }

    public function getById($id) {
        return $this->findOrFail($id);
    }

}
