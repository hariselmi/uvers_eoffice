<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use Get_field;

class SuratKeluar extends Model
{
    use HasFactory;
    protected $table = 'surat_keluar';
    public $timestamps = true;
    public function getAll($option=null, $search=null) {

        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;

        $unit_kerja = Get_field::get_data(Auth::user()->pegawai_id, 'pegawai', 'unit_kerja_id');
        $kepala_unit = Get_field::get_data(Auth::user()->pegawai_id, 'pegawai', 'kepala_unit');

         if ($userRole == 'Admin') {


           $results = $this->select('*')->where('dlt','0')->orderBy('surat_keluar.created_at');


        } elseif ($userRole == 'Staff') {


            $results = $this->select('*')->where('dlt','0')->orderBy('surat_keluar.created_at');


        } else{


        if($kepala_unit == '2'){

            $results = $this->select('surat_keluar.id', 'surat_keluar.no_surat', 'surat_keluar.perihal', 'surat_keluar.asal_surat', 'surat_keluar.tujuan_surat', 'surat_keluar.tgl_surat', 'surat_keluar.unit_kerja_id', 'surat_keluar.status', 'surat_keluar.pegawai_id','surat_keluar.file_surat')

                ->where(['surat_keluar.dlt' => '0', 'surat_keluar.unit_kerja_id'=> $unit_kerja])

                ->orWhere(function($query) {
                    $query->where('surat_keluar.dlt', '0')
                          ->where('history_surat_keluar.asal_surat', Auth::user()->pegawai_id);
                })

                ->orWhere(function($query) {
                    $query->where('surat_keluar.dlt', '0')
                          ->where('history_surat_keluar.tujuan_surat', Auth::user()->pegawai_id);
                })

                ->leftJoin('history_surat_keluar', 'history_surat_keluar.surat_keluar_id', 'surat_keluar.id')
                ->orderBy('surat_keluar.created_at', 'DESC')
                ->groupBy('surat_keluar.id', 'surat_keluar.no_surat', 'surat_keluar.perihal', 'surat_keluar.asal_surat', 'surat_keluar.tujuan_surat', 'surat_keluar.tgl_surat', 'surat_keluar.unit_kerja_id', 'surat_keluar.status', 'surat_keluar.pegawai_id','surat_keluar.file_surat');
  


        }else{
            $results = $this->select('surat_keluar.id', 'surat_keluar.no_surat', 'surat_keluar.perihal', 'surat_keluar.asal_surat', 'surat_keluar.tujuan_surat', 'surat_keluar.tgl_surat', 'surat_keluar.unit_kerja_id', 'surat_keluar.status', 'surat_keluar.pegawai_id','surat_keluar.file_surat')

                ->where(['surat_keluar.dlt' => '0', 'surat_keluar.unit_kerja_id'=> $unit_kerja])

                ->orWhere(function($query) {
                    $query->where('surat_keluar.dlt', '0')
                          ->where('history_surat_keluar.asal_surat', Auth::user()->pegawai_id);
                })

                ->orWhere(function($query) {
                    $query->where('surat_keluar.dlt', '0')
                          ->where('history_surat_keluar.tujuan_surat', Auth::user()->pegawai_id);
                })

                ->leftJoin('history_surat_keluar', 'history_surat_keluar.surat_keluar_id', 'surat_keluar.id')
                ->orderBy('surat_keluar.created_at', 'DESC')
                ->groupBy('surat_keluar.id', 'surat_keluar.no_surat', 'surat_keluar.perihal', 'surat_keluar.asal_surat', 'surat_keluar.tujuan_surat', 'surat_keluar.tgl_surat', 'surat_keluar.unit_kerja_id', 'surat_keluar.status', 'surat_keluar.pegawai_id','surat_keluar.file_surat');
        }
        }




        $per_page = !empty($search['per_page']) ? $search['per_page'] : 10;
        if(!empty($search)) {
            if(!empty($search['search'])) {
                $results = $results->where([['name', 'LIKE', '%'.$search['search'].'%'], ['dlt','0']]);
            }
        }
        if($option=='paginate') {
            return $results->paginate($per_page);
        } else if ($option == 'select') {
            return $results->pluck('name', 'id');
        } else {
            return $results->get();
        }
    }

    public function saveSuratKeluar(Array $data)
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

        DB::table('history_surat_keluar')->insert([
            'surat_keluar_id' => $this->id,
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
