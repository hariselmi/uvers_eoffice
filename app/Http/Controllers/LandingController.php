<?php namespace App\Http\Controllers;

use App\Item, App\Customer, App\Sale;
use App\Supplier, App\Receiving, App\User;
use App;
use App\Account;
use App\Expense;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        
        $articles_standar = DB::table('articles')
                    ->select('*')
                    ->where('category','1')
                    ->where('dlt','0')
                    ->orderBy('id', 'desc')
                    ->limit('3')
                    ->get();

        $articles_agenda = DB::table('articles')
                    ->select('*')
                    ->where('category','2')
                    ->where('dlt','0')
                    ->orderBy('id', 'desc')
                    ->limit('3')
                    ->get();

        return view('landing.landing', compact('articles_standar','articles_agenda'));

    }

    public function articles_details($id)
    {
        //



        $articles = DB::table('articles')
                    ->select('*')
                    ->where('id',$id)
                    ->first();


        $recent_posts = DB::table('articles')
                    ->select('*')
                    ->where('category', $articles->category)
                    ->where('id', '!=', $id)
                    ->orderBy('id', 'desc')
                    ->limit('10')
                    ->get();

        return view('landing.articles_details', compact('articles','recent_posts'));

    }



    public function proses_bisnis_uvers()
    {
        return view('landing.proses');
    }
    public function kebijakan_standar_uvers()
    {
        return view('landing.kebijakan');
    }
    public function standar_pendidikan_1()
    {
        return view('landing.standar_pendidikan_1');
    }
    public function standar_pendidikan_2()
    {
        return view('landing.standar_pendidikan_2');
    }
    public function standar_pendidikan_3()
    {
        return view('landing.standar_pendidikan_3');
    }
    public function standar_pendidikan_4()
    {
        return view('landing.standar_pendidikan_4');
    }
    public function standar_pendidikan_5()
    {
        return view('landing.standar_pendidikan_5');
    }
    public function standar_pendidikan_6()
    {
        return view('landing.standar_pendidikan_6');
    }
    public function standar_pendidikan_7()
    {
        return view('landing.standar_pendidikan_7');
    }
    public function standar_pendidikan_8()
    {
        return view('landing.standar_pendidikan_8');
    }

    public function standar_penelitian_1()
    {
        return view('landing.standar_penelitian_1');
    }
    public function standar_penelitian_2()
    {
        return view('landing.standar_penelitian_2');
    }
    public function standar_penelitian_3()
    {
        return view('landing.standar_penelitian_3');
    }
    public function standar_penelitian_4()
    {
        return view('landing.standar_penelitian_4');
    }
    public function standar_penelitian_5()
    {
        return view('landing.standar_penelitian_5');
    }
    public function standar_penelitian_6()
    {
        return view('landing.standar_penelitian_6');
    }
    public function standar_penelitian_7()
    {
        return view('landing.standar_penelitian_7');
    }
    public function standar_penelitian_8()
    {
        return view('landing.standar_penelitian_8');
    }
    public function standar_pengabdian_1()
    {
        return view('landing.standar_pengabdian_1');
    }
    public function standar_pengabdian_2()
    {
        return view('landing.standar_pengabdian_2');
    }
    public function standar_pengabdian_3()
    {
        return view('landing.standar_pengabdian_3');
    }
    public function standar_pengabdian_4()
    {
        return view('landing.standar_pengabdian_4');
    }
    public function standar_pengabdian_5()
    {
        return view('landing.standar_pengabdian_5');
    }
    public function standar_pengabdian_6()
    {
        return view('landing.standar_pengabdian_6');
    }
    public function standar_pengabdian_7()
    {
        return view('landing.standar_pengabdian_7');
    }
    public function standar_pengabdian_8()
    {
        return view('landing.standar_pengabdian_8');
    }
    public function sop_uvers_1()
    {
        return view('landing.sop_uvers_1');
    }
    public function sop_uvers_2()
    {
        return view('landing.sop_uvers_2');
    }
    public function sop_uvers_3()
    {
        return view('landing.sop_uvers_3');
    }

    public function pembaruan_standar_mutu()
    {
        return view('landing.pembaruan_standar_mutu');
    }
    public function agenda_kegiatan_lpm()
    {
        return view('landing.agenda_kegiatan_lpm');
    }
    public function pembaruan_standar_mutu_details()
    {
        return view('landing.pembaruan_standar_mutu_details');
    }
    public function agenda_kegiatan_lpm_details()
    {
        return view('landing.agenda_kegiatan_lpm_details');
    }

   

}
