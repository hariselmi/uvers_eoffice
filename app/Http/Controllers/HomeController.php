<?php namespace App\Http\Controllers;

use App\Item, App\Customer, App\Sale;
use App\Supplier, App\Receiving, App\User;
use App;
use Auth;
use App\Account;
use App\Expense;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $userRole   = Auth::user()->role;
        $userId     = Auth::user()->id;


        if (session('role') == 'auditor') {
            # code...
            $pending = DB::table('schedules')->where([['dlt', '0'], ['status', 1], ['auditor_id', $userId]])->count();
            $process = DB::table('schedules')->where([['dlt', '0'], ['status', 2], ['auditor_id', $userId]])->count();
            $complete = DB::table('schedules')->where([['dlt', '0'], ['status', 3], ['auditor_id', $userId]])->count();
            $cancel = DB::table('schedules')->where([['dlt', '0'], ['status', 4], ['auditor_id', $userId]])->count();

        } else if (session('role') == 'auditee') {
            # code...
            $pending = DB::table('schedules')->where([['dlt', '0'], ['status', 1], ['auditee_id', $userId]])->count();
            $process = DB::table('schedules')->where([['dlt', '0'], ['status', 2], ['auditee_id', $userId]])->count();
            $complete = DB::table('schedules')->where([['dlt', '0'], ['status', 3], ['auditee_id', $userId]])->count();
            $cancel = DB::table('schedules')->where([['dlt', '0'], ['status', 4], ['auditee_id', $userId]])->count();

        }  else if (session('role') == 'anggota') {
            # code...
            $pending = DB::table('schedules')->where([['dlt', '0'], ['status', 1], ['member_one', $userId]])
                        ->orWhere([['dlt', '0'], ['status', 1], ['member_two', $userId]])->count();
            $process = DB::table('schedules')->where([['dlt', '0'], ['status', 2], ['member_one', $userId]])
                    ->orWhere([['dlt', '0'], ['status', 2], ['member_two', $userId]])->count();
            $complete = DB::table('schedules')->where([['dlt', '0'], ['status', 3], ['member_one', $userId]])
                    ->orWhere([['dlt', '0'], ['status', 3], ['member_two', $userId]])->count();
            $cancel = DB::table('schedules')->where([['dlt', '0'], ['status', 4], ['member_one', $userId]])
                    ->orWhere([['dlt', '0'], ['status', 4], ['member_two', $userId]])->count();

        }   else {
            # code...
            $pending = DB::table('schedules')->where([['dlt', '0'], ['status', 1]])->count();
            $process = DB::table('schedules')->where([['dlt', '0'], ['status', 2]])->count();
            $complete = DB::table('schedules')->where([['dlt', '0'], ['status', 3]])->count();
            $cancel = DB::table('schedules')->where([['dlt', '0'], ['status', 4]])->count();
        }

        $periods = DB::table('periods')->where('dlt', '0')->get();
        $period_current_id = DB::table('periods')->where([['dlt', '0'], ['status', '1']])->first();

        return view('home')->with([
            'pending'=>$pending,
            'process'=>$process,
            'complete'=>$complete,
            'cancel'=>$cancel,
            'periods'=>$periods,
            'period_current_id'=>$period_current_id->id,
        ]);
    }

    public function setRole(Request $request, $id){
        $request->session()->put('role', $id);

        return redirect()->back();
    }


    
    public function period_filter(Request $request){

    $period_id = $request->period_id;

    $pending = DB::table('schedules')->where([['dlt', '0'], ['status', 1], ['period_id', $period_id]])->count();
    $process = DB::table('schedules')->where([['dlt', '0'], ['status', 2], ['period_id', $period_id]])->count();
    $complete = DB::table('schedules')->where([['dlt', '0'], ['status', 3], ['period_id', $period_id]])->count();
    $cancel = DB::table('schedules')->where([['dlt', '0'], ['status', 4], ['period_id', $period_id]])->count();


    $data['period_id']  = $period_id;
    $data['pending']    = $pending;
    $data['process']    = $process;
    $data['complete']   = $complete;
    $data['cancel']     = $cancel;

    return $data;

}
}
