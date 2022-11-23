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

use DB;

class JetSchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = ProductionOrder::where('Location','=', 'Jet')->orderBy('FoldingOrder', 'asc')
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
        $data['title'] = 'Jet';
        $data['module'] = 'Jet - Scheduled';

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
        return view('jet-schedules.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('jet-schedules.index');
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
    public function inch31()
    {
        $results = ProductionOrder::whereNotIn('Location', ['Complete'])->orderBy('FoldingOrder', 'asc')
                        ->where('FoldingScheduleStatus', '=', '3 inch - 1')
                        ->get();

        $customers = Customer::select('id', 'name')->orderBy('name')->get()->toArray();

        $theads = ['PO #','Customer','Qty','Size 1','Size 2','Description','Due','Printing','Location','Status','Stock Due','Order','Date Due','Job Title','Ship VIA', 'Action'];        

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

            $order = sprintf("<input type='number' name='FoldingOrder' value='%s' class='form-control' />", $r->FoldingOrder);

            $tbody[] = [
                    'JobId' => $r->id . $hidden,
                    'SoldTo' => $r->CustomerId > 0 ? $r->customer->name : 'Not Specified',
                    'Qty' => $r->QtyNeeded,
                    'Size1' => $r->SizeDimension1,
                    'Size2' => $r->SizeDimension2,
                    'Description' => $r->Description,
                    'Due' => '',
                    'Printing' => $printing,
                    'Location' => $location,
                    'Status' => $status,
                    'StockDue' => $stock,
                    'Order' => $order,
                    'DateDue' => $DateDue,
                    'JobTitle' => $r->JobTitle,
                    'ShipVia' => $r->SHIPVIA == 1 ? 'Yes' : 'No',
                    'Action' => sprintf("<a href='#' data-id='%s' data-toggle='tooltip' title='Edit' class='btn btn-edit btn-success'><i class='fa fa-edit'></i></a>", $r->id)
                ];
        }

        $data['theads'] = $theads;
        $data['tbody'] = $tbody;
        $data['title'] = 'Jet Schedule';
        $data['module'] = 'Jet Schedule - 3 inch - 1';

        return view('schedules.schedule', $data);
    }

    public function inch32()
    {
        $results = ProductionOrder::whereNotIn('Location', ['Complete'])->orderBy('FoldingOrder', 'asc')
            ->where('FoldingScheduleStatus', '=', '3 inch - 2')
            ->get();

        $customers = Customer::select('id', 'name')->orderBy('name')->get()->toArray();

        $theads = ['PO #','Customer','Qty','Size 1','Size 2','Description','Due','Printing','Location','Status','Stock Due','Order','Date Due','Job Title','Ship VIA', 'Action'];        

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

            $order = sprintf("<input type='number' name='FoldingOrder' value='%s' class='form-control' />", $r->FoldingOrder);

            $tbody[] = [
                    'JobId' => $r->id . $hidden,
                    'SoldTo' => $r->CustomerId > 0 ? $r->customer->name : 'Not Specified',
                    'Qty' => $r->QtyNeeded,
                    'Size1' => $r->SizeDimension1,
                    'Size2' => $r->SizeDimension2,
                    'Description' => $r->Description,
                    'Due' => '',
                    'Printing' => $printing,
                    'Location' => $location,
                    'Status' => $status,
                    'StockDue' => $stock,
                    'Order' => $order,
                    'DateDue' => $DateDue,
                    'JobTitle' => $r->JobTitle,
                    'ShipVia' => $r->SHIPVIA == 1 ? 'Yes' : 'No',
                    'Action' => sprintf("<a href='#' data-id='%s' data-toggle='tooltip' title='Edit' class='btn btn-edit btn-success'><i class='fa fa-edit'></i></a>", $r->id)
                ];
        }

        $data['theads'] = $theads;
        $data['tbody'] = $tbody;
        $data['title'] = 'Jet Schedule';
        $data['module'] = 'Jet Schedule - 3 inch - 2';

        return view('schedules.schedule', $data);
    }

    public function inch33()
    {
        $results = ProductionOrder::whereNotIn('Location', ['Complete'])->orderBy('FoldingOrder', 'asc')
                        ->where('FoldingScheduleStatus', '=', '3 inch - 3')
                        ->get();

        $customers = Customer::select('id', 'name')->orderBy('name')->get()->toArray();

        $theads = ['PO #','Customer','Qty','Size 1','Size 2','Description','Due','Printing','Location','Status','Stock Due','Order','Date Due','Job Title','Ship VIA', 'Action'];        

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

            $order = sprintf("<input type='number' name='FoldingOrder' value='%s' class='form-control' />", $r->FoldingOrder);

            $tbody[] = [
                    'JobId' => $r->id . $hidden,
                    'SoldTo' => $r->CustomerId > 0 ? $r->customer->name : 'Not Specified',
                    'Qty' => $r->QtyNeeded,
                    'Size1' => $r->SizeDimension1,
                    'Size2' => $r->SizeDimension2,
                    'Description' => $r->Description,
                    'Due' => '',
                    'Printing' => $printing,
                    'Location' => $location,
                    'Status' => $status,
                    'StockDue' => $stock,
                    'Order' => $order,
                    'DateDue' => $DateDue,
                    'JobTitle' => $r->JobTitle,
                    'ShipVia' => $r->SHIPVIA == 1 ? 'Yes' : 'No',
                    'Action' => sprintf("<a href='#' data-id='%s' data-toggle='tooltip' title='Edit' class='btn btn-edit btn-success'><i class='fa fa-edit'></i></a>", $r->id)
                ];
        }

        $data['theads'] = $theads;
        $data['tbody'] = $tbody;
        $data['title'] = 'Jet Schedule';
        $data['module'] = 'Jet Schedule - 3 inch - 3';

        return view('schedules.schedule', $data);
    }

    public function inch34()
    {
        $results = ProductionOrder::whereNotIn('Location', ['Complete'])->orderBy('FoldingOrder', 'asc')
                        ->where('FoldingScheduleStatus', '=', '3 inch - 4')
                        ->get();

        $customers = Customer::select('id', 'name')->orderBy('name')->get()->toArray();

        $theads = ['PO #','Customer','Qty','Size 1','Size 2','Description','Due','Printing','Location','Status','Stock Due','Order','Date Due','Job Title','Ship VIA', 'Action'];        

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

            $order = sprintf("<input type='number' name='FoldingOrder' value='%s' class='form-control' />", $r->FoldingOrder);

            $tbody[] = [
                    'JobId' => $r->id . $hidden,
                    'SoldTo' => $r->CustomerId > 0 ? $r->customer->name : 'Not Specified',
                    'Qty' => $r->QtyNeeded,
                    'Size1' => $r->SizeDimension1,
                    'Size2' => $r->SizeDimension2,
                    'Description' => $r->Description,
                    'Due' => '',
                    'Printing' => $printing,
                    'Location' => $location,
                    'Status' => $status,
                    'StockDue' => $stock,
                    'Order' => $order,
                    'DateDue' => $DateDue,
                    'JobTitle' => $r->JobTitle,
                    'ShipVia' => $r->SHIPVIA == 1 ? 'Yes' : 'No',
                    'Action' => sprintf("<a href='#' data-id='%s' data-toggle='tooltip' title='Edit' class='btn btn-edit btn-success'><i class='fa fa-edit'></i></a>", $r->id)
                ];
        }

        $data['theads'] = $theads;
        $data['tbody'] = $tbody;
        $data['title'] = 'Jet Schedule';
        $data['module'] = 'Jet Schedule - 3 inch - 4';

        return view('schedules.schedule', $data);
    }

    public function superJet()
    {
        $results = ProductionOrder::whereNotIn('Location', ['Complete'])->orderBy('FoldingOrder', 'asc')
                        ->where('FoldingScheduleStatus', '=', 'SJ')
                        ->get();

        $customers = Customer::select('id', 'name')->orderBy('name')->get()->toArray();

        $theads = ['PO #','Customer','Qty','Size 1','Size 2','Description','Due','Printing','Location','Status','Stock Due','Order','Date Due','Job Title','Ship VIA', 'Action'];        

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

            $order = sprintf("<input type='number' name='FoldingOrder' value='%s' class='form-control' />", $r->FoldingOrder);

            $tbody[] = [
                    'JobId' => $r->id . $hidden,
                    'SoldTo' => $r->CustomerId > 0 ? $r->customer->name : 'Not Specified',
                    'Qty' => $r->QtyNeeded,
                    'Size1' => $r->SizeDimension1,
                    'Size2' => $r->SizeDimension2,
                    'Description' => $r->Description,
                    'Due' => '',
                    'Printing' => $printing,
                    'Location' => $location,
                    'Status' => $status,
                    'StockDue' => $stock,
                    'Order' => $order,
                    'DateDue' => $DateDue,
                    'JobTitle' => $r->JobTitle,
                    'ShipVia' => $r->SHIPVIA == 1 ? 'Yes' : 'No',
                    'Action' => sprintf("<a href='#' data-id='%s' data-toggle='tooltip' title='Edit' class='btn btn-edit btn-success'><i class='fa fa-edit'></i></a>", $r->id)
                ];
        }

        $data['theads'] = $theads;
        $data['tbody'] = $tbody;
        $data['title'] = 'Jet Schedule';
        $data['module'] = 'Jet Schedule - Super Jet';

        return view('schedules.schedule', $data);
    }

    public function unscheduled() {
        
        $results = ProductionOrder::select('production_orders.*', DB::raw('customers.name as SoldTo'))
                        ->leftJoin('customers', 'customers.id', '=', 'production_orders.CustomerId')
                        ->whereRaw('(Location = "6 Jet" || Machine1 = "Jet" || Machine2 = "Jet" || Machine3 = "Jet" || Machine4 = "Jet" || Machine5 = "Jet" || Machine6 = "Jet")')
                        ->whereRaw('(JetScheduleStatus IS NULL OR LENGTH(JetScheduleStatus) = 0)')
                        ->where('Invoiced', '=', 0)
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
        $order->FoldingScheduleStatus = $request->get('FoldingScheduleStatus');
        $order->JetScheduleStatus = $request->get('JetScheduleStatus');
        $order->JetDue = $request->get('JetDue');
        $order->JetOrder = $request->get('JetOrder');

        $order->save();

        return response()->json(['success' => 1], 200, [], JSON_NUMERIC_CHECK );

    }
}
