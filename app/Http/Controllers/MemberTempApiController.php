<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\MemberRequest;
use App\Item;
use App\MemberTemp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use \Auth, \Redirect, \Validator, \Session;

class MemberTempApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        return Response::json(MemberTemp::with('item')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('sale.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $MemberTemps = new MemberTemp;
        $MemberTemps->item_id = $request->item_id;
        $MemberTemps->cost_price = $request->cost_price;
        $MemberTemps->selling_price = $request->selling_price;
        $MemberTemps->quantity = 1;
        $MemberTemps->total_cost = $request->cost_price;
        $MemberTemps->total_selling = $request->selling_price;
        $MemberTemps->save();
        return $MemberTemps;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $MemberTemps = MemberTemp::find($id);
        $MemberTemps->quantity = request()->quantity;
        $MemberTemps->total_cost = request()->total_cost;
        $MemberTemps->total_selling = request()->total_selling;
        $MemberTemps->save();
        return $MemberTemps;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        MemberTemp::destroy($id);
    }
}
