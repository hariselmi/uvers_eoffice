<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use Get_field;

class PelaporanRepositori extends Model
{
    use HasFactory;
    protected $table = 'surat_masuk';
    public $timestamps = true;
    public function getAll($option=null, $search=null) {



        $results = $this->select('surat_masuk_laporan.surat_masuk_id','surat_masuk.id','surat_masuk.pegawai_id','surat_masuk.status','surat_masuk.no_surat','surat_masuk.perihal','surat_masuk.asal_surat','surat_masuk.tujuan_surat','surat_masuk.isi_ringkasan','surat_masuk.tgl_surat','surat_masuk.jenis_id','surat_masuk.media_id','surat_masuk.file_surat','surat_masuk.created_at','surat_masuk.updated_at','surat_masuk.dlt')
                ->leftJoin('surat_masuk_laporan', 'surat_masuk_laporan.surat_masuk_id', 'surat_masuk.id')
                ->where([['surat_masuk.dlt','0'],['surat_masuk_laporan.status','5']])->orderBy('surat_masuk.created_at','DESC')
                ->groupBy('surat_masuk_laporan.surat_masuk_id','surat_masuk.id','surat_masuk.pegawai_id','surat_masuk.status','surat_masuk.no_surat','surat_masuk.perihal','surat_masuk.asal_surat','surat_masuk.tujuan_surat','surat_masuk.isi_ringkasan','surat_masuk.tgl_surat','surat_masuk.jenis_id','surat_masuk.media_id','surat_masuk.file_surat','surat_masuk.created_at','surat_masuk.updated_at','surat_masuk.dlt');
        

        $per_page = !empty($search['per_page']) ? $search['per_page'] : 10;
        if(!empty($search)) {
            if(!empty($search['search'])) {
                $results = $results->where([['perihal', 'LIKE', '%'.$search['search'].'%'], ['dlt','0'],['status','5']])
                ->orWhere([['no_surat', 'LIKE', '%'.$search['search'].'%'], ['dlt','0'],['status','5']])
                ->orWhere([['tgl_surat', 'LIKE', '%'.$search['search'].'%'], ['dlt','0'],['status','5']])
                ->orWhere([['asal_surat', 'LIKE', '%'.$search['search'].'%'], ['dlt','0'],['status','5']]);
            }
        }
        if($option=='paginate') {
            return $results->paginate($per_page);
        } else if ($option == 'select') {
            return $results->pluck('no_surat', 'id');
        } else {
            return $results->get();
        }
    }

    public function getById($id) {
        return $this->findOrFail($id);
    }

}
