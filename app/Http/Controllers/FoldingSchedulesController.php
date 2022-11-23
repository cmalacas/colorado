<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ProductionOrder;
use App\Customer;

use App\Machine;
use App\MachineMaster;
use App\Description;
use App\Location;
use App\OptionPrint;
use App\ScheduleStatus;
use App\JetStatus;

use DB;

class FoldingSchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = ProductionOrder::where('Location','=', 'Folding')->orderBy('FoldingOrder', 'asc')
                        ->orderBy('id','desc')
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
        $data['title'] = 'Folding Schedule';
        $data['module'] = 'Folding Schedule';

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
        return view('folding-schedules.index');
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

    public function mo() {
        
        $results = ProductionOrder::whereNotIn('Location',['Complete'])->where('FoldingScheduleStatus', '=', 'MO')->orderBy('FoldingOrder', 'asc')->get();

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
        $data['title'] = 'Folding Schedule';
        $data['module'] = 'Folding Schedule - MO';

        return view('schedules.schedule', $data);
    }

    public function mow() {
        $results = ProductionOrder::whereNotIn('Location',['Complete'])->where('FoldingScheduleStatus', '=', 'MOW')->orderBy('FoldingOrder', 'asc')->get();

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
        $data['title'] = 'Folding Schedule';
        $data['module'] = 'Folding Schedule - MOW';

        return view('schedules.schedule', $data);
    }

    public function ra1() {
        $results = ProductionOrder::whereNotIn('Location',['Complete'])->where('FoldingScheduleStatus', '=', 'RA-1')->orderBy('FoldingOrder', 'asc')->get();

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
        $data['title'] = 'Folding Schedule';
        $data['module'] = 'Folding Schedule - RA-1';

        return view('schedules.schedule', $data);
    }

    public function ra2() {
        $results = ProductionOrder::whereNotIn('Location',['Complete'])->where('FoldingScheduleStatus', '=', 'RA-2')->orderBy('FoldingOrder', 'asc')->get();

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
        $data['title'] = 'Folding Schedule';
        $data['module'] = 'Folding Schedule - RA-2';

        return view('schedules.schedule', $data);
    }

    public function ra3() {
        $results = ProductionOrder::whereNotIn('Location',['Complete'])->where('FoldingScheduleStatus', '=', 'RA-3')->orderBy('FoldingOrder', 'asc')->get();

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
        $data['title'] = 'Folding Schedule';
        $data['module'] = 'Folding Schedule - RA-3';

        return view('schedules.schedule', $data);
    }

    public function ra4() {
        $results = ProductionOrder::whereNotIn('Location',['Complete'])->where('FoldingScheduleStatus', '=', 'RA-4')->orderBy('FoldingOrder', 'asc')->get();

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
        $data['title'] = 'Folding Schedule';
        $data['module'] = 'Folding Schedule - RA-4';

        return view('schedules.schedule', $data);
    }

    public function so() {
        $results = ProductionOrder::whereNotIn('Location',['Complete'])->where('FoldingScheduleStatus', '=', 'SO')->orderBy('FoldingOrder', 'asc')->get();

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
        $data['title'] = 'Folding Schedule';
        $data['module'] = 'Folding Schedule - SO';

        return view('schedules.schedule', $data);
        
    }

    public function wr1() {
        $results = ProductionOrder::whereNotIn('Location',['Complete'])->where('FoldingScheduleStatus', '=', 'WR-1')->orderBy('FoldingOrder', 'asc')->get();

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
        $data['title'] = 'Folding Schedule';
        $data['module'] = 'Folding Schedule - WR-1';

        return view('schedules.schedule', $data);
    }

    public function wr2() {
        $results = ProductionOrder::whereNotIn('Location',['Complete'])->where('FoldingScheduleStatus', '=', 'WR-2')->orderBy('FoldingOrder', 'asc')->get();

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
        $data['title'] = 'Folding Schedule';
        $data['module'] = 'Folding Schedule - WR-2';

        return view('schedules.schedule', $data);
    }

    public function wr3() {
        $results = ProductionOrder::whereNotIn('Location',['Complete'])->where('FoldingScheduleStatus', '=', 'WR-3')->orderBy('FoldingOrder', 'asc')->get();

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
        $data['title'] = 'Folding Schedule';
        $data['module'] = 'Folding Schedule - WR-3';

        return view('schedules.schedule', $data);
    }

    public function unscheduled() { 

        $results = ProductionOrder::select('production_orders.*', 'customers.name as SoldTo')
                        ->leftJoin('customers', 'customers.id', '=', 'production_orders.CustomerId')
                        ->whereRaw('(Machine1 IN ("Cutting", "Converting") OR Machine2 IN ("Cutting", "Converting") OR Machine3 IN ("Cutting", "Converting") OR Machine4 IN ("Cutting", "Converting") OR Machine5 IN ("Cutting", "Converting") OR Machine6 IN ("Cutting", "Converting"))')
                        ->whereRaw('((FoldingScheduleStatus IS NULL OR LENGTH(FoldingScheduleStatus) = 0 ) AND (Location NOT IN ("Complete")))')   
                        ->where('Invoiced','=',0)           
                        ->orderBy('id', 'desc')
                        ->get();

        $customers = Customer::select('id', 'name')->orderBy('name')->get()->toArray();
        $descriptions = Description::orderBy('description')->get()->toArray();
        $printings = OptionPrint::orderBy('print')->get()->toArray();
        $locations = Location::orderBy('location')->get()->toArray();
        $statusses = MachineMaster::where('status', '=', 1)->orderBy('sort_order')->get()->toArray();
        
        $data['data'] = $results;
        $data['customers'] = $customers;
        $data['descriptions'] = $descriptions;
        $data['printings'] = $printings;
        $data['locations'] = $locations;
        $data['statusses'] = $statusses;

        return response()->json( $data, 200, [], JSON_NUMERIC_CHECK );

        
    }

    public function doPrint( $id ) {

        $machine = MachineMaster::find( $id );

        $results = ProductionOrder::select('production_orders.*', 'customers.name as SoldTo')
                        ->leftJoin('customers', 'customers.id', '=', 'production_orders.CustomerId');

        switch ( $machine->machine ) {

            case 'Latex / PS':

                $results = $results->whereRaw('(Location = "8 Latex/PS" OR Machine1 = "Latex / PS" OR Machine2 = "Latex / PS" OR Machine3 = "Latex / PS" OR Machine4 = "Latex / PS" OR Machine5 = "Latex / PS" OR Machine6 = "Latex / PS")')
                                   ->orderBy('FoldingOrder');

            break;

            case 'RA-1':

                $results = $results->whereNotIn('Location', ['Complete', '6 Jet'])
                                ->whereRaw('FoldingScheduleStatus LIKE "%RA-1"')
                                ->orderBy('FoldingOrder');

            break;

            case 'RA-2':

                $results = $results->whereNotIn('Location', ['Complete', '6 Jet'])
                                ->whereRaw('FoldingScheduleStatus LIKE "%RA-2"')
                                ->orderBy('FoldingOrder');

            break;

            case 'RA-3':

                $results = $results->whereNotIn('Location', ['Complete', '6 Jet'])
                                ->whereRaw('FoldingScheduleStatus LIKE "%RA-3"')
                                ->orderBy('FoldingOrder');

            break;

            case 'RA-WEB':

                $results = $results->whereNotIn('Location', ['Complete', '6 Jet'])
                                ->whereRaw('FoldingScheduleStatus LIKE "%RA-WEB"')
                                ->orderBy('FoldingOrder'); 

            break;

            case 'RO-WEB':

                $results = $results->whereNotIn('Location', ['Complete', '6 Jet'])
                                ->whereRaw('FoldingScheduleStatus LIKE "%RO-WEB"')
                                ->orderBy('FoldingOrder'); 

            break;

            case 'WR-1':

                $results = $results->whereNotIn('Location', ['Complete', '6 Jet'])
                                ->whereRaw('FoldingScheduleStatus LIKE "%WR-1"')
                                ->orderBy('FoldingOrder'); 

            break;

            case 'WR-2':

                $results = $results->whereNotIn('Location', ['Complete', '6 Jet'])
                                ->whereRaw('FoldingScheduleStatus LIKE "%WR-2')
                                ->orderBy('FoldingOrder'); 

            break;

            case 'WR-3':

                $results = $results->whereNotIn('Location', ['Complete', '6 Jet'])
                                ->whereRaw('FoldingScheduleStatus LIKE "%WR-3"')
                                ->orderBy('FoldingOrder'); 

            break;

            case 'MO':

                $results = $results->whereNotIn('Location', ['Complete', '6 Jet'])
                                ->where('FoldingScheduleStatus', '=', '7. MO')
                                ->orderBy('FoldingOrder'); 

            break;

            case 'MOW':

                $results = $results->whereNotIn('Location', ['Complete', '6 Jet'])
                                ->whereRaw('FoldingScheduleStatus LIKE "%MOW"')
                                ->orderBy('FoldingOrder'); 

            break;

            case 'Jet 3 inch-1':

                $results = $results->whereNotIn('Location', ['Complete', '8 Latex/PS'])
                                ->where('JetScheduleStatus', '3 inch - 1')
                                ->orderBy('JetOrder'); 

            break;

            case 'Jet 3 inch-2':

                $results = $results->whereNotIn('Location', ['Complete'])
                                ->where('JetScheduleStatus', '3 inch - 2')
                                ->orderBy('JetOrder'); 

            break;

            case 'Jet 3 inch-3':

                $results = $results->whereNotIn('Location', ['Complete'])
                                ->where('JetScheduleStatus', '3 inch - 3')
                                ->orderBy('JetOrder'); 

            break;

            case 'Jet 3 inch-4':

                $results = $results->whereNotIn('Location', ['Complete'])
                                ->where('JetScheduleStatus', '3 inch - 4')
                                ->orderBy('JetOrder'); 

            break;

            case 'Super Jet 1':

                $results = $results->whereNotIn('Location', ['Complete'])
                                ->where('JetScheduleStatus', 'Super Jet 1')
                                ->orderBy('JetOrder'); 

            break;

            case 'Super Jet 2':

                $results = $results->whereNotIn('Location', ['Complete'])
                                ->where('JetScheduleStatus', 'Super Jet 2')
                                ->orderBy('JetOrder'); 

            break;

            case 'Straight Knife':

                $results = $results->whereNotIn('Location', ['Complete'])
                                    ->whereRaw('(Location = "9 Straight Knife" OR Machine1 = "Straight Knife" OR Machine2 = "Straight Knife" OR Machine3 = "Straight Knife" OR Machine4 = "Straight Knife" OR Machine5 = "Straight Knife" OR Machine6 = "Straight Knife")')
                                    ->orderBy('JetOrder'); 

            break;


        }

        $results = $results->get();

        $customers = Customer::select('id', 'name')->orderBy('name')->get()->toArray();
        $descriptions = Description::orderBy('description')->get()->toArray();
        $printings = OptionPrint::orderBy('print')->get()->toArray();
        $locations = Location::orderBy('location')->get()->toArray();
        $statusses = ScheduleStatus::orderBy('status')->get()->toArray();
        $jetStatuses = JetStatus::orderBy('status')->get()->toArray();

        $columns = [
                        'Job#',
                        'Customer',
                        'Qty',
                        'Sz1',
                        'x',
                        'Sz2',
                        'Description',
                    ];

        switch ( $machine->machine ) {

            case 'Latex / PS':
            case 'RA-1':
            case 'RA-2':
            case 'RA-3':
            case 'RA-WEB':
            case 'RO-WEB':
            case 'WR-1':
            case 'WR-2':
            case 'WR-3':
            case 'MO':
            case 'MOW':
            case 'Straight Knife':

                //$columns[] = 'Due';
                $columns[] = 'Prg';
                $columns[] = 'Location';
                //$columns[] = 'Status';
                $columns[] = 'Stk Due';
                $columns[] = 'Order';
                $columns[] = 'Date Due';
                $columns[] = 'Job Title';
                $columns[] = 'SHIPVIA';

            break;

            case 'Jet 3 inch-1':
            case 'Jet 3 inch-2':
            case 'Jet 3 inch-3':
            case 'Jet 3 inch-4':
            case 'Super Jet 1':
            case 'Super Jet 2':

                //$columns[] = 'JetDue';
                $columns[] = 'Prg';
                $columns[] = 'Location';
                $columns[] = 'Stk Due';
                $columns[] = 'JetOrder';
                //$columns[] = 'Jet Schedule Status';
                $columns[] = 'Job Title';
                $columns[] = 'SHIPVIA';

            break;

        }

        $data['machine'] = $machine;
        $data['data'] = $results;
        $data['customers'] = $customers;
        $data['descriptions'] = $descriptions;
        $data['printings'] = $printings;
        $data['locations'] = $locations;
        $data['statusses'] = $statusses;
        $data['jetStatuses'] = $jetStatuses;
        $data['columns'] = $columns;

        return view('folding-schedules.print', $data );

    }

    public function get( Request $request ) {

        $machine = MachineMaster::find( $request->get('id') );

        $results = ProductionOrder::select('production_orders.*', 'customers.name as SoldTo')
                        ->leftJoin('customers', 'customers.id', '=', 'production_orders.CustomerId');

        switch ( $machine->machine ) {

            case 'Latex / PS':

                $results = $results->whereRaw('(Location NOT IN  ("Complete") AND (Machine1 = "Latex / PS" OR Machine2 = "Latex / PS" OR Machine3 = "Latex / PS" OR Machine4 = "Latex / PS" OR Machine5 = "Latex / PS" OR Machine6 = "Latex / PS"))')
                                   ->orderBy('LatexPSFoldingOrder');

            break;

            case 'RA-1':

                $results = $results->whereNotIn('Location', ['Complete', '6 Jet'])
                                ->whereRaw('FoldingScheduleStatus LIKE "%RA-1%"')
                                ->orderBy('FoldingOrder');

            break;

            case 'RA-2':

                $results = $results->whereNotIn('Location', ['Complete', '6 Jet'])
                                ->whereRaw('FoldingScheduleStatus LIKE "%RA-2%"')
                                ->orderBy('FoldingOrder');

            break;

            case 'RA-3':

                $results = $results->whereNotIn('Location', ['Complete', '6 Jet'])
                                ->whereRaw('FoldingScheduleStatus LIKE "%RA-3%"')
                                ->orderBy('FoldingOrder');

            break;

            case 'RA-WEB':

                $results = $results->whereNotIn('Location', ['Complete', '6 Jet'])
                                ->whereRaw('FoldingScheduleStatus LIKE "%RA-WEB%"')
                                ->orderBy('FoldingOrder'); 

            break;

            case 'RO-WEB':

                $results = $results->whereNotIn('Location', ['Complete', '6 Jet'])
                                ->whereRaw('FoldingScheduleStatus LIKE "%RO-WEB%"')
                                ->orderBy('FoldingOrder'); 

            break;

            case 'WR-1':

                $results = $results->whereNotIn('Location', ['Complete', '6 Jet'])
                                ->whereRaw('FoldingScheduleStatus LIKE "%WR-1%"')
                                ->orderBy('FoldingOrder'); 

            break;

            case 'WR-2':

                $results = $results->whereNotIn('Location', ['Complete', '6 Jet'])
                                ->whereRaw('FoldingScheduleStatus LIKE "%WR-2%"')
                                ->orderBy('FoldingOrder'); 

            break;

            case 'WR-3':

                $results = $results->whereNotIn('Location', ['Complete', '6 Jet'])
                                ->whereRaw('FoldingScheduleStatus LIKE "%WR-3%"')
                                ->orderBy('FoldingOrder'); 

            break;

            case 'MO':

                $results = $results->whereNotIn('Location', ['Complete', '6 Jet'])
                                ->whereRaw('FoldingScheduleStatus LIKE "%MO"')
                                ->orderBy('FoldingOrder'); 

            break;

            case 'MOW':

                $results = $results->whereNotIn('Location', ['Complete', '6 Jet'])
                                ->whereRaw('FoldingScheduleStatus LIKE "%MOW%"')
                                ->orderBy('FoldingOrder'); 

            break;

            case 'Jet 3 inch-1':

                $results = $results->whereNotIn('Location', ['Complete', '8 Latex/PS'])
                                ->where('JetScheduleStatus', '01 3 inch - 1')
                                ->orderBy('JetOrder'); 

            break;

            case 'Jet 3 inch-2':

                $results = $results->whereNotIn('Location', ['Complete'])
                                ->where('JetScheduleStatus', '02 3 inch - 2')
                                ->orderBy('JetOrder'); 

            break;

            case 'Jet 3 inch-3':

                $results = $results->whereNotIn('Location', ['Complete'])
                                ->where('JetScheduleStatus', '03 3 inch - 3')
                                ->orderBy('JetOrder'); 

            break;

            case 'Jet 3 inch-4':

                $results = $results->whereNotIn('Location', ['Complete'])
                                ->where('JetScheduleStatus', '04 3 inch - 4')
                                ->orderBy('JetOrder'); 

            break;

            case 'Super Jet 1':

                $results = $results->whereNotIn('Location', ['Complete'])
                                ->where('JetScheduleStatus', 'Super Jet 1')
                                ->orderBy('JetOrder'); 

            break;

            case 'Super Jet 2':

                $results = $results->whereNotIn('Location', ['Complete'])
                                ->where('JetScheduleStatus', 'Super Jet 2')
                                ->orderBy('JetOrder'); 

            break;


        }

        $results = $results->get();

        $customers = Customer::select('id', 'name')->orderBy('name')->get()->toArray();
        $descriptions = Description::orderBy('description')->get()->toArray();
        $printings = OptionPrint::orderBy('print')->get()->toArray();
        $locations = Location::orderBy('location')->get()->toArray();
        $statusses = MachineMaster::orderBy('sort_order')->where('status', '=', 1)->get()->toArray();
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

        /* print_r( $machine->toArray() );

        $theads = ['PO #','Customer','Qty','Size 1','Size 2','Description','Printing','Location','Status','Stock Due','Date Due','Job Title','Ship VIA', 'Action'];        

        $results = ProductionOrder::where('Location','=', $machine->machine)
                    ->orderBy('id', 'desc')
                    ->get();

        $tbody = [];

        $customers = Customer::select('id', 'name')->orderBy('name')->get()->toArray();

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

        $machines = MachineMaster::orderBy('machine')->pluck('machine');


        $data['title'] = sprintf("Folding Schedule - %s", $machine->machine);
        $data['module'] = sprintf("Folding Schedule - %s", $machine->machine);
        $data['theads'] = $theads;
        $data['tbody'] = $tbody;
        $data['machines'] = $machines;

        return view('schedules.view', $data); */

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

        $order->Colors1 = $request->get('Colors1');
        $order->Colors2 = $request->get('Colors2');
        $order->Colors3 = $request->get('Colors3');

        $order->JetOrder = $request->get('JetOrder');
        $order->JetScheduleStatus = $request->get('JetScheduleStatus');
        $order->JetDue = $request->get('JetDue');

        $order->StraightKnifeOrder = $request->get('StraightKnifeOrder');
        $order->StraightKnifeScheduleStatus = $request->get('StraightKnifeScheduleStatus');

        if ($request->has('LatexPSFoldingOrder')) {

            $order->LatexPSFoldingOrder = $request->get('LatexPSFoldingOrder');

        }
        
        $order->save();

        return response()->json(['success' => 1], 200, [], JSON_NUMERIC_CHECK );

    }
}
