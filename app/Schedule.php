<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Document;
use App\CheckList;
use App\Finding;
use App\Reports;
use App\UploadDocument;
use Auth;
use Illuminate\Support\Facades\DB;

class Schedule extends Model
{
    use HasFactory;
    
    public function getAll($option=null, $search=null) {

        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;


        if ($userRole == 'member') {


            if(session('role') == 'auditor'){

            $results = $this->select('schedules.status', 'schedules.standard_id', 'schedules.id as schedule_id', 'schedules.schedule_date', 'schedules.clock_start_id', 'schedules.clock_finish_id', 'schedules.period_id', 'auditor.id as auditor_id', 'auditor.name as auditor_name', 'auditee.id as auditee_id', 'auditee.name as auditee_name', 'schedules.division_id','schedules.member_one','schedules.member_two')
            ->where(['schedules.dlt'=>'0', 'schedules.auditor_id'=> $userId])
            ->leftJoin('users as auditor', 'schedules.auditor_id', 'auditor.id')
            ->leftJoin('users as auditee', 'schedules.auditee_id', 'auditee.id')
            ->orderBy('schedules.created_at');

            }elseif(session('role') == 'auditee'){
            $results = $this->select('schedules.status', 'schedules.standard_id', 'schedules.id as schedule_id', 'schedules.schedule_date', 'schedules.clock_start_id', 'schedules.clock_finish_id', 'schedules.period_id', 'auditor.id as auditor_id', 'auditor.name as auditor_name', 'auditee.id as auditee_id', 'auditee.name as auditee_name', 'schedules.division_id','schedules.member_one','schedules.member_two')
            ->where(['schedules.dlt'=>'0', 'schedules.auditee_id'=> $userId])
            ->whereIn('schedules.status', [2,3])
            ->leftJoin('users as auditor', 'schedules.auditor_id', 'auditor.id')
            ->leftJoin('users as auditee', 'schedules.auditee_id', 'auditee.id')
            ->orderBy('schedules.created_at');

            }else{
            $results = $this->select('schedules.status', 'schedules.standard_id', 'schedules.id as schedule_id', 'schedules.schedule_date', 'schedules.clock_start_id', 'schedules.clock_finish_id', 'schedules.period_id', 'auditor.id as auditor_id', 'auditor.name as auditor_name', 'auditee.id as auditee_id', 'auditee.name as auditee_name', 'schedules.division_id','schedules.member_one','schedules.member_two')
            ->where('schedules.dlt' , '0')
            ->where(function ($query) {
                $userId     = Auth::user()->id;

                       $query->where('schedules.member_one', '=', $userId)
                             ->orWhere('schedules.member_two', '=', $userId);
                   })
            ->leftJoin('users as auditor', 'schedules.auditor_id', 'auditor.id')
            ->leftJoin('users as auditee', 'schedules.auditee_id', 'auditee.id')
            ->orderBy('schedules.created_at');


            }



        }else{
            $results = $this->select('schedules.status', 'schedules.standard_id', 'schedules.id as schedule_id', 'schedules.schedule_date', 'schedules.clock_start_id', 'schedules.clock_finish_id', 'schedules.period_id', 'auditor.id as auditor_id', 'auditor.name as auditor_name', 'auditee.id as auditee_id', 'auditee.name as auditee_name','schedules.division_id','schedules.member_one','schedules.member_two')
            ->where(['schedules.dlt'=>'0'])
            ->leftJoin('users as auditor', 'schedules.auditor_id', 'auditor.id')
            ->leftJoin('users as auditee', 'schedules.auditee_id', 'auditee.id')
            ->orderBy('schedules.created_at');
        }

        // dd($results->get());
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


    public function saveSchedule(Array $data)
    {
        $standard_documents = DB::table('standard_documents')->where(['dlt'=>'0', 'standard_detail_id'=> $data['standard_detail_id']])->get();

        $this->schedule_date = date('Y-m-d', strtotime($data['schedule_date']));
        $this->clock_start_id = $data['clock_start_id'];
        $this->clock_finish_id = $data['clock_finish_id'];
        $this->auditor_id = $data['auditor_id'];
        $this->auditee_id = $data['auditee_id'];
        $this->division_id = $data['division_id'];
        $this->period_id = $data['period_id'];
        $this->member_one = $data['member_one'];
        $this->member_two = $data['member_two'];
        $this->standard_id = $data['standard_id'];
        $this->standard_detail_id = $data['standard_detail_id'];
        $this->status = $data['status'];
        $this->save();

        $document = new Document;
        $document->schedule_id =  $this->id;
        $document->status =  0;
        $document->save();

        $document = new CheckList;
        $document->schedule_id =  $this->id;
        $document->status =  0;
        $document->save();

        $document = new Finding;
        $document->schedule_id =  $this->id;
        $document->status =  0;
        $document->save();

        $document = new Reports;
        $document->schedule_id =  $this->id;
        $document->save();

        $document = new UploadDocument;
        $document->schedule_id =  $this->id;
        $document->status =  0;
        $document->save();

        if (!empty($standard_documents)) {
            # code...
            for ($i=0; $i < count($standard_documents); $i++) { 
                # code...
                DB::table('document_details')->insert([
                    'document_id'=> $document->id,
                    'document'=>$standard_documents[$i]->document
                ]);
            }
        }
    }


    public function updateSchedule(Array $data)
    {

        if(session('role') == 'auditor'){

            $this->status = $data['status'];
            $this->save();

        }else{
            $this->schedule_date = date('Y-m-d', strtotime($data['schedule_date']));
            $this->clock_start_id = $data['clock_start_id'];
            $this->clock_finish_id = $data['clock_finish_id'];
            $this->auditor_id = $data['auditor_id'];
            $this->auditee_id = $data['auditee_id'];
            $this->division_id = $data['division_id'];
            $this->period_id = $data['period_id'];
            $this->member_one = $data['member_one'];
            $this->member_two = $data['member_two'];
            $this->standard_id = $data['standard_id'];
            $this->standard_detail_id = $data['standard_detail_id'];
            $this->status = $data['status'];

            $this->save();

         $standard_documents = DB::table('standard_documents')->where(['dlt'=>'0', 'standard_detail_id'=> $data['standard_detail_id']])->get();
        $document = DB::table('documents')->where(['dlt'=>'0', 'schedule_id'=> $this->id])->first();


        // dd($document);

        DB::table('document_details')->where('document_id', $document->id)->update([
            'dlt'=> '1'
        ]);


        if (!empty($standard_documents)) {
            # code...
            for ($i=0; $i < count($standard_documents); $i++) { 
                # code...
                DB::table('document_details')->insert([
                    'document_id'=> $document->id,
                    'document'=>$standard_documents[$i]->document
                ]);
            }
        }
            }



        



    }


    public function getById($id) {
        return $this->findOrFail($id);
    }
}
