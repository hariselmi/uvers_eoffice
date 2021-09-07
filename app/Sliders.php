<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sliders extends Model
{
    use HasFactory;

    public function getAll($option=null, $search=null) {
        $results = $this->where('dlt', '0')->latest();

        $per_page = !empty($search['per_page']) ? $search['per_page'] : 10;

        if(!empty($search)) {
            if(!empty($search['search'])) {
                $results = $results->where('title', 'LIKE', '%'.$search['search'].'%');
            }
        }

        if($option=='paginate') {
            return $results->paginate($per_page);
        } else if ($option == 'select') {
            return $results->pluck('title','id');
        } else {
            return $results->get();
        }
    }


    public function saveSliders(Array $data)
    {
        // $this->id;

        if ($data['thumbnail']) {
            # code...

            $thumbnail = $data['thumbnail'];

            $nameGenerate = hexdec(uniqid());
            $imgName = strtolower($thumbnail->getClientOriginalName());
            $imgNewName = $nameGenerate.'_'.$imgName;
            $uploadLocation = public_path().'/images/slider';
            # code...
            $thumbnail->move($uploadLocation,$imgNewName);
        }

        $this->title = $data['title'];
        $this->status = $data['status'];
        $this->thumbnail = $imgNewName;
        $this->save();
    }

    public function getById($id) {
        return $this->findOrFail($id);
    }
}
