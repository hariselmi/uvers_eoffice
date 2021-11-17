<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use Get_field;

class PelaporanRepositoriInternal extends Model
{
    use HasFactory;
    protected $table = 'surat_keluar';
    public $timestamps = true;
    public function getAll($option=null, $search=null) {

        $results = $this->select('*')->where([['dlt','0'],['status','5']])->orderBy('surat_keluar.created_at','DESC');
    

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
