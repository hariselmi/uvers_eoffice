<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use Get_field;

class PelaporanEoffice extends Model
{
    use HasFactory;
    protected $table = 'surat_masuk_laporan';
    public $timestamps = true;
    public function getAll($option=null, $search=null) {

        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;

        $results = $this->select('users.id')
        ->leftJoin('users', 'surat_masuk_laporan.users_id', 'users.id');
        

        if ($userRole == 'Admin') {


            $results = $this->select('*')->where([['dlt','0'],['laporan','1']])->orderBy('surat_masuk_laporan.created_at');


        } elseif ($userRole == 'Staff') {


            $results = $this->select('*')->where([['dlt','0'],['laporan','1']])->orderBy('surat_masuk_laporan.created_at');


        } else{


            $jabatan_id = Get_field::get_data(Auth::user()->pegawai_id, 'pegawai', 'jabatan_id');
            $unit_kerja_id = Get_field::get_data(Auth::user()->pegawai_id, 'pegawai', 'unit_kerja_id');
            $hak_approval = Get_field::get_data($jabatan_id, 'jabatan', 'hak_approval');
            $kepalaunit = Get_field::get_data(Auth::user()->pegawai_id, 'pegawai', 'kepala_unit');

            
            if($unit_kerja_id == '2') {
                $results = $this->select('*')->where([['dlt','0'],['laporan','1']])->orderBy('surat_masuk_laporan.created_at','DESC');

            }else{

                if($kepalaunit == '2')
                {
                    $results = $this->select('*')->where([['dlt','0'],['laporan','1'],['laporan_unit_kerja_id', $unit_kerja_id]])->orderBy('surat_masuk_laporan.created_at','DESC');
                }
                else{
                    
                    $results = $this->select('*')->where([['dlt','0'],['laporan','1'],['laporan_pegawai_id', Auth::user()->pegawai_id]])->orderBy('surat_masuk_laporan.created_at','DESC');
                }
            }



        }

        $per_page = !empty($search['per_page']) ? $search['per_page'] : 10;
        if(!empty($search)) {
            if(!empty($search['search'])) {
                $results = $results->where([['perihal', 'LIKE', '%'.$search['search'].'%'], ['dlt','0'], ['laporan','1']])
                ->orWhere([['no_surat', 'LIKE', '%'.$search['search'].'%'], ['dlt','0'], ['laporan','1']])
                ->orWhere([['tgl_surat', 'LIKE', '%'.$search['search'].'%'], ['dlt','0'], ['laporan','1']])
                ->orWhere([['asal_surat', 'LIKE', '%'.$search['search'].'%'], ['dlt','0'], ['laporan','1']]);
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

    public function savePelaporanEoffice(Array $data)
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

        DB::table('history_surat_masuk')->insert([
            'surat_masuk_id' => $this->id,
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
