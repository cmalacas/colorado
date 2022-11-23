<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class Orders extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['theads'] = ['Colorado Env Prod Order #', 'Sold To', 'Job Title', 'Customer PO #'];

        $results = Order::where('Invoiced','=',0)->get();        

        $tbody = [];

        foreach($results as $result) {
            $tbody[] = [
                'ColoEnvPO' => $result['ColoEnvPO'],
                'SoldTo' => $result['SoldTo'],
                'JobTitle' => $result['JobTitle'],
                'CustPO' => $result['CustPO']
                ];
        }

        $data['tbody'] = $tbody;

        return view('not-invoiced.list', $data);
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
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function show(c $c)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function edit(c $c)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, c $c)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function destroy(c $c)
    {
        //
    }

    public function straightKnife() 
    {
        $breadcrumb = [];

        $breadcrumb[] = ['url' => '/', 'name' => 'Home'];
        $breadcrumb[] = ['url' => '/view-schedules', 'name' => 'View Schedules'];
        $breadcrumb[] = ['url' => '/view-schedules/straight-knife', 'name' => 'Straight Knife'];

        

        $results = Order::where('Location', '=', '9 Straight Knife')->get();        

        $tbody = [];

        foreach($results as $result) {
            $tbody[] = [
                'ColoEnvPO' => $result->ColoEnvPO,
                'SoldTo' => $result->SoldTo,
                'Qty' => $result->QtyNeeded,
                'Desc' => $result->Desc,
                'S1' => $result->SizeDimension1,
                'S2' => $result->SizeDimension2,
                'Print' => $result->Printing,
                'Location' => $result->Location,
                'StockDue' => $result->StockDueIn,
                'JobTitle' => $result->JobTitle
            ];
        }

        $data['tbody'] = $tbody;

        $data['theads'] = ['Job #', 'Customer', 'Qty', 'Description', 'Sz 1', 'Sz 2', 'Print', 'Location', 'Stock Due', 'Job Title'];
        $data['breadcrumbs'] = $breadcrumb;
        $data['title'] = 'View Schedules - Straight Knife';

        return view('view-schedules.show')->with($data);
    }

    public function jet3in1() 
    {
        $breadcrumb = [];

        $breadcrumb[] = ['url' => '/', 'name' => 'Home'];
        $breadcrumb[] = ['url' => '/view-schedules', 'name' => 'View Schedules'];
        $breadcrumb[] = ['url' => '/view-schedules/straight-knife', 'name' => 'Straight Knife'];

        

        $results = Order::where('JetScheduleStatus', '=', '01 3 Inch - 1')
                    ->where('Location', '!=', 'complete')
                    ->where('Location', '!=', '8 Latex/PS')
                    ->OrderBy('JetOrder')->get();        

        $tbody = [];

        foreach($results as $result) {
            $tbody[] = [
                'ColoEnvPO' => $result->ColoEnvPO,
                'SoldTo' => $result->SoldTo,
                'Qty' => $result->QtyNeeded,
                'Desc' => $result->Desc,
                'S1' => $result->SizeDimension1,
                'S2' => $result->SizeDimension2,
                'StockDue' => $result->StockDueIn,
                'Print' => $result->Printing,
                'Location' => $result->Location,                
                'JobTitle' => $result->JobTitle,
                'DateDue' => $result->DateDue
            ];
        }

        $data['tbody'] = $tbody;

        $data['theads'] = ['Job #', 'Customer', 'Qty', 'Description', 'Sz 1', 'Sz 2', 'Stock Due', 'Print', 'Location', 'Job Title', 'Date Due'];
        $data['breadcrumbs'] = $breadcrumb;
        $data['title'] = 'View Schedules - Jet 3 Inch - 1';

        return view('view-schedules.show')->with($data);
    }

    public function jet3in2() 
    {
        $breadcrumb = [];

        $breadcrumb[] = ['url' => '/', 'name' => 'Home'];
        $breadcrumb[] = ['url' => '/view-schedules', 'name' => 'View Schedules'];
        $breadcrumb[] = ['url' => '/view-schedules/straight-knife', 'name' => 'Straight Knife'];

        

        $results = Order::where('Location', '=', '9 Straight Knife')->get();        

        $tbody = [];

        foreach($results as $result) {
            $tbody[] = [
                'ColoEnvPO' => $result->ColoEnvPO,
                'SoldTo' => $result->SoldTo,
                'Qty' => $result->QtyNeeded,
                'Desc' => $result->Desc,
                'S1' => $result->SizeDimension1,
                'S2' => $result->SizeDimension2,
                'Print' => $result->Printing,
                'Location' => $result->Location,
                'StockDue' => $result->StockDueIn,
                'JobTitle' => $result->JobTitle
            ];
        }

        $data['tbody'] = $tbody;

        $data['theads'] = ['Job #', 'Customer', 'Qty', 'Description', 'Sz 1', 'Sz 2', 'Print', 'Location', 'Stock Due', 'Job Title'];
        $data['breadcrumbs'] = $breadcrumb;
        $data['title'] = 'View Schedules - Jet 3 Inch - 2';

        return view('view-schedules.show')->with($data);
    }

    public function jet3in3() 
    {
        $breadcrumb = [];

        $breadcrumb[] = ['url' => '/', 'name' => 'Home'];
        $breadcrumb[] = ['url' => '/view-schedules', 'name' => 'View Schedules'];
        $breadcrumb[] = ['url' => '/view-schedules/straight-knife', 'name' => 'Straight Knife'];

        

        $results = Order::where('Location', '=', 'Jet 3 inch - 3')->get();        

        $tbody = [];

        foreach($results as $result) {
            $tbody[] = [
                'ColoEnvPO' => $result->ColoEnvPO,
                'SoldTo' => $result->SoldTo,
                'Qty' => $result->QtyNeeded,
                'Desc' => $result->Desc,
                'S1' => $result->SizeDimension1,
                'S2' => $result->SizeDimension2,
                'Print' => $result->Printing,
                'Location' => $result->Location,
                'StockDue' => $result->StockDueIn,
                'JobTitle' => $result->JobTitle
            ];
        }

        $data['tbody'] = $tbody;

        $data['theads'] = ['Job #', 'Customer', 'Qty', 'Description', 'Sz 1', 'Sz 2', 'Stock Due', 'Print', 'Location',  'Job Title', 'Date Due'];
        $data['breadcrumbs'] = $breadcrumb;
        $data['title'] = 'View Schedules - Jet 3 Inch - 3';

        return view('view-schedules.show')->with($data);
    }

    public function jet3in4() 
    {
        $breadcrumb = [];

        $breadcrumb[] = ['url' => '/', 'name' => 'Home'];
        $breadcrumb[] = ['url' => '/view-schedules', 'name' => 'View Schedules'];
        $breadcrumb[] = ['url' => '/view-schedules/straight-knife', 'name' => 'Straight Knife'];

        

        $results = Order::where('Location', '=', '9 Straight Knife')->get();        

        $tbody = [];

        foreach($results as $result) {
            $tbody[] = [
                'ColoEnvPO' => $result->ColoEnvPO,
                'SoldTo' => $result->SoldTo,
                'Qty' => $result->QtyNeeded,
                'Desc' => $result->Desc,
                'S1' => $result->SizeDimension1,
                'S2' => $result->SizeDimension2,
                'Print' => $result->Printing,
                'Location' => $result->Location,
                'StockDue' => $result->StockDueIn,
                'JobTitle' => $result->JobTitle
            ];
        }

        $data['tbody'] = $tbody;

        $data['theads'] = ['Job #', 'Customer', 'Qty', 'Description', 'Sz 1', 'Sz 2', 'Stock Due', 'Print', 'Location',  'Job Title', 'Date Due'];
        $data['breadcrumbs'] = $breadcrumb;
        $data['title'] = 'View Schedules - 3 Inch - 4';

        return view('view-schedules.show')->with($data);
    }

    public function jetSuper() 
    {
        $breadcrumb = [];

        $breadcrumb[] = ['url' => '/', 'name' => 'Home'];
        $breadcrumb[] = ['url' => '/view-schedules', 'name' => 'View Schedules'];
        $breadcrumb[] = ['url' => '/view-schedules/straight-knife', 'name' => 'Straight Knife'];

        

        $results = Order::where('Location', '!=', 'complete')
                ->where('JetScheduleStatus', '=', '05  SJ')
                ->OrderBy('JetOrder')
                ->get();        

        $tbody = [];

        foreach($results as $result) {
            $tbody[] = [
                'ColoEnvPO' => $result->ColoEnvPO,
                'SoldTo' => $result->SoldTo,
                'Qty' => $result->QtyNeeded,
                'Desc' => $result->Desc,
                'S1' => $result->SizeDimension1,
                'S2' => $result->SizeDimension2,
                'Location' => $result->Location,                
                'StockDue' => $result->StockDueIn,
                'JetStock' => $result->JetStock,
                'JobTitle' => $result->JobTitle,
                'DateDue' => $result->DateDue
            ];
        }

        $data['tbody'] = $tbody;

        $data['theads'] = ['Job #', 'Customer', 'Qty', 'Description', 'Sz 1', 'Sz 2', 'Location', 'Stock Due', 'JetStock', 'Job Title', 'Date Due'];
        $data['breadcrumbs'] = $breadcrumb;
        $data['title'] = 'View Schedules - Super Jet';

        return view('view-schedules.show')->with($data);
    }

    public function ra($n)
    {
        $breadcrumb = [];

        $breadcrumb[] = ['url' => '/', 'name' => 'Home'];
        $breadcrumb[] = ['url' => '/view-schedules', 'name' => 'View Schedules'];
        $breadcrumb[] = ['url' => '/view-schedules/folding', 'name' => 'Folding'];
        $breadcrumb[] = ['url' => '/view-schedules/folding/ra', 'name' => 'RA'];
        $breadcrumb[] = ['url' => '/view-schedules/folding/ra/' . $n, 'name' => 'RA - ' . $n];
        
        switch ($n)
        {
            case 1:
                $results = Order::where('Location', '!=', 'complete')
                        ->where('Location', '!=', 'complete')
                        ->where('Location', '!=', '6 Jet')
                        ->where('FoldingScheduleStatus', '=', '01  RA-1')
                        ->OrderBy('FoldingOrder')
                        ->get();        

            break;

            case 2:

                $results = Order::where('Location', '!=', 'complete')
                        ->where('Location', '!=', 'complete')
                        ->where('Location', '!=', '6 Jet')
                        ->where('FoldingScheduleStatus', '=', '02  RA-2')
                        ->OrderBy('FoldingOrder')
                        ->get();        

            break;

            case 3: 

                $results = Order::where('Location', '!=', 'complete')
                        ->where('Location', '!=', 'complete')
                        ->where('Location', '!=', '6 Jet')
                        ->where('FoldingScheduleStatus', '=', '03  RA-3')
                        ->OrderBy('FoldingOrder')
                        ->get();        

            break;
        }

        $tbody = [];

        foreach($results as $result) {
            $tbody[] = [
                'ColoEnvPO' => $result->ColoEnvPO,
                'SoldTo' => $result->SoldTo,
                'Qty' => $result->QtyNeeded,
                'Desc' => $result->Desc,
                'S1' => $result->SizeDimension1,
                'S2' => $result->SizeDimension2,
                'Print' => $result->Print,
                'Location' => $result->Location,                
                'StockDue' => $result->StockDueIn,
                'JobTitle' => $result->JobTitle,
                'DateDue' => $result->DateDue
            ];
        }

        $data['tbody'] = $tbody;

        $data['theads'] = ['Job #', 'Customer', 'Qty', 'Description', 'Sz 1', 'Sz 2', 'Print', 'Location', 'Stock Due', 'Job Title', 'Date Due'];
        $data['breadcrumbs'] = $breadcrumb;
        $data['title'] = 'View Schedules - Folding RA - ' . $n;

        return view('view-schedules.show')->with($data);
    }

    public function wr($n)
    {
        $breadcrumb = [];

        $breadcrumb[] = ['url' => '/', 'name' => 'Home'];
        $breadcrumb[] = ['url' => '/view-schedules', 'name' => 'View Schedules'];
        $breadcrumb[] = ['url' => '/view-schedules/folding', 'name' => 'Folding'];
        $breadcrumb[] = ['url' => '/view-schedules/folding/wr', 'name' => 'WR'];
        $breadcrumb[] = ['url' => '/view-schedules/folding/wr/' . $n, 'name' => 'WR - ' . $n];
        
        switch ($n)
        {
            case 1:
                $results = Order::where('Location', '!=', 'complete')
                        ->where('Location', '!=', 'complete')
                        ->where('Location', '!=', '6 Jet')
                        ->where('FoldingScheduleStatus', '=', '04  WR-1')
                        ->OrderBy('FoldingOrder')
                        ->get();        

            break;

            case 2:

                $results = Order::where('Location', '!=', 'complete')
                        ->where('Location', '!=', 'complete')
                        ->where('Location', '!=', '6 Jet')
                        ->where('FoldingScheduleStatus', '=', '05  WR-2')
                        ->OrderBy('FoldingOrder')
                        ->get();        

            break;

            case 3: 

                $results = Order::where('Location', '!=', 'complete')
                        ->where('Location', '!=', 'complete')
                        ->where('Location', '!=', '6 Jet')
                        ->where('FoldingScheduleStatus', '=', '06  WR-3')
                        ->OrderBy('FoldingOrder')
                        ->get();        

            break;
        }

        $tbody = [];

        foreach($results as $result) {
            $tbody[] = [
                'ColoEnvPO' => $result->ColoEnvPO,
                'SoldTo' => $result->SoldTo,
                'Qty' => $result->QtyNeeded,
                'Desc' => $result->Desc,
                'S1' => $result->SizeDimension1,
                'S2' => $result->SizeDimension2,
                'Print' => $result->Print,
                'Location' => $result->Location,                
                'StockDue' => $result->StockDueIn,
                'JobTitle' => $result->JobTitle,
                'DateDue' => $result->DateDue
            ];
        }

        $data['tbody'] = $tbody;

        $data['theads'] = ['Job #', 'Customer', 'Qty', 'Description', 'Sz 1', 'Sz 2', 'Print', 'Location', 'Stock Due', 'Job Title', 'Date Due'];
        $data['breadcrumbs'] = $breadcrumb;
        $data['title'] = 'View Schedules - Folding WR - ' . $n;

        return view('view-schedules.show')->with($data);
    }

    public function more($n)
    {
        $breadcrumb = [];

        $breadcrumb[] = ['url' => '/', 'name' => 'Home'];
        $breadcrumb[] = ['url' => '/view-schedules', 'name' => 'View Schedules'];
        $breadcrumb[] = ['url' => '/view-schedules/folding', 'name' => 'Folding'];
        $breadcrumb[] = ['url' => '/view-schedules/folding/more', 'name' => 'MOW, MO, SO, Latex/PS'];
        
        
        switch ($n)
        {
            case 'mow':

                $breadcrumb[] = ['url' => '/view-schedules/folding/more/mow', 'name' => 'MOW'];

                $data['title'] = 'View Schedules - Folding MOW';

                $results = Order::where('Location', '!=', 'complete')
                        ->where('Location', '!=', 'complete')
                        ->where('Location', '!=', '6 Jet')
                        ->where('FoldingScheduleStatus', '=', '07  MOW')
                        ->OrderBy('FoldingOrder')
                        ->get();        

            break;

            case 'mo':

                $data['title'] = 'View Schedules - Folding MO';

                $breadcrumb[] = ['url' => '/view-schedules/folding/more/mo', 'name' => 'MO'];

                $results = Order::where('Location', '!=', 'complete')
                        ->where('Location', '!=', 'complete')
                        ->where('Location', '!=', '6 Jet')
                        ->where('FoldingScheduleStatus', '=', '08  MO')
                        ->OrderBy('FoldingOrder')
                        ->get();        

            break;

            case 'so': 

                $data['title'] = 'View Schedules - Folding SO';

                $breadcrumb[] = ['url' => '/view-schedules/folding/more/so', 'name' => 'SO'];

                $results = Order::where('Location', '!=', 'complete')
                        ->where('Location', '!=', 'complete')
                        ->where('Location', '!=', '6 Jet')
                        ->where('FoldingScheduleStatus', '=', '09  SO')
                        ->OrderBy('FoldingOrder')
                        ->get();        

            break;

            case 'latex-ps': 

                $data['title'] = 'View Schedules - Folding Latex/PS';

                $breadcrumb[] = ['url' => '/view-schedules/folding/more/latex-ps', 'name' => 'Latex/PS'];

                $results = Order::where('Location', '!=', 'complete')
                        ->where('Location', '!=', 'complete')
                        ->where('Location', '!=', '6 Jet')
                        ->where('FoldingScheduleStatus', '=', '8 Latex/PS')
                        ->OrderBy('FoldingOrder')
                        ->get();        

            break;
        }

        $tbody = [];

        foreach($results as $result) {
            $tbody[] = [
                'ColoEnvPO' => $result->ColoEnvPO,
                'SoldTo' => $result->SoldTo,
                'Qty' => $result->QtyNeeded,
                'Desc' => $result->Desc,
                'S1' => $result->SizeDimension1,
                'S2' => $result->SizeDimension2,
                'Print' => $result->Print,
                'Location' => $result->Location,                
                'StockDue' => $result->StockDueIn,
                'JobTitle' => $result->JobTitle,
                'DateDue' => $result->DateDue
            ];
        }

        $data['tbody'] = $tbody;

        $data['theads'] = ['Job #', 'Customer', 'Qty', 'Description', 'Sz 1', 'Sz 2', 'Print', 'Location', 'Stock Due', 'Job Title', 'Date Due'];
        $data['breadcrumbs'] = $breadcrumb;
        

        return view('view-schedules.show')->with($data);
    }
}
