<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ProductionOrder;
use App\Customer;

use App\Description;
use App\Location;
use App\OptionPrint;
use App\ScheduleStatus;
use App\JetStatus;

use App\MachineMaster;


use DB;

class StraightKnifeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = ProductionOrder::where('Location', '=', 'Straight Knife')->orderBy('FoldingOrder', 'asc')
        ->orderBy('FoldingOrder')
        ->get();

        $customers = Customer::select('id', 'name')->orderBy('name')->get()->toArray();

        $theads = ['PO #','Customer','Qty','Size 1','Size 2','Description','Printing','Location','Status','Stock Due','Date Due','Job Title','Ship VIA', 'Action'];        

        $tbody = [];

        foreach($results as $r) {

            $qtyNeed = $r->QtyNeeded;
            $oversAllow = $r->QtyNeeded * $r->OversAllow / 100;

            $val['r'] = $r;
            $val['customers'] = $customers;

            //$SoldTo = view('folding-schedules.mo-soldto', $val)->render();

            $DateDue = 'Not Specified';
            $StockDueIn = '';

            if ($r->StockDueIn != '0000-00-00') {

                list($year, $month, $day) = explode('-', $r->StockDueIn);

                $StockDueIn = sprintf("%s-%s-%s", $month, $day, $year);

            } 

            if ($r->DateDue != '0000-00-00') {

                list($year, $month, $day) = explode('-', $r->DateDue);

                $DateDue = sprintf("%s-%s-%s", $month, $day, $year);

            } 

            $hidden = sprintf("<input type='hidden' name='id' value='%s' />", $r->id);

            $location = sprintf("<input type='text' name='Location' value='%s' class='form-control' />", $r->Location);

            $printing = sprintf("<input type='text' name='Printing' value='%s' class='form-control' />", $r->Printing);

            $status = sprintf("<input type='text' name='FoldingScheduleStatus' value='%s' class='form-control' />", $r->FoldingScheduleStatus);

            $stock = sprintf("<input type='text' name='StockDueIn' value='%s' class='date form-control' />", $StockDueIn);

            $tbody[] = [
                    'JobId' => $r->id . $hidden,
                    'SoldTo' => $r->CustomerId > 0 ? $r->customer->name : 'Not Specified',
                    'Qty' => $r->QtyNeeded,
                    'Size1' => $r->SizeDimension1,
                    'Size2' => $r->SizeDimension2,
                    'Description' => $r->Description,
                    
                    'Printing' => $printing,
                    'Location' => $location,
                    'Status' => $status,
                    'StockDue' => $stock,
                    
                    'DateDue' => $DateDue,
                    'JobTitle' => $r->JobTitle,
                    'ShipVia' => $r->SHIPVIA == 1 ? 'Yes' : 'No',
                    'Action' => sprintf("<a href='#' data-id='%s' data-toggle='tooltip' title='Edit' class='btn btn-edit btn-success'><i class='fa fa-edit'></i></a>", $r->id)
                ];
        }

        $data['theads'] = $theads;
        $data['tbody'] = $tbody;
        $data['title'] = 'Straight Knife';
        $data['module'] = 'Straight Knife - Scheduled';

        return view('schedules.unscheduled', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function scheduled() {

        $results = ProductionOrder::where('Location','=','Straigh Knife')->where('FoldingScheduleStatus', '=', '')->get();

        $customers = Customer::select('id', 'name')->orderBy('name')->get()->toArray();

        $theads = ['PO #','Customer','Qty','Size 1','Size 2','Description','Due','Printing','Location','Status','Stock Due','Order','Date Due','Job Title','Ship VIA', 'Action'];        

        $tbody = [];

        $data['theads'] = $theads;
        $data['tbody'] = $tbody;
        $data['title'] = 'Straight Knife';
        $data['module'] = 'Straight Knife - Unscheduled';

        return view('schedules.unscheduled', $data);
    }

    public function unscheduled() {
        $results = ProductionOrder::select('production_orders.*', DB::raw('customers.name as SoldTo'))
                    ->leftJoin('customers', 'customers.id', '=', 'production_orders.CustomerId')
                    ->whereRaw('(Location = "9 Straight Knife" || Machine1 = "Straight Knife" || Machine2 = "Straight Knife" || Machine3 = "Straight Knife" || Machine4 = "Straight Knife" || Machine5 = "Straight Knife" || Machine6 = "Straight Knife")')
                    ->whereRaw('(StraightKnifeScheduleStatus IS NULL OR LENGTH(StraightKnifeScheduleStatus) = 0)')
                    ->orderBy('FoldingOrder')
                    ->get();

        $customers = Customer::select('id', 'name')->orderBy('name')->get()->toArray();

        $descriptions = Description::orderBy('description')->get()->toArray();
        $printings = OptionPrint::orderBy('print')->get()->toArray();
        $locations = Location::orderBy('location')->get()->toArray();
        $statusses = JetStatus::orderBy('status')->get()->toArray();
        
        $data['data'] = $results;
        $data['customers'] = $customers;
        $data['descriptions'] = $descriptions;
        $data['printings'] = $printings;
        $data['locations'] = $locations;
        $data['statusses'] = $statusses;
        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);

        
    }

    public function save(  Request $request ) {

        $id = $request->get('id');

        $order = ProductionOrder::find( $id );

        $order->CustomerId = $request->get('CustomerId');
        $order->QtyNeeded = $request->get('QtyNeeded');
        $order->SizeDimension1 = $request->get('SizeDimension1');
        $order->SizeDimension2 = $request->get('SizeDimension2');
        $order->Description = $request->get('Description');
        $order->FoldingDue = $request->get('FoldingDue');
        $order->Printing = $request->get('Printing');
        $order->Location = $request->get('Location');
        $order->StockDueIn = $request->get('StockDueIn');
        $order->FoldingOrder = $request->get('FoldingOrder');
        $order->DateDue = $request->get('DateDue');
        $order->StraightKnifeScheduleStatus = $request->get('StraightKnifeScheduleStatus');
        $order->SHIPVIA = $request->get('SHIPVIA');
        
        $order->save();

        return response()->json(['success' => 1], 200, [], JSON_NUMERIC_CHECK );

    }

    public function get() {

        $machine = MachineMaster::where('machine', '=', 'Straight Knife')->first();

        $results = ProductionOrder::select('production_orders.*', 'customers.name as SoldTo')
                        ->leftJoin('customers', 'customers.id', '=', 'production_orders.CustomerId')
                        ->whereRaw('(Location NOT IN ("Complete") AND (Machine1 = "Straight Knife" OR Machine2 = "Straight Knife" OR Machine3 = "Straight Knife" OR Machine4 = "Straight Knife" OR Machine5 = "Straight Knife" OR Machine6 = "Straight Knife"))');

        $results = $results->orderBy('StraightKnifeOrder')->get();

        $customers = Customer::select('id', 'name')->orderBy('name')->get()->toArray();
        $descriptions = Description::orderBy('description')->get()->toArray();
        $printings = OptionPrint::orderBy('print')->get()->toArray();
        $locations = Location::orderBy('location')->get()->toArray();
        $statusses = ScheduleStatus::orderBy('status')->get()->toArray();
        $jetStatuses = JetStatus::orderBy('status')->get()->toArray();

        $data['machine'] = $machine;
        $data['data'] = $results;
        $data['customers'] = $customers;
        $data['descriptions'] = $descriptions;
        $data['printings'] = $printings;
        $data['locations'] = $locations;
        $data['statusses'] = $statusses;
        $data['jetStatuses'] = $jetStatuses;

        return response()->json( $data, 200, [], JSON_NUMERIC_CHECK );

    }
}
