<?php

namespace App\Http\Controllers;

use App\CustomerPayment;
use App\DailyReport;
use App\Expense;
use App\FlexiblePosSetting;
use App\Receiving;
use App\ReceivingPayment;
use App\Sale;
use App\SalePayment;
use App\SupplierPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DailyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $search = [];
            if(!empty($request->filter)) {
                $search = $request->filter;
                Session::put('customer_filter', $search);
            } else if( Session::get('customer_filter')) {
                $search = Session::get('customer_filter');
            }
            $data['dailyreports'] = (new DailyReport())->getAll('paginate', $search);
            return $this->commonResponse($data, null, 'index');
        }
        $data['dailyreports'] = (new DailyReport())->getAll('paginate');
        return view('report.report-summary.reportsummary', $data);
    }

    // public function getDailyReport(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $daily_sales = SalePayment::whereDate("created_at", '=', $request->DateCreated)->get();
    //         //return $daily_sales;
    //         $customer_payments = CustomerPayment::whereDate("created_at", '=', $request->DateCreated)->get();
    //         $receiving_payments = ReceivingPayment::whereDate("created_at", '=', $request->DateCreated)->get();
    //         $expenses = Expense::whereDate("created_at", '=', $request->DateCreated)->get();

    //         $dailyreport = DailyReport::whereDate("created_at", '=', $request->DateCreated)->first();
    //         $settings = FlexiblePosSetting::orderBY("created_at", 'desc')->first();
    //         if ($dailyreport) {
    //             $prev_balance = DailyReport::latest()->first()->prev_balance;
    //         } else {
    //             $prev_report  = DailyReport::latest()->first();
    //             if (!$prev_report) {
    //                 $prev_balance = DB::table('flexible_pos_settings')->first()->starting_balance;
    //             } else {
    //                 $prev_balance = $prev_report->net_balance;
    //             }
    //             $dailyreport = array();
    //         }
            
    //         return view('report.report', compact('prev_balance', 'dailyreport', 'daily_sales', 'customer_payments', 'receiving_payments', 'expenses', 'request'));
    //     }
    // }

    // public function createPastDailyReport(Request $request)
    // {
    //     $prev_report  = DailyReport::latest()->first();
    //     $dailyReport = new DailyReport();
    //     if (is_null($prev_report)) {
    //         $dailyReport->prev_balance = DB::table('flexible_pos_settings')->first()->starting_balance;
    //     } else {
    //         $dailyReport->prev_balance = $prev_report->net_balance;
    //     }
    //     $total_sales = $dailyReport->total_sales = DB::table('sales')->whereDate('created_at', '=', $request->DateCreated)->sum('grand_total');
    //     $total_sale_payment = $dailyReport->total_payment = DB::table('sale_payments')->whereDate('created_at', '=', $request->DateCreated)->sum('payment');
    //     $dailyReport->total_dues = DB::table('sales')->whereDate('created_at', '=', $request->DateCreated)->sum('dues');
    //     $dailyReport->sale_profit = $total_sales - DB::table('sale_items')->whereDate('created_at', '=', $request->DateCreated)->sum('total_cost');
    //     $total_customer_payment = DB::table('customer_payments')->whereDate('created_at', '=', $request->DateCreated)->sum('payment');
    //     $total_income = $dailyReport->total_income = $total_sale_payment + $total_customer_payment;
    //     $total_expense = $dailyReport->total_expense = DB::table('expenses')->whereDate('created_at', '=', $request->DateCreated)->sum('payment');
    //     $dailyReport->total_receivings = DB::table('receivings')->whereDate('created_at', '=', $request->DateCreated)->sum('total');
    //     $total_receivings_payment = $dailyReport->total_receivings_payment = DB::table('receiving_payments')->whereDate('created_at', '=', $request->DateCreated)->sum('payment');
    //     $dailyReport->total_receivings_dues = DB::table('receivings')->whereDate('created_at', '=', $request->DateCreated)->sum('total');
    //     $total_supplier_payment = $dailyReport->total_supplier_payment = DB::table('supplier_payments')->whereDate('created_at', '=', $request->DateCreated)->sum('payment');
    //     $total_costing = $dailyReport->total_costing = $total_expense + $total_receivings_payment + $total_supplier_payment;
    //     $total_profit = $dailyReport->total_profit = $total_income - $total_costing;
    //     $dailyReport->net_balance = $dailyReport->prev_balance + $total_profit;
    //     $dailyReport->user_id = Auth::user()->id;
    //     $dailyReport->created_at = $request->DateCreated ." 10:00:00";
    //     $dailyReport->save();
    //     Session::flash('message', __('Daily Report Closed Successfully'));
    //     return redirect('reports/dailyreport');
    // }

    // public function createDailyReport()
    // {
    //     $this->processDailyReport(date('Y-m-d'));
    //     Session::flash('message', __('Daily Report Closed Successfully'));
    //     return redirect('reports/dailyreport');
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $date = !empty($request->date) ? $request->date : date('Y-m-d');
        $type= $request->ajax() ? 'ajax' : null;
        return $this->showReport($date, ['request'=>$type]);
    }

    private function showReport($date, $option=null) {
        $dailyreport  = (new DailyReport())->getAll('last');
        //getting starting balance
        $data['starting_balance'] = 0;
        if (empty($dailyreport)) {
            if (empty(setting('starting_balance'))) {
                Session::flash('message', 'Please make settings for your application.');
                return redirect(route('flexiblepossetting.create'));
            } else {
                $data['starting_balance'] = setting('starting_balance');
            }
        } elseif ($dailyreport) {
            $data['starting_balance'] = $dailyreport->net_balance;
        }
        $data['dailyreport'] = $dailyreport;
        $data['exist_report'] = (new DailyReport())->getByDate($date);
        //DailyReport::whereDate('created_at', '=', $date)->first();
        $all_daily_sales = (new SalePayment())->getSalePayment(null, ['date'=>$date]);
        $data['daily_sales'] = $all_daily_sales->get();

        $all_customer_payments = (new CustomerPayment())->getCustomerPayment(['date'=>$date]);
        $data['customer_payments'] =  $all_customer_payments->get();

        $all_rec_payments = (new ReceivingPayment())->getReceivingPayment(null, ['date'=>$date]);
        $data['receiving_payments'] = $all_rec_payments->get();

        $all_expenses = (new Expense())->getAll(null, ['date'=>$date]);
        $data['expenses'] = $all_expenses->get();

        $all_suppliers = ((new SupplierPayment())->getSupplierPayment(['date'=>$date]));
        $data['supplier_payments'] = $all_suppliers->get();

        $data['total_credit'] = $all_daily_sales->sum('payment') + $all_customer_payments->sum('payment');
        $data['total_debit'] = $all_rec_payments->sum('payment') + $all_expenses->sum('payment') + $all_suppliers->sum('payment');
        $data['date'] = $date;
        $data['action'] = !empty($option['action']) ? $option['action'] : 'add';
        if($option['request'] == 'ajax') {
            $notify = !empty($option['notify']) ? $option['notify'] : null;
           return $this->commonResponse($data, $notify, 'show');
        }
        return view('report.dailyreport', $data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = !empty($request->date) ? $request->date : date('Y-m-d');
        $check_date = $this->checkDailyReport($date);
        if($check_date != $date) {
            $option = [
                'request'=>'ajax',
                'notify'=>__('You should close the previous report!')
            ];
            return $this->showReport($check_date, $option);
        }
        $input = $request->all();
        $this->processDailyReport($date, $input);
        $option = [
            'request'=>'ajax',
            'notify'=>__('Daily Report Closed Successfully')
        ];
        return $this->showReport($check_date, $option);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $date
     * @return \Illuminate\Http\Response
     */
    public function edit($date)
    {
        $option = ['action'=>'edit', 'request'=>null];
        return $this->showReport($date, $option);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $report = (new DailyReport())->getById($id);
        $date = $report->created_at->format('Y-m-d');
        if($report->delete()) {
            $input = $request->all();
            $this->processDailyReport($date, $input);
            $option = [
                'request'=>'ajax',
                'notify'=>__('Daily Report Updated Successfully')
            ];
        }
        return $this->showReport($date, $option);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $daily_reportObj = new DailyReport();
        $last_daily_report = $daily_reportObj->getAll('last');
        if ($last_daily_report->id == $id) {
            $daily_reportObj->getById($id)->delete();
            $data['dailyreports'] = (new DailyReport())->getAll('paginate');
            return $this->commonResponse($data, __('Daily Report deleted successfully!'), 'index');
        } else {
            return $this->commonResponse([], ['warning'=>__("This Daily Report can't be deleted, Only last created report can be deleted!")]);
        }
    }

    private function processDailyReport($date, $input=null)
    {
        $all_sales = (new Sale())->getSales(['date'=>$date]);
        $input['total_sales'] = $all_sales->sum('grand_total');
        $input['total_dues'] = $all_sales->sum('dues');
        $input['total_payment'] = ((new SalePayment())->getSalePayment(null, ['date'=>$date]))->sum('payment');
        $input['sale_profit'] = $input['total_sales'] - DB::table('sale_items')->whereDate('created_at', '=', $date)->sum('total_cost');

        $total_customer_payment = ((new CustomerPayment())->getCustomerPayment(['date'=>$date]))->sum('payment');
        $input['total_income'] = $input['total_payment'] + $total_customer_payment;

        $input['total_expense'] = ((new Expense())->getAll(null, ['date'=>$date]))->sum('payment');
        $all_receivings = (new Receiving())->getReceivings(['date'=>$date]);
        $input['total_receivings'] = $all_receivings->sum('total');
        $input['total_receivings_dues'] = $all_receivings->sum('dues');
        $input['total_receivings_payment'] = ((new ReceivingPayment())->getReceivingPayment(null, ['date'=>$date]))->sum('payment');
        $input['total_supplier_payment'] = ((new SupplierPayment())->getSupplierPayment(['date'=>$date]))->sum('payment');
        $input['user_id'] = Auth::user()->id;
        $input['date'] = $date;
        $dailyReport = new DailyReport();
        $dailyReport->saveDailyReport($input);
    }

    private function checkDailyReport($date) {
        $dailyreport  = (new DailyReport())->getAll();
        // dd($dailyreport);
        $last_date = null;
        if($dailyreport->count() == 0){
            $sale_payments = (new SalePayment())->getSalePayment();
            $customer_payments = (new CustomerPayment())->getCustomerPayment();
            $receiving_payments = (new ReceivingPayment())->getReceivingPayment();
            $supplier_payments = (new SupplierPayment())->getSupplierPayment();
            $expenses = (new Expense())->getAll();
            if(count($sale_payments->get())) {
                $date_array[] = $sale_payments->get()->last()->created_at->format('Y-m-d');
            }
            if(count($customer_payments->get())) {
                $date_array[] = $customer_payments->get()->last()->created_at->format('Y-m-d');
            }
            if(count($receiving_payments->get())) {
                $date_array[] = $receiving_payments->get()->last()->created_at->format('Y-m-d');
            }
            if(count($supplier_payments->get())) {
                $date_array[] = $supplier_payments->get()->last()->created_at->format('Y-m-d');
            }
            if(count($expenses->get())) {
                $date_array[] = $expenses->get()->last()->created_at->format('Y-m-d');
            }
            $last_date = min($date_array);
        } else {
            $last_daily_report = $dailyreport->first();
            $last_report_date = date('Y-m-d', strtotime($last_daily_report->created_at. ' +1 day'));
            $today = date('Y-m-d');
            // dd($last_report_date);
            $sale_payments = (new SalePayment())->getSalePayment(null, ['start_date'=>$last_report_date, 'end_date'=>$today, 'get'=>'get']);
            $customer_payments = (new CustomerPayment())->getCustomerPayment(['start_date'=>$last_report_date, 'end_date'=>$today], 'get');
            $receiving_payments = (new ReceivingPayment())->getReceivingPayment(null, ['start_date'=>$last_report_date, 'end_date'=>$today, 'get'=>'get']);
            $supplier_payments = (new SupplierPayment())->getSupplierPayment(['start_date'=>$last_report_date, 'end_date'=>$today], 'get');
            $expenses = (new Expense())->getAll(null, ['start_date'=>$last_report_date, 'end_date'=>$today, 'get'=>'get']);
            if(count($sale_payments)) {
                $date_array[] = $sale_payments->last()->created_at->format('Y-m-d');
            }
            if(count($customer_payments)) {
                $date_array[] = $customer_payments->last()->created_at->format('Y-m-d');
            }
            if(count($receiving_payments)) {
                $date_array[] = $receiving_payments->last()->created_at->format('Y-m-d');
            }
            if(count($supplier_payments)) {
                $date_array[] = $supplier_payments->last()->created_at->format('Y-m-d');
            }
            if(count($expenses)) {
                $date_array[] = $expenses->last()->created_at->format('Y-m-d');
            }
            if(!empty($date_array)){
                $last_date = min($date_array);
            } else {
                $last_date = $date;
            }
        }
       return $last_date;
    }

    public function commonResponse($data=null, $notify=null, $option=null) {
        $response = $this->processNotification($notify);
        if($option == 'index') {
            $response['replaceWith']['#report_summary_table'] = view('report.report-summary.summary_table', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#daily_report_table'] = view('report.daily_report_table', $data)->render();
        }
        return $this->sendResponse($response);
    }
}
