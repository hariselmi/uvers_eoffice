<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Reports extends Model
{
    use HasFactory;
    
    public function getAll($option=null, $search=null) {

        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;

        if ($userRole == 'member') {

            $results = $this->select('reports.id', 'reports.schedule_id', 'schedules.division_id', 'schedules.schedule_date', 'schedules.clock_start_id', 'schedules.clock_finish_id', 'schedules.status', 'auditor.name as auditor_name', 'auditee.name as auditee_name','schedules.period_id')
            ->where(['schedules.dlt' => '0', 'schedules.status'=> '3' ,'schedules.auditor_id'=> $userId])
            ->leftJoin('schedules', 'reports.schedule_id', 'schedules.id')
            ->leftJoin('users as auditor', 'schedules.auditor_id', 'auditor.id')
            ->leftJoin('users as auditee', 'schedules.auditee_id', 'auditee.id')
            ->orderBy('schedules.created_at');

        }else{
            $results = $this->select('reports.id', 'reports.schedule_id', 'schedules.division_id', 'schedules.schedule_date', 'schedules.clock_start_id', 'schedules.clock_finish_id', 'schedules.status', 'auditor.name as auditor_name', 'auditee.name as auditee_name','schedules.period_id')
            ->leftJoin('schedules', 'reports.schedule_id', 'schedules.id')
            ->leftJoin('users as auditor', 'schedules.auditor_id', 'auditor.id')
            ->leftJoin('users as auditee', 'schedules.auditee_id', 'auditee.id')
            ->where(['schedules.dlt'=>'0', 'schedules.status'=> '3'])
            ->orderBy('schedules.created_at');
        }


        $per_page = !empty($search['per_page']) ? $search['per_page'] : 10;
        if(!empty($search)) {
            if(!empty($search['search'])) {
                $results = $results->where([['auditor.name', 'LIKE', '%'.$search['search'].'%'], ['schedules.dlt','0']])
                ->orWhere([['auditee.name', 'LIKE', '%'.$search['search'].'%'], ['schedules.dlt','0']])
                ->orWhere([['schedule_date', 'LIKE', '%'.$search['search'].'%'], ['schedules.dlt','0']]);
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
}
