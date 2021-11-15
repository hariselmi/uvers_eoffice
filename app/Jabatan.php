<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    protected $table = 'jabatan';

    public function getAll($option=null, $search=null) {
        $results = $this->where('softdelete','0');

        $per_page = !empty($search['per_page']) ? $search['per_page'] : 10;
        if(!empty($search)) {
            if(!empty($search['search'])) {
                $results = $results->where('nama', 'LIKE', '%'.$search['search'].'%');
            }
        }
        if($option=='paginate') {
            return $results->paginate($per_page);
        } else if ($option == 'select') {
            return $results->pluck('nama', 'id');
        } else {
            return $results->get();
        }
    }

    public function SaveJabatan(Array $data)
    {
        $this->nama = $data['nama'];
        $this->keterangan = $data['keterangan'];
        $this->updated_at = date('Y-m-d H:i:s');
        $this->save();
    }

    public function getById($id) {
        return $this->findOrFail($id);
    }
}
