<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CommonTrait;
use App\Inventory;
use App\Item;
use App\PaymentType;
use App\Receiving;
use App\ReceivingItem;
use App\ReceivingPayment;
use App\ReceivingTemp;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use \Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ReceivingController extends Controller
{
    use CommonTrait;
    public function __construct(PaymentType $paymentType, Receiving $receiving, Supplier $supplier)
    {
        $this->middleware('auth');
        $this->paymentType = $paymentType;
        $this->receiving = $receiving;
        $this->supplier = $supplier;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // $data['payment_types'] = $this->paymentType->getAll('select');
        $filter = [];
        if($request->ajax()) {
            $search = [];
            if(!empty($request->filter)) {
                $search = $request->filter;
                Session::put('receiving_filter', $search);
            } else if( Session::get('receiving_filter')) {
                $search = Session::get('receiving_filter');
            }
            $data['receivings'] = $this->receiving->getReceivings($filter, 'paginate', $search);
            $data['receivingreport'] = $data['receivings'];
            $data['type'] = 'all';
            return $this->sendCommonResponse($data, null, 'index');
        } else {
            $data['receivings'] = $this->receiving->getReceivings($filter, 'paginate');
        }
        $data['suppliers'] = $this->supplier->getAll('select');
        return view('receiving.list', $data);
    }

    public function create()
    {
        $data['invoice'] = $this->getInvoiceNo(['name'=>'REC']);
        $data['suppliers'] = (new Supplier())->getAll('select', ['company_name', 'id']);
        $data['action'] = 'add';
        // $data['payment_types'] = (new PaymentType())->getAll('select');
        return view('receiving.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $sale = new Receiving();
        // if ($request->ajax()) {
        //     if ($request->action == 'hold-sale') {
        //         $validation = $this->validator($input)->validate();
        //         $input['user_id'] = Auth::user()->id;
        //         $saleItems = SaleTemp::all();
        //         $sale->processSale($input, $saleItems, $hold=true);
        //         $data['redirect'] = url('sales/create');
        //         session()->push('notify', ['options'=>['message'=>__('Sale Holded Successfully!')],
        //             'settings'=>['type'=>'success'] ]);
        //         return $this->sendCommonResponse($data, null, 'hold');
        //     } else {
        //         $this->validator($input)->validate();
        //         return $this->processSale($input, $sale);
        //     }
        // }
        $this->validator($input)->validate();
        return $this->processReceiving($input, $sale);

        // $this->validator($request->all())->validate();
        // $receivingItems = ReceivingTemp::all();
        // if (empty($receivingItems->toArray())) {
        //     Session::flash('message', __('Please Add some Items to create Receivings!'));
        //     Session::flash('alert-class', 'alert-danger');
        //     return back();
        // }
        // $receivings = new Receiving;
        // $receivings->supplier_id = Input::get('supplier_id');
        // $receivings->user_id = Auth::user()->id;
        // $receivings->payment_type = Input::get('payment_type');
        // $total = $receivings->total = Input::get('total');
        // $payment = $receivings->payment = Input::get('payment');
        // $dues = $receivings->dues = $total - $payment;
        // $receivings->comments = Input::get('comments');
        // if ($dues > 0) {
        //     $input['status'] = Receiving::DUE;
        // } else if($dues == 0) {
        //     $input['status'] = Receiving::PAID;
        // }
        // if ($hold) {
        //     $input['status'] = Receiving::HOLD;
        // }
        // if ($refund) {
        //     $input['status'] = Receiving::REFUND;
        // }
        // $receivings->save();
        // $supplier = Supplier::findOrFail($receivings->supplier_id);
        // $supplier->prev_balance = $supplier->prev_balance + $dues;
        // $supplier->update();
        // if (Input::get('payment') > 0) {
        //     $payment = new ReceivingPayment;
        //     $paid = $payment->payment = Input::get('payment');
        //     $payment->payment_type = Input::get('payment_type');
        //     $payment->dues = $total - $paid;
        //     $payment->receiving_id = $receivings->id;
        //     $payment->user_id = Auth::user()->id;
        //     $payment->save();
        // }
        // // process receiving items

        // $receivingItemsData=[];
        // foreach ($receivingItems as $value) {
        //     $receivingItemsData = new ReceivingItem;
        //     $receivingItemsData->receiving_id = $receivings->id;
        //     $receivingItemsData->item_id = $value->item_id;
        //     $receivingItemsData->cost_price = $value->cost_price;
        //     $receivingItemsData->quantity = $value->quantity;
        //     $receivingItemsData->total_cost = $value->total_cost;
        //     $receivingItemsData->save();
        //     //process inventory
        //     $items = Item::findOrFail($value->item_id);
        //     $inventories = new Inventory;
        //     $inventories->item_id = $value->item_id;
        //     $inventories->user_id = Auth::user()->id;
        //     $inventories->in_out_qty = $value->quantity;
        //     $inventories->remarks = 'RECV'.$receivings->id;
        //     $inventories->save();
        //     //process item quantity
        //     $items->quantity = $items->quantity + $value->quantity;
        //     $items->save();
        // }
        // //delete all data on ReceivingTemp model
        // ReceivingTemp::truncate();
        // $itemsreceiving = ReceivingItem::where('receiving_id', $receivingItemsData->receiving_id)->get();
        // Session::flash('message', __('You have successfully added receivings'));

        // return view('receiving.complete')
        //     ->with('receivings', $receivings)
        //     ->with('receivingItemsData', $receivingItemsData)
        //     ->with('receivingItems', $itemsreceiving);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $receiving = Receiving::findOrFail($id);
        $receiving->status = 0;
        $receiving->update();
        Session::flash('message', __('Sale Opened Successfully'));
        return redirect()->back();
    }

    
    public function showInvoice($id)
    {
        $receiving = (new Receiving())->getById($id);
        $itemsreceiving = (new ReceivingItem())->getAllByReceivingId($id);
        return view('receiving.complete')->with('receivings', $receiving)->with('receivingItems', $itemsreceiving);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $receiving = Receiving::findOrFail($id);
        $receiving->status = 1;
        $receiving->update();
        Session::flash('message', __('Sale Closed Successfully'));
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $items = Item::find($id);
        // process inventory
        $receivingTemps = new ReceivingTemp;
        $receivingTemps->item_id = $id;
        $receivingTemps->quantity = Input::get('quantity');
        $receivingTemps->save();
        Session::flash('message', __('You have successfully add item'));
        return Redirect::to('receivings');
    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'supplier_id'=>'required',
            'payment_type'=>'required',
            'total'=>'required',
            'payment'=>'required'
        ]);
    }

    private function processReceiving($input, $receivingObj, $refund = false)
    {
        $receivingItems = ReceivingTemp::all();
        if (empty($receivingItems->toArray())  && $refund == false) {
            return $this->sendCommonResponse([], ['danger'=>__('Please Add some Items to create sale!')]);
        }

        $input['user_id'] = Auth::user()->id;
        if ($refund) {
            $receiving = $receivingObj->processReceiving($input, $receivingItems, false, $refund=true);
            $data['redirect'] = url('receivings');
            return $this->sendCommonResponse($data, __('Sale refunded successfully!'));
        } else {
            $data['receivings'] = $receivingObj->processReceiving($input, $receivingItems);
            $data['receivingItems'] = ReceivingItem::where('receiving_id', $data['receivings']->id)->get();
            return $this->sendCommonResponse($data, __('You have successfully added receiving'), 'add');
        }
    }

    private function sendCommonResponse($data=[], $notify = '', $option = null)
    {
        $response = $this->processNotification($notify);
        if(!empty($data['redirect'])) {
            $response['redirect'] = $data['redirect'];
        }

        if ( $option == 'add' ) {
            $response['replaceWith']['#receivingContent'] = view('receiving.print_invoice', $data)->render();
        }
        if($option == 'index') {
            $response['replaceWith']['#receivingTable'] = view('supplier.partials.receiving_table', $data)->render();
        }
        return $this->sendResponse($response);
    }
}
