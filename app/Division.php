<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    public function getAll($option=null, $search=null) {
        $results = $this->where('dlt', '0')->OrderBy('id', 'ASC')->latest();

        $per_page = !empty($search['per_page']) ? $search['per_page'] : 10;
        if(!empty($search)) {
            if(!empty($search['search'])) {
                $results = $results->where('title', 'LIKE', '%'.$search['search'].'%');
            }
        }
        if($option=='paginate') {
            return $results->paginate($per_page);
        } else if ($option == 'select') {
            return $results->pluck('title', 'id');
        } else {
            return $results->get();
        }
    }


    public function saveDivision(Array $data)
    {

        $this->parent_id = $data['parent_id'];
        $this->title = $data['title'];

        $this->save();
    }

    public function getById($id) {
        return $this->findOrFail($id);
    }
}
