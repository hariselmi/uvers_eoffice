<?php
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
 
class Get_field {
    public static function get_data($id, $table, $field) {
        $get_data = DB::table($table)->where('id', $id)->first();
        return (isset($get_data->$field) ? $get_data->$field : '');
    }



  public static function format_indo($date){
    date_default_timezone_set('Asia/Jakarta');
    // array hari dan bulan
    $Hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
    $Bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
    
    // pemisahan tahun, bulan, hari, dan waktu
    $tahun = substr($date,0,4);
    $bulan = substr($date,5,2);
    $tgl = substr($date,8,2);
    $waktu = substr($date,11,5);
    $hari = date("w",strtotime($date));
    if(!empty($date)){
        $result = $tgl." ".$Bulan[(int)$bulan-1]." ".$tahun." ".$waktu;
    }else{
        $result = '';
    }


    return $result;

  }
}