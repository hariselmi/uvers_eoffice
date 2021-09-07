<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StandardDetail extends Model
{
    use HasFactory;

    public function getAll($option=null, $search=null) {
        $results = $this->where('dlt','0')->latest();

        $per_page = !empty($search['per_page']) ? $search['per_page'] : 10;
        if(!empty($search)) {
            if(!empty($search['search'])) {
                $results = $results->where('standard', 'LIKE', '%'.$search['search'].'%');
            }
        }
        if($option=='paginate') {
            return $results->paginate($per_page);
        } else if ($option == 'select') {
            return $results->pluck('standard', 'id');
        } else {
            return $results->get();
        }
    }

    public function saveStandardDetail(Array $data)
    {
        // $this->id;
        $this->standard = $data['standard'];
        $this->save();

        if (!empty($data->document)) {
            # code...
        }
    }

    public function getById($id) {
        return $this->findOrFail($id);
    }
}
