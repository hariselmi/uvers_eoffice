<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Member extends Model
{
    use HasFactory;

    public function getAll($option=null, $search=null) {

        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;

        $results = $this->select('users.id')
        ->leftJoin('users', 'members.users_id', 'users.id');


        if ($userRole != 'admin') {
            
            $results = $this->select('members.id', 'members.auditor_id','members.users_id','users.email')->where(['dlt'=>'0', 'auditor_id'=>$userId])->leftJoin('users', 'members.users_id', 'users.id')->orderBy('members.created_at');
        }else{

            $results = $this->select('members.id', 'members.auditor_id','members.users_id','users.email')->where('dlt','0')->leftJoin('users', 'members.users_id', 'users.id')->orderBy('members.created_at');
        }
        // dd($results->get());

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

    public function saveMember(Array $data)
    {
        // $this->id;
        $this->auditor_id = $data['auditor_id'];
        $this->users_id = $data['users_id'];
        $this->save();
    }

    public function getById($id) {
        return $this->findOrFail($id);
    }

}
