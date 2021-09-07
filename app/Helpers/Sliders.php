<?php
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
 
class Sliders {
    public static function get_slider() {
        $slider = DB::table('sliders')->where('status','1')->get();
        return $slider;
    }
}