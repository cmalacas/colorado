<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

use App\ProductionOrder;
use App\Customer;
use App\Contact;
use App\UnitFigure;
use App\Machine;
use App\MachineMaster;
use App\Location;
use App\Description;
use App\WindowSize;
use App\OpenPoly;
use App\SealFlap;
use App\Gum;
use App\WindowDie;
use App\DiagonalSeam;
use App\OpenEnd;
use App\SideSeam;
use App\ColoStock;
use App\OpenSide;
use App\OptionPrint;
use App\InsideTintStyle;
use App\DiesDiagonal;
use App\DiesSeam;
use App\DiesMo;
use App\DoubleDie;
use App\PanelDie;
use App\PackingSlipSub;
use App\User;
use App\ProductionOrdersSearch;

use App\OutDiagonal;
use App\OutMoBooklet;
use App\OutMoCatalog;
use App\OutSideSeam;
use App\Adjustable;
use App\WebRa;

use App\BoxSize;
use App\CtnSize;
use App\WindowFilm;

use App\Document;
use App\ShipTo;

use DB;

use Carbon\Carbon;

use App\Mail\SendMailable;
use Illuminate\Support\Facades\Mail;

class ProductionOrders extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(auth()->id());

        $data['theads'] = ['Order No', 'Sold To', 'Contact', 'Order Date', 'PO #','Due Date', 'Quantity','Location', 'Action'];

        $search = ProductionOrdersSearch::where('user_id', '=', $user->id)->first();

        //print_r( $search->toArray());
        //DB::enableQueryLog();

        if ($search && $search->count() > 0) {

            $results = ProductionOrder::select(DB::raw('production_orders.*'))->leftJoin('customers', 'customers.id', '=', 'CustomerId');

            $lookin = $search->lookin;
            $match = $search->match;
            $keywords = $search->search;

            if (in_array($lookin, ['OrderDate', 'StockDueIn', 'DateDue']) ) {

                $lookin = 'DATE_FORMAT('.$lookin.', "%m-%d-%Y")';

            }

            if ( $lookin == 'SoldTo' ) {

                $lookin = 'customers.name';

            }

            if ($match == 'whole') {

                $results = $results->where($lookin, '=', $keywords);

            } else if ($match == 'any') {

                $results = $results->whereRaw("UPPER(". $lookin . ") LIKE '%".strtoupper($keywords)."%'");               
                
            } else {

                $results = $results->whereRaw('UPPER(?) LIKE ?', [$lookin, strtoupper($keywords) . '%']);

            }

        } else {

            $results = ProductionOrder::whereRaw('Location is NULL OR Location NOT IN ("Complete")');

        } 

        $results = $results->get();

        //print_r( $results->toArray() );

        //var_dump(DB::getQueryLog());

        //DB::disableQueryLog();

       
        $tbody = [];       

        foreach($results as $result) {

            list($year, $month, $day) = explode('-', $result->OrderDate);

            $edit = sprintf("<a data-toggle='tooltip' title='Edit' data-action='edit' href='/production-orders/%s/edit' class='btn btn-primary' title='Edit'><i class='fa fa-edit'></i></a>", $result->id);
            $print = sprintf("<a data-toggle='tooltip' title='Print' href='/production-orders/%s/print' class='btn btn-info' target='_blank' data-action='print' title='Print'><i class='fa fa-print'></i></a>", $result->id);
            $delete = sprintf("<a data-toggle='tooltip' title='Delete'  href='/product-orders/%s/delete' class='btn btn-danger' data-action='delete' title='Delete' data-id='%s'><i class='fa fa-trash'></i></a>", $result->id, $result->id);
            $copy = sprintf("<a data-toggle='tooltip' title='Duplicate' href='/production-orders/%s/copy' class='btn btn-success' data-action='success' title='Duplicate' data-id='%s'><i class='fa fa-copy'></i></a>", $result->id, $result->id);

            $tbody[] = [
                'id' => sprintf("<a href='/production-orders/%s/edit'>%s</a>", $result->id, $result->id),
                
                'SoldTo' => $result->customer ? $result->customer->name : '',
                
                'ContactName' => $result->ContactName,

                'OrderDate' => Carbon::parse($result->OrderDate)->format("m-d-Y"),
                
                'CustPO' => $result->CustPO,

                'DateDue' => Carbon::parse($result->DateDue)->format("m-d-Y"),

                'Quantity' => $result->QtyNeeded,

                'Location' => $result->Location,

                'Action' => sprintf("%s %s %s %s", $copy, $edit, $print, $delete),
                
                'JobTitle' => $result->JobTitle,
                
                'Phone' => $result->Phone,
                
                'Email' => $result->Email,
                'PreviousOrder' => $result->PreviousOrder,
                'QuotedPrice' => $result->QuotedPrice,
                'AdditionalChg' => $result->AdditionalChg,
                'StockDueIn' => $result->StockDueIn,
                
                'PhoneExt' => $result->PhoneExt,
                'Mobile' => $result->Mobile,                
                'Fax' => $result->Fax,
                'Machine1' => $result->Machine1,

                'Machine2' => $result->Machine2,
                'Machine3' => $result->Machine3,
                'Machine4' => $result->Machine4,
                'Machine5' => $result->Machine5,
                'Machine6' => $result->Machine6,    
                'QtyNeeded' => $result->QtyNeeded,
                'OversAllow' => $result->OversAllow,
                'Total' => $result->Total,
                'SizeDimension1' => $result->SizeDimension1,
                'SizeDimension2' => $result->SizeDimension2,

                'Desc' => $result->Desc,
                'WindowDoubleDie' => $result->WindowDoubleDie,
                'SealFlapSz' => $result->SealFlapSz,
                'WindowSz1' => $result->WindowSz1,
                'WindowSz2' => $result->WindowSz2,
                'WindowSz3' => $result->WindowSz3,
                'WindowPos1' => $result->WindowPos1,            
                'WindowPos2' => $result->WindowPos2,                            
                'WindowPos3' => $result->WindowPos3,
                'SealFlap' => $result->SealFlap,

                'GumType' => $result->GumType,
                'AmountForJets' => $result->AmountForJets,
                'ofCopies' => $result->ofCopies,
                'SpecialConvInst' => $result->SpecialConvInst,
                'OutDiagonal' => $result->OutDiagonal,
                'OutSide' => $result->Outside,
                'OutCatalogEnd' => $result->OutCatalogEnd,                
                'OutCatalogSide' => $result->OutCatalogSide,
                'ColoEnvStock' => $result->ColoEnvStock,
                'CustomerSupp' => $result->CustomerSupp,

                'SpecialCuttingInst' => $result->SpecialCuttingInst,
                'Printing' => $result->Printing,
                'InsideTintStyle' => $result->InsideTintStyle,
                'Sides' => $result->Sides,
                'Colors1' => $result->Colors1,
                'Colors2' => $result->Colors2,                
                'Colors3' => $result->Colors3,                
                'Colors4' => $result->Colors4,
                'CustomerSup' => $result->CustomerSup,
                'SpecialPrintInst' => $result->SpecialPrintInst,

                'BulkAmtPerCtn' => $result->BulkAmtPerCtn,
                'BulkAmtPerBox' => $result->BulkAmtPerBox,
                'BulkBoxSz' => $result->BulkBoxSz,
                'FoldingAmtPerBox' => $result->FoldingAmtPerBox,
                'FoldingBoxSz' => $result->FoldingBoxSz,                
                'FoldingCtnSize' => $result->FoldingCtnSize,
                'Labeling' => $result->Labeling,
                'MarkAs' => $result->MarkAs,
                'ShipViaDetail' => $result->ShipViaDetail,
                'Account' => $result->Account,

                'ShipTo' => $result->ShipTo,
                'Address1' => $result->Address1,
                'Address2' => $result->Address2,
                'City' => $result->City,                
                'ST' => $result->ST,
                'Zip' => $result->Zip,
                'ShipAttn' => $result->ShipAttn,
                'ShipContactPhone' => $result->ShipContactPhone,
                'SHIPPINGINSTRUCTIONS' => $result->SHIPPINGINSTRUCTIONS, 

                
                'out_diagonal_die_size' => $result->out_diagonal_die_size,
                'out_diagonal_sheet_size' => $result->out_diagonal_sheet_size,
                'out_diagonal_number_out' => $result->out_diagonal_number_out,
                'out_diagonal_die_number' => $result->out_diagonal_die_number,
                'out_diagonal_seal_flap_size' => $result->out_diagonal_seal_flap_size,
                
                'out_mo_booklet_die_size' => $result->out_mo_booklet_die_size,	
	            'out_mo_booklet_sheet_size' => $result->out_mo_booklet_sheet_size,
	            'out_mo_booklet_number_out' => $result->out_mo_booklet_number_out,
	            'out_mo_booklet_die_number' => $result->out_mo_booklet_die_number,
	            'out_mo_booklet_flat_size' => $result->out_mo_booklet_flat_size,
	            'out_mo_booklet_seal_flap_size' => $result->out_mo_booklet_seal_flap_size,
	            
                'out_mo_catalog_die_size' => $result->out_mo_catalog_die_size,
	            'out_mo_catalog_sheet_size' => $result->out_mo_catalog_sheet_size,
	            'out_mo_catalog_number_out' => $result->out_mo_catalog_number_out,
	            'out_mo_catalog_die_number' => $result->out_mo_catalog_die_number,
	            'out_mo_catalog_flat_size' => $result->out_mo_catalog_flat_size,
	            'out_mo_catalog_seal_flap_size' => $result->out_mo_catalog_seal_flap_size,
	            
                'out_side_seam_die_size' => $result->out_side_seam_die_size,
	            'out_side_seam_sheet_size' => $result->out_side_seam_sheet_size,
	            'out_side_seam_number_out' => $result->out_side_seam_number_out,
	            'out_side_seam_die_number' => $result->out_side_seam_die_number,
	            'out_side_seam_flat_size' => $result->out_side_seam_flat_size,
	        	'out_side_seam_seal_flap_size' => $result->out_side_seam_flap_size,

                'adjustable_die_size' => $result->adjustable_die_size,
	        	'adjustable_sheet_size' => $result->adjustable_sheet_size,
	        	'adjustable_number_out' => $result->adjustable_number_out,
	        	'adjustable_die_number' => $result->adjustable_die_number,
	        	'adjustable_flat_size' => $result->adjustable_flat_size,
	        	'adjustable_seal_flap_size' => $result->adjustable_seal_flap_size,
	        	
                'web_ro_die_size' => $result->web_ro_die_size,
	        	'web_ro_sheet_size' => $result->web_ro_sheet_size,
	        	'web_ro_number_out' => $result->web_ro_number_out,
	        	'web_ro_die_number' => $result->web_ro_die_number,
	        	'web_ro_flat_size' => $result->web_ro_flat_size,
	        	'web_ro_seal_flap_size' => $result->web_ro_seal_flap_size

            ];
        }

        //echo count($tbody);

        $fields = [
            'SoldTo' => 'Sold To',
            'Email' => 'Email',
            'JobTitle' => 'Job Title',
            'CustPO' => 'Customper PO#',
            'job_no' => 'Job #',
            'PreviousOrder' => 'Previous Order #',
            'QuotedPrice' => 'Quoted Price',
            'AdditionalChg' => 'Additional Changes',
            'OrderDate' => 'Order Date',
            'StockDueIn' => 'Stock Due in',
            'DateDue' => 'Date Due In',
            'ContactName' => 'Contact Name',
            'Phone' => 'Phone #',
            'PhoneExt' => 'Phone Ext',
            'Mobile' => 'Mobile #',
            'Fax' => 'Fax #',
            'Machine1' => 'Machine 1',
            'Machine2' => 'Machine 2',
            'Machine3' => 'Machine 3',
            'Machine4' => 'Machine 4',
            'Machine5' => 'Machine 5',
            'Machine6' => 'Machine 6',
            
            'QtyNeeded' => 'Quantity Needed',
            'OversAllow' => 'Overs Allowed',
            'Total' => 'Total',
            
            'SizeDimension1' => 'Size 1',
            'SizeDimension2' => 'Size 2',
            'Desc' => 'Description',
            'WindowDoubleDie' => 'Window Double Die',
            'SealFlapSz' => 'Seal Flap size',
            'WindowSz1' => 'Window Size 1',
            'WindowSz2' => 'Window Size 2',
            'WindowSz3' => 'Window Size 3',
            'WindowPos1' => 'Window Position 1',            
            'WindowPos2' => 'Window Position 2',            
            'WindowPos3' => 'Window Position 3',
            
            
            'SealFlap' => 'Seal Flap',
            'GumType' => 'Type of Gum',
            'AmountForJets' => 'Amount For Jets',
            'ofCopies' => '# no Copies',
            'SpecialConvInst' => 'Special Converting Instruction',
            
            'OutDiagonal' => 'Out Diagonal Seam',
            'OutSide' => 'Out side Seam',
            'OutCatalogEnd' => 'MO Open-End',
            'OutCatalogSide' => 'MO Open-side',
            
            'ColoEnvStock' => 'Colorado Env Stock',
            
            'CustomerSupp' => 'Cusetomer Supplied',
            
            'SpecialCuttingInst' => 'Special Cutting Instruction',
            'Printing' => 'Printing',
            'InsideTintStyle' => 'Style',
            'Sides' => 'Sides',
            'Colors1' => 'Color 1',
            'Colors2' => 'Color 2',
            'Colors3' => 'Color 3',
            'Colors4' => 'Color 4',
           
            'CustomerSup' => 'Customer Supplied',
            'SpecialPrintInst' => 'Special Printing Instructions',
           
            'BulkAmtPerCtn' => 'Amt Per Ctn',
            'BulkAmtPerBox' => 'Amt Per Box',
            'BulkBoxSz' => 'Box Size',
            
            'FoldingAmtPerBox' => 'Amt Per Box (folding box)',
            'FoldingBoxSz' => 'Ctn Size',
            //'FoldingCtnSize' => 'Ctn Size',
            'Labeling' => 'Labels on Box',
            
            'MarkAs' => 'Marked As',
      
      
            'ShipViaDetail' => 'Shipping Company',
            'Account' => 'Account #',
            'ShipTo' => 'Ship To',
            'Address1' => 'Address 1',
            'Address2' => 'Address 2',
            'City' => 'City',
            'ST' => 'State',
            'Zip' => 'Zip',
            'ShipAttn' => 'Attn',
            'ShipContactPhone' => 'Phone',
            'SHIPPINGINSTRUCTIONS' => 'SHIPPING INSTRUCTIONS',
            
            
        ];

        $data['fields'] = $fields;

        $data['tbody'] = $tbody;

        $data['search'] = view('production-orders.search', $data)->render();

        return view('production-orders.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $customers = Customer::select('id', 'name')->orderBy('name')->get()->toArray();
        
        $unitFigures = UnitFigure::pluck('figure')->toArray();
        
        $machines = Machine::where('routing','=', 1)->orderBy('machine')->pluck('machine')->toArray();
        $locations = Location::pluck('location')->toArray();

        $descriptions = Description::pluck('description')->toArray();
        $windowSizes = WindowSize::pluck('size')->toArray();
        $openPolies = OpenPoly::pluck('openPoly')->toArray();
        $seals = SealFlap::pluck('sealFlap')->toArray();
        $gums = Gum::pluck('gum')->toArray();
        $dies = WindowDie::pluck('die')->toArray();
        $diagonalSeams = DiagonalSeam::pluck('size')->toArray();
        $openEnds = OpenEnd::pluck('size')->toArray();
        $sideSeams = SideSeam::pluck('size')->toArray();
        $coloStocks = ColoStock::pluck('size')->toArray();
        $openSides = OpenSide::pluck('size')->toArray();
        $printing = OptionPrint::pluck('print')->toArray();
        $styles = InsideTintStyle::pluck('style')->toArray();
        $custPO = [];

        $diesDiagonal = DiesDiagonal::pluck('size')->toArray();
        $diesSeam = DiesSeam::pluck('size')->toArray();
        $diesMO = DiesMo::pluck('size')->toArray();

        $values['addCustomer'] = view('customers.form')->render();
        $values['addContact'] = view('contacts.form')->render();
        
        $values['customers'] = $customers;
        $values['unitFigures'] = json_encode($unitFigures);
        $values['machines'] = json_encode($machines);
        $values['locations'] = json_encode($locations);
        $values['descriptions'] = json_encode($descriptions);
        $values['windowSizes'] = $windowSizes;
        $values['openPolies'] = $openPolies;
        $values['seals'] = json_encode($seals);
        $values['gums'] = $gums;
        $values['dies'] = json_encode($dies);
        $values['diagonalSeams'] = $diagonalSeams;
        $values['openEnds'] = $openEnds;
        $values['sideSeams'] = $sideSeams;
        $values['coloStocks'] = $coloStocks;
        $values['openSides'] = $openSides;
        $values['printing'] = $printing;
        $values['custPO'] = $custPO;
        $values['styles'] = $styles;
        $values['dieDiagonal'] = $diesDiagonal;
        $values['dieMO'] = $diesMO;
        $values['dieSeam'] = $diesSeam;
        $values['shippingDetails'] = [];

        return view('production-orders.create', $values);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $po = new ProductionOrder;

        unset($_POST['id'], 
              $_POST['_token'], 
              $_POST['ColoEnvPO']
            );

        foreach($_POST as $key => $value) {
            $po->{$key} = $value;
        }

        $orderDate = $request->get('OrderDate');
        $stockDueIn = $request->get('StockDueIn');
        $dateStockIn = $request->get('DateStockIn');
        $dateDue = $request->get('DateDue');

        

        if ($orderDate) {

            list($orderMonth, $orderDay, $orderYear) = explode('-', $request->get('OrderDate'));
        
            $po->OrderDate = sprintf("%s-%s-%s", $orderYear, $orderMonth, $orderDay);
        

        }
        
        if ($stockDueIn) {
        
            list($stockDueMonth, $stockDueDay, $stockDueYear) = explode('-', $request->get('StockDueIn'));
        
            $po->StockDueIn = sprintf("%s-%s-%s", $stockDueYear, $stockDueMonth, $stockDueDay);
        
        } 
        
        if ($dateStockIn) {

            list($dateStockMonth, $dateStockDay, $dateStockYear) = explode('-', $request->get('DateStockIn'));
        
            $po->DateStockIn = sprintf("%s-%s-%s", $dateStockYear, $dateStockMonth, $dateStockDay);
        
        }

        if ($dateDue) {

            list($dateDueMonth, $dateDueDay, $dateDueYear) = explode('-', $request->get('DateDue'));

            $po->DateDue = sprintf("%s-%s-%s", $dateDueYear, $dateDueMonth, $dateDueDay);
        
        }

       
        $po->Invoiced = isset($_POST['Invoiced']) ? 1 : 0;
        $po->SampleProv = isset($_POST['SampleProv']) ? 1 : 0;
        $po->our_stocks = isset($_POST['our_stocks']) ? 1 : 0;
        $po->customer_stocks = isset($_POST['customer_stocks']) ? 1 : 0;
        $po->RunAll = isset($_POST['RunAll']) ? 1 : 0;
        $po->ProofReqd = isset($_POST['ProofReqd']) ? 1 : 0;
        $po->SpecialLabels = isset($_POST['SpecialLabels']) ? 1 : 0;
        $po->BulkPack = isset($_POST['BulkPack']) ? 1 : 0;
        $po->FoldingBox = isset($_POST['FoldingBox']) ? 1 : 0;
        $po->CPU = isset($_POST['CPU']) ? 1 : 0;
        $po->SHIPVIA = isset($_POST['SHIPVIA']) ? 1 : 0;

        $po->save();

        return redirect('production-orders/' . $po->id . '/edit')->with('message', 'Product Order successfully created');

        /*$po->JobTitle = $request->get('JobTitle'); 
        $po->OrderDate = $request->get('OrderDate'); 
        $po->PreviousOrder = $request->get('PreviousOrder'); 
        $po->SoldTo = $request->get('SoldTo'); 
        $po->ContactName = $request->get('ContactName');  
        $po->Phone = $request->get('Phone');  
        $po->Fax = $request->get('Fax');  
        $po->Alt = $request->get('Alt');  
        $po->CustPO = $request->get('CustPO');  
        $po->QuotedPrice = $request->get('QuotedPrice');  
        $po->UnitFigure = $request->get('UnitFigure');  
        $po->AdditionalChg = $request->get('AdditionalChg');  
        $po->StockDueIn = $request->get('StockDueIn');  
        $po->DateStockIn = $request->get('DateStockIn');  
        $po->DueDate = $request->get('DueDate');  
        $po->Location = $request->get('Location');  
        $po->ofCopies = $request->get('ofCopies');  
        $po->Machine1 = $request->get('Machine1');  
        $po->Machine2 = $request->get('Machine2');  
        $po->Machine3 = $request->get('Machine3');  
        $po->Machine4 = $request->get('Machine4');  
        $po->Machine5 = $request->get('Machine5');  
        $po->Machine6 = $request->get('Machine6');  
        $po->SizeDimension1 = $request->get('');  
        $po->SizeDimension2 = $request->get('');  
        $po->Description = $request->get('');  
        $po->SealFlapSz = $request->get('');  
        $po->QtyNeeded = $request->get('');  
        $po->OversAllow = $request->get('');  
        $po->Total = $request->get('');  
        $po->WindowSz1 = $request->get('');  
        $po->WindowSz2 = $request->get('');  
        $po->WindowSz3 = $request->get('');  
        $po->WindowPos1 = $request->get('');  
        $po->OpenPolyWinPos1 = $request->get('');  
        $po->WindowPos2 = $request->get('');  
        $po->OpenPolyWinPos2 = $request->get('');  
        $po->WindowPos3 = $request->get('');  
        $po->OpenPolyWinPos3 = $request->get('');  
        $po->SealFlap = $request->get('');  
        $po->GumType = $request->get('');  
        $po->AmountForJets = $request->get('');  
        $po->WindowDoubleDie = $request->get('');  
        $po->SpecialConvinst = $request->get('');  
        $po->OutDiagonal = $request->get('');  
        $po->OutSide = $request->get('');  
        $po->OutCatalogEnd = $request->get('');  
        $po->OutCatalogSide = $request->get('');  
        $po->ColoEnvStock = $request->get('');  
        $po->SpecialCuttingInst = $request->get('');  
        $po->Printing = $request->get('');  
        $po->InsideTintStyle = $request->get('');  
        $po->Sides = $request->get('');  
        $po->Colors1 = $request->get('');  
        $po->Colors2 = $request->get('');  
        $po->Colors3 = $request->get('');  
        $po->CustomerSup = $request->get('');  
        $po->SpecialPrintInst = $request->get('');  
        $po->BulkAmtPerBox = $request->get('');  
        $po->BulkBoxSz = $request->get('');  
        $po->BulkAmtPerCtn = $request->get('');  
        $po->FoldingBoxSz = $request->get('');  
        $po->FoldingAmtPerBox = $request->get('');  
        $po->Labeling = $request->get('');  
        $po->MarkAs = $request->get('');  
        $po->ShipViaDetail = $request->get('');  
        $po->Account = $request->get('');  
        $po->ShipTo = $request->get('');  
        $po->Address1 = $request->get('');  
        $po->Address2 = $request->get('');  
        $po->City = $request->get('');  
        $po->ST = $request->get('');  
        $po->Zip = $request->get('');  
        $po->ShipAttn = $request->get('');  
        $po->ShipContactPhone = $request->get('');  
        $po->ColoEnvPO = $request->get('');  
        $po->Desc = $request->get('');  
        $po->SizeMO = $request->get('');  
        $po->packing = $request->get('');  
        $po->Notes = $request->get('');  Notes*/
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
    public function edit($id, Request $request)
    {
        $data = ProductionOrder::find($id);
        
        $customers = Customer::select('id', 'name')->where('status','=',1)->orderBy('name')->get()->toArray();

        $contacts = Contact::orderBy('name')->get();
        $shiptos = ShipTo::orderBy('shipto')->get();
        
        $unitFigures = UnitFigure::pluck('figure')->toArray();
        $machines = Machine::where('routing','=', 1)->orderBy('machine')->pluck('machine')->toArray();
        $locations = Location::pluck('location')->toArray();
        $descriptions = Description::pluck('description')->toArray();
        
        $windowSizes = PanelDie::orderBy('PanelDie')->pluck('PanelDie')->toArray(); //WindowSize::pluck('size')->toArray();

        $openPolies = OpenPoly::pluck('openPoly')->toArray();
        $seals = SealFlap::pluck('sealFlap')->toArray();
        $gums = Gum::pluck('gum')->toArray();
        $dies = DoubleDie::select('*', DB::raw('REPLACE(WindowDoubleDie, " ", "") as label'))->get()->toArray();
        $diagonalSeams = DiagonalSeam::pluck('size')->toArray();
        $openEnds = OpenEnd::pluck('size')->toArray();
        $sideSeams = SideSeam::pluck('size')->toArray();
        $coloStocks = ColoStock::pluck('size')->toArray();
        $openSides = OpenSide::pluck('size')->toArray();
        $printing = OptionPrint::pluck('print')->toArray();
        $styles = InsideTintStyle::pluck('style')->toArray();

        $diagonals = OutDiagonal::orderBy(DB::raw('REPLACE(die_size, " ", "")'), 'asc')
                        ->orderBy('sheet_size', 'asc')
                        ->orderBy('number_out', 'asc')
                        ->get()
                        ->toArray();

        $booklets = OutMoBooklet::orderBy(DB::raw('REPLACE(die_size, " ", "")'), 'asc')
                        ->orderBy('sheet_size', 'asc')
                        ->orderBy('number_out', 'asc')
                        ->get()
                        ->toArray();

        $catalogs = OutMoCatalog::orderBy(DB::raw('REPLACE(die_size, " ", "")'), 'asc')
                        ->orderBy('sheet_size', 'asc')
                        ->orderBy('number_out', 'asc')
                        ->get()
                        ->toArray();

        $outSideSeams = OutSideSeam::orderBy(DB::raw('REPLACE(die_size, " ", "")'), 'asc')
                        ->orderBy('sheet_size', 'asc')
                        ->orderBy('number_out', 'asc')
                        ->get()
                        ->toArray();

        $adjustables = Adjustable::orderBy(DB::raw('REPLACE(die_size, " ", "")'), 'asc')
                        ->orderBy('sheet_size', 'asc')
                        ->orderBy('number_out', 'asc')
                        ->get()
                        ->toArray();

        $webs = WebRa::orderBy(DB::raw('REPLACE(die_size, " ", "")'), 'asc')
                        ->orderBy('sheet_size', 'asc')
                        ->orderBy('number_out', 'asc')
                        ->get()
                        ->toArray();

        $films = WindowFilm::pluck('film')->toArray();

        $custPO = [];

        $diesDiagonal = DiesDiagonal::pluck('size')->toArray();
        $diesSeam = DiesSeam::pluck('size')->toArray();
        $diesMO = DiesMo::pluck('size')->toArray();

        $boxSizes = BoxSize::pluck('size')->toArray();
        $ctnSizes = CtnSize::pluck('size')->toArray();

        $tab = 'general-tab';

        if ($request->session()->exists('tab')) {
            $tab = $request->session()->get('tab');
            $request->session()->forget('tab');
        }

        $next = "";
        $previous = "";
        $dropdown = "";

        $nextResult = ProductionOrder::where('id', '>', $id)->orderBy('id')->first();
        $prevResult = ProductionOrder::where('id', '<', $id)->orderBy('id', 'desc')->first();

        if ($nextResult) {
            $next = sprintf("<a style='display: inline-block; max-height:36px' href='/production-orders/%s/edit' class='btn btn-primary'><i class='fa fa-chevron-right'></i></a>", $nextResult->id);
        }

        if ($prevResult) {
            $previous = sprintf("<a style='display:inline-block; max-height:36px' href='/production-orders/%s/edit' class='btn btn-primary'><i class='fa fa-chevron-left'></i></a>", $prevResult->id);      
        }    
        
        $options = ProductionOrder::orderBy('id')->get()->pluck('id');        

        list($year, $month, $day) = explode('-', $data['OrderDate']);

        $data['OrderDate'] = sprintf("%s-%s-%s", $month, $day, $year);

        list($year, $month, $day) = explode('-', $data['StockDueIn']);

        $data['StockDueIn'] = sprintf("%s-%s-%s", $month, $day, $year);

        list($year, $month, $day) = explode('-', $data['DateStockIn']);

        $data['DateStockIn'] = sprintf("%s-%s-%s", $month, $day, $year);

        list($year, $month, $day) = explode('-', $data['DateDue']);

        $data['DateDue'] = sprintf("%s-%s-%s", $month, $day, $year);

        $values['addCustomer'] = view('customers.form')->render();
        $values['addContact'] = view('contacts.form')->render();
        $values['packingSlip'] = view('production-orders.packing-email')->render();


        $values['data'] = $data;
        $values['customers'] = $customers;
        $values['contacts'] = $contacts;
        $values['unitFigures'] = json_encode($unitFigures);
        $values['machines'] = json_encode($machines);
        $values['locations'] = json_encode($locations);
        $values['descriptions'] = json_encode($descriptions);
        $values['windowSizes'] = json_encode($windowSizes);
        $values['openPolies'] = $films;
        $values['seals'] = json_encode($seals);
        $values['gums'] = json_encode($gums);
        $values['dies'] = json_encode($dies);
        $values['diagonalSeams'] = json_encode($diagonalSeams);
        $values['openEnds'] = json_encode($openEnds);
        $values['sideSeams'] = json_encode($sideSeams);
        $values['coloStocks'] = json_encode($coloStocks);
        $values['openSides'] = json_encode($openSides);
        $values['printing'] = json_encode($printing);
        $values['custPO'] = $custPO;
        $values['styles'] = json_encode($styles);
        $values['dieDiagonal'] = $diesDiagonal;
        $values['dieMO'] = $diesMO;
        $values['dieSeam'] = $diesSeam;
        $values['shippingDetails'] = [];

        $values['diagonals'] = json_encode($diagonals);
        $values['booklets'] = json_encode($booklets);
        $values['catalogs'] = json_encode($catalogs);
        $values['outSideSeams'] = json_encode($outSideSeams);
        $values['adjustables'] = json_encode($adjustables);
        $values['webs'] = json_encode($webs);

        $values['boxSizes'] = json_encode($boxSizes);
        $values['ctnSizes'] = json_encode($ctnSizes);

        $values['next'] = $next;
        $values['previous'] = $previous;
        $values['options'] = $options;

        $values['tab'] = $tab;

        $fields = [
            'SoldTo' => 'Sold To',
            'Email' => 'Email',
            'JobTitle' => 'Job Title',
            'CustPO' => 'Customper PO#',
            'job_no' => 'Job #',
            'PreviousOrder' => 'Previous Order #',
            'QuotedPrice' => 'Quoted Price',
            'AdditionalChg' => 'Additional Changes',
            'OrderDate' => 'Order Date',
            'StockDueIn' => 'Stock Due in',
            'DateDue' => 'Date Due In',
            'ContactName' => 'Contact Name',
            'Phone' => 'Phone #',
            'PhoneExt' => 'Phone Ext',
            'Mobile' => 'Mobile #',
            'Fax' => 'Fax #',
            'Machine1' => 'Machine 1',
            'Machine2' => 'Machine 2',
            'Machine3' => 'Machine 3',
            'Machine4' => 'Machine 4',
            'Machine5' => 'Machine 5',
            'Machine6' => 'Machine 6',
            
            'QtyNeeded' => 'Quantity Needed',
            'OversAllow' => 'Overs Allowed',
            'Total' => 'Total',
            
            'SizeDimension1' => 'Size 1',
            'SizeDimension2' => 'Size 2',
            'Desc' => 'Description',
            'WindowDoubleDie' => 'Window Double Die',
            'SealFlapSz' => 'Seal Flap size',
            'WindowSz1' => 'Window Size 1',
            'WindowSz2' => 'Window Size 2',
            'WindowSz3' => 'Window Size 3',
            'WindowPos1' => 'Window Position 1',            
            'WindowPos2' => 'Window Position 2',            
            'WindowPos3' => 'Window Position 3',
            
            
            'SealFlap' => 'Seal Flap',
            'GumType' => 'Type of Gum',
            'AmountForJets' => 'Amount For Jets',
            'ofCopies' => '# no Copies',
            'SpecialConvInst' => 'Special Converting Instruction',
            
            'OutDiagonal' => 'Out Diagonal Seam',
            'OutSide' => 'Out side Seam',
            'OutCatalogEnd' => 'MO Open-End',
            'OutCatalogSide' => 'MO Open-side',
            
            'ColoEnvStock' => 'Colorado Env Stock',
            
            'CustomerSupp' => 'Cusetomer Supplied',
            
            'SpecialCuttingInst' => 'Special Cutting Instruction',
            'Printing' => 'Printing',
            'InsideTintStyle' => 'Style',
            'Sides' => 'Sides',
            'Colors1' => 'Color 1',
            'Colors2' => 'Color 2',
            'Colors3' => 'Color 3',
            'Colors4' => 'Color 4',
           
            'CustomerSup' => 'Customer Supplied',
            'SpecialPrintInst' => 'Special Printing Instructions',
           
            'BulkAmtPerCtn' => 'Amt Per Ctn',
            'BulkAmtPerBox' => 'Amt Per Box',
            'BulkBoxSz' => 'Box Size',
            
            'FoldingAmtPerBox' => 'Amt Per Box (folding box)',
            'FoldingBoxSz' => 'Ctn Size',
            //'FoldingCtnSize' => 'Ctn Size',
            'Labeling' => 'Labels on Box',
            
            'MarkAs' => 'Marked As',
      
      
            'ShipViaDetail' => 'Shipping Company',
            'Account' => 'Account #',
            'ShipTo' => 'Ship To',
            'Address1' => 'Address 1',
            'Address2' => 'Address 2',
            'City' => 'City',
            'ST' => 'State',
            'Zip' => 'Zip',
            'ShipAttn' => 'Attn',
            'ShipContactPhone' => 'Phone',
            'SHIPPINGINSTRUCTIONS' => 'SHIPPING INSTRUCTIONS',
            
            
        ];

        $data['fields'] = $fields;

        $values['search'] = view('production-orders.search', $data)->render();


        return view('production-orders.edit', $values);
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
        $po = ProductionOrder::find($id);

        $tab = $_POST['tab'];

        unset($_POST['id'], 
              $_POST['_token'], 
              $_POST['ColoEnvPO'],
              $_POST['_method'],
              $_POST['select'],
              $_POST['tab'],
              $_POST['packing']
            );

        foreach($_POST as $key => $value) {            
            $po->{$key} = $request->get($key);
        }

        list($month, $day, $year) = explode('-', $request->get('OrderDate'));

        $po->OrderDate = sprintf("%s-%s-%s", $year, $month, $day);

        list($month, $day, $year) = explode('-', $request->get('StockDueIn'));

        $po->StockDueIn = sprintf("%s-%s-%s", $year, $month, $day);

        list($month, $day, $year) = explode('-', $request->get('DateStockIn'));

        $po->DateStockIn = sprintf("%s-%s-%s", $year, $month, $day);

        list($month, $day, $year) = explode('-', $request->get('DateDue'));

        $po->DateDue = sprintf("%s-%s-%s", $year, $month, $day);

        //print_r($_POST);

        $po->Invoiced = isset($_POST['Invoiced']) ? 1 : 0;
        $po->SampleProv = isset($_POST['SampleProv']) ? 1 : 0;
        $po->our_stocks = isset($_POST['our_stocks']) ? 1 : 0;
        $po->customer_stocks = isset($_POST['customer_stocks']) ? 1 : 0;
        $po->RunAll = isset($_POST['RunAll']) ? 1 : 0;
        $po->ProofReqd = isset($_POST['ProofReqd']) ? 1 : 0;
        $po->SpecialLabels = isset($_POST['SpecialLabels']) ? 1 : 0;
        $po->BulkPack = isset($_POST['BulkPack']) ? 1 : 0;
        $po->FoldingBox = isset($_POST['FoldingBox']) ? 1 : 0;
        $po->CPU = isset($_POST['CPU']) ? 1 : 0;
        $po->SHIPVIA = isset($_POST['SHIPVIA']) ? 1 : 0;

        $po->printing_flexo = isset($_POST['printing_flexo']) ? 1 : 0;
        $po->printing_inside_tint = isset($_POST['printing_inside_tint']) ? 1 : 0;
        $po->printing_jets = isset($_POST['printing_jets']) ? 1 : 0;


        $po->save();

        $request->session()->put('tab', $tab);

        //die();

        return redirect('production-orders/' . $po->id . '/edit')->with('message', 'Production Order succesfully saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductionOrder::find($id)->delete();
    }

    public function print($id) 
    {
        $data = ProductionOrder::find($id);

        $data->customer;

        return view('production-orders/print')->with('data', $data);
    }

    public function getContacts(Request $request)
    {
        $company = Customer::where('id', '=', $request->SoldTo)->first();

        $data = [];

        foreach($company->contacts as $contact) {
            $data[] = [
                'id' => $contact->id,
                'value' => $contact->name,
                'email' => $contact->email,
                'phone' => $contact->phone,
                'ext' => $contact->phone_ext,
                'mobile' => $contact->mobile,
                'fax' => $contact->fax
            ];
        }        

        return json_encode($data);        
    }

    public function getPackings($id) {
        
        $data['results'] = PackingSlipSub::where('ColoEnvPO', '=', $id)->get();

        $data['html'] = view('production-orders.packing-table', $data)->render();

        return json_encode($data);

    }

    public function copy($id) {

        $order = ProductionOrder::find($id);

        $documents = $order->documents;

        $new = $order->replicate();

        $new->Location = '';
        $new->QuotedPrice = 0;
        $new->ofCopies = '';
        
        $new->OrderDate = ''; //date("Y-m-d");
        $new->CustPO = '';
        $new->AdditionalChg = '';
        $new->StockDueIn = ''; //date("Y-m-d");
        $new->DateStockIn = ''; //date("Y-m-d");
        $new->DateDue = ''; //date("Y-m-d");
        $new->Invoiced = 0;
        $new->job_no = '';
        $new->Phone = '';
        $new->Email = '';
        $new->ContactName = '';
        $new->QtyNeeded = 0;
      
        $new->FoldingScheduleStatus = '';
        $new->JetScheduleStatus = '';


        $new->save();

        $target_path = 'public/pdf/' . $new->id . '/';

        $source_path = 'public/pdf/' . $id . '/';

        foreach( $documents as $d ) {

           $exists = Storage::exists('public/pdf/' . $id);

           
            if ( $exists ) {

                Storage::copy( $source_path . $d->filename, $target_path . $d->filename );

                $document = new Document;

                $document->production_order_id = $new->id;
                $document->filename = $d->filename;

                $document->save();

            }
        }


        return redirect('production-orders/' . $new->id . '/edit')->with('message', 'Production Order succesfully duplicate');

    }

    public function search() {
        
        return view('production-orders/search');

    }

    public function reset() {

        ProductionOrdersSearch::where('user_id', '=', auth()->id())->delete();

        return redirect('production-orders');

    }

    public function addDiagonal(Request $request) {

        $diagonal = new OutDiagonal;

        $diagonal->die_size = $request->get('die_size');
        $diagonal->sheet_size = $request->get('sheet_size');
        $diagonal->number_out = $request->get('number_out');
        $diagonal->die_number = $request->get('die_number');
        $diagonal->seal_flap_size = $request->get('seal_flap_size');

        $diagonal->save();

        return response()->json(['success' => 1]);

    }

    public function addMoBooklet(Request $request) {

        $booklet = new OutMoBooklet;

        $booklet->die_size = $request->get('die_size');
        $booklet->sheet_size = $request->get('sheet_size');
        $booklet->number_out = $request->get('number_out');
        $booklet->die_number = $request->get('die_number');
        $booklet->flat_size = $request->get('flat_size');
        $booklet->seal_flap_size = $request->get('seal_flap_size');

        $booklet->save();

        return response()->json(['success' => 1]);

    }

    public function addMoCatalog(Request $request) {

        $catalog = new OutMoCatalog;

        $catalog->die_size = $request->get('die_size');
        $catalog->sheet_size = $request->get('sheet_size');
        $catalog->number_out = $request->get('number_out');
        $catalog->die_number = $request->get('die_number');
        $catalog->flat_size = $request->get('flat_size');
        $catalog->seal_flap_size = $request->get('seal_flap_size');

        $catalog->save();

        return response()->json(['success' => 1]);

    }

    public function addSideSeam(Request $request) {

        $s = new OutSideSeam;

        $s->die_size = $request->get('die_size');
        $s->sheet_size = $request->get('sheet_size');
        $s->number_out = $request->get('number_out');
        $s->die_number = $request->get('die_number');
        $s->flat_size = $request->get('flat_size');
        $s->seal_flap_size = $request->get('seal_flap_size');

        $s->save();

        return response()->json(['success' => 1]);

    }

    public function getInfo($id) {

        $order = ProductionOrder::find($id);

        $customers = Customer::select('id', 'name')->orderBy('name')->get()->toArray();

        $data['title'] = sprintf("Job ID: %s", $order->id);

        $data['html'] = view('schedules.form', ['order' => $order, 'customers' => $customers])->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);
    }

    public function saveSchedule(Request $request) {
   
        $id = $request->get('id');

        $order = ProductionOrder::find($id);

        if ($request->get('StockDueIn')) {
            list($month, $day, $year) = explode('-', $request->get('StockDueIn'));
        }


        if ($request->has('CustomerId')) {
            $order->CustomerId = $request->get('CustomerId');
        }

        if ($request->has('QtyNeeded')) {
            $order->QtyNeeded = $request->get('QtyNeeded');
        }

        if ($request->has('SizeDimension1')) {
            $order->SizeDimension1 = $request->get('SizeDimension1');
        }

        if ($request->has('SizeDimension2')) {
            $order->SizeDimension2 = $request->get('SizeDimension2');
        }

        if ($request->has('Description')) {
            $order->Description = $request->get('Description');
        }

        if ($request->has('FoldingDue')) {
            $order->FoldingDue = $request->get('FoldingDue');
        }

        $order->Printing = $request->get('Printing');
        $order->Location = (string)$request->get('Location');
        $order->FoldingScheduleStatus = (string)$request->get('FoldingScheduleStatus');

        if ($request->get('StockDueIn')) {
            $order->StockDueIn = sprintf("%s-%s-%s", $year, $month, $day);
        }
        
        if ($request->has('FoldingOrder')) {
            $order->FoldingOrder = $request->get('FoldingOrder');
        }

        if ($request->has('DateDue')) {
            $order->DateDue = $request->get('DateDue');
        }

        if ($request->has('JobTitle')) {
            $order->JobTitle = $request->get('JobTitle');
        }

        if ($request->has('SHIPVIA')) {
            $order->SHIPVIA = $request->get('SHIPVIA');
        }

        $order->save();

        return response()->json(['success' => 1], 200, [], JSON_NUMERIC_CHECK);

    }

    public function notInvoiced()
    {
        $user = User::find(auth()->id());

        $data['theads'] = ['Order No', 'Job Title', 'Order Date', 'Sold To', 'Contact', 'Phone', 'PO #', 'Quantity', 'Location', 'Action'];

        $search = ProductionOrdersSearch::where('user_id', '=', $user->id)->first();

        $results = ProductionOrder::where('Invoiced', '=', 0);

        if ($search && $search->count() > 0) {

            $lookin = $search->lookin;
            $match = $search->match;
            $keywords = $search->search;

            if ($match == 'whole') {

                $results = $results->where($lookin, '=', $keywords);

            } else if ($match == 'any') {

                $results = $results->whereRaw('UPPER('. $lookin . ') LIKE ?', ['%'.strtoupper($keywords) . '%']);               
                
            } else {

                $results = $results->whereRaw('UPPER(?) LIKE ?%', [$lookin, strtoupper($keywords)]);

            }

        } 

        $results = $results->get();

        $tbody = [];       

        foreach($results as $result) {

            list($year, $month, $day) = explode('-', $result->OrderDate);

            $edit = sprintf("<a data-toggle='tooltip' title='Edit' data-action='edit' href='/production-orders/%s/edit' class='btn btn-primary' title='Edit'><i class='fa fa-edit'></i></a>", $result->id);
            $print = sprintf("<a data-toggle='tooltip' title='Print' href='/production-orders/%s/print' class='btn btn-info' target='_blank' data-action='print' title='Print'><i class='fa fa-print'></i></a>", $result->id);
            $delete = sprintf("<a data-toggle='tooltip' title='Delete'  href='/product-orders/%s/delete' class='btn btn-danger' data-action='delete' title='Delete' data-id='%s'><i class='fa fa-trash'></i></a>", $result->id, $result->id);
            $copy = sprintf("<a data-toggle='tooltip' title='Duplicate' href='/production-orders/%s/copy' class='btn btn-success' data-action='success' title='Duplicate' data-id='%s'><i class='fa fa-copy'></i></a>", $result->id, $result->id);

            $tbody[] = [
                'id' => sprintf("<a href='/production-orders/%s/edit'>%s</a>", $result->id, $result->id),
                'JobTitle' => $result->JobTitle,
                'OrderDate' => sprintf("%s-%s-%s", $month, $day, $year),
                'SoldTo' => $result->customer ? $result->customer->name : '',
                'ContactName' => $result->ContactName,
                'Phone' => $result->Phone,
                'CustPO' => $result->CustPO,
                'Quantity' => $result->QtyNeeded,
                'Location' => $result->Location,
                'Action' => sprintf("%s %s %s %s", $copy, $edit, $print, $delete)
            ];
        }

        $fields = [
            'SoldTo' => 'Sold To',
            'Email' => 'Email',
            'JobTitle' => 'Job Title',
            'CustPO' => 'Customper PO#',
            'PreviousOrder' => 'Previous Order #',
            'QuotedPrice' => 'Quoted Price',
            'AdditionalChg' => 'Additional Changes',
            'OrderDate' => 'Order Date',
            'StockDueIn' => 'Stock Due in',
            'DateDue' => 'Date Due In',
            'ContactName' => 'Contact Name',
            'Phone' => 'Phone #',
            'PhoneExt' => 'Phone Ext',
            'Mobile' => 'Mobile #',
            'Fax' => 'Fax #',
            'Machine1' => 'Machine 1',
            'Machine2' => 'Machine 2',
            'Machine3' => 'Machine 3',
            'Machine4' => 'Machine 4',
            'Machine5' => 'Machine 5',
            'Machine6' => 'Machine 6',
            
            'QtyNeeded' => 'Quantity Needed',
            'OversAllow' => 'Overs Allowed',
            'Total' => 'Total',
            
            'SizeDimension1' => 'Size 1',
            'SizeDimension2' => 'Size 2',
            'Desc' => 'Description',
            'WindowDoubleDie' => 'Window Double Die',
            'SealFlapSz' => 'Seal Flap size',
            'WindowSz1' => 'Window Size 1',
            'WindowSz2' => 'Window Size 2',
            'WindowSz3' => 'Window Size 3',
            'WindowPos1' => 'Window Position 1',            
            'WindowPos2' => 'Window Position 2',            
            'WindowPos3' => 'Window Position 3',
            
            
            'SealFlap' => 'Seal Flap',
            'GumType' => 'Type of Gum',
            'AmountForJets' => 'Amount For Jets',
            'ofCopies' => '# no Copies',
            'SpecialConvInst' => 'Special Converting Instruction',
            
            'OutDiagonal' => 'Out Diagonal Seam',
            'OutSide' => 'Out side Seam',
            'OutCatalogEnd' => 'MO Open-End',
            'OutCatalogSide' => 'MO Open-side',
            
            'ColoEnvStock' => 'Colorado Env Stock',
            
            'CustomerSupp' => 'Cusetomer Supplied',
            
            'SpecialCuttingInst' => 'Special Cutting Instruction',
            'Printing' => 'Printing',
            'InsideTintStyle' => 'Style',
            'Sides' => 'Sides',
            'Colors1' => 'Color 1',
            'Colors2' => 'Color 2',
            'Colors3' => 'Color 3',
            'Colors4' => 'Color 4',
           
            'CustomerSup' => 'Customer Supplied',
            'SpecialPrintInst' => 'Special Printing Instructions',
           
            'BulkAmtPerCtn' => 'Amt Per Ctn',
            'BulkAmtPerBox' => 'Amt Per Box',
            'BulkBoxSz' => 'Box Size',
            
            'FoldingAmtPerBox' => 'Amt Per Box (folding box)',
            'FoldingBoxSz' => 'Box Size (folding box)',
            'FoldingCtnSize' => 'Ctn Size',
            'Labeling' => 'Labels on Box',
            
            'MarkAs' => 'Marked As',
      
      
            'ShipViaDetail' => 'Shipping Company',
            'Account' => 'Account #',
            'ShipTo' => 'Ship To',
            'Address1' => 'Address 1',
            'Address2' => 'Address 2',
            'City' => 'City',
            'ST' => 'State',
            'Zip' => 'Zip',
            'ShipAttn' => 'Attn',
            'ShipContactPhone' => 'Phone',
            'SHIPPINGINSTRUCTIONS' => 'SHIPPING INSTRUCTIONS',
            
            
        ];

        $data['fields'] = $fields;

        $data['tbody'] = $tbody;

        $data['search'] = view('production-orders.search', $data)->render();

        return view('production-orders.not-invoiced', $data);
    }

    public function invoiced()
    {
        $user = User::find(auth()->id());

        $data['theads'] = ['Order No', 'Job Title', 'Order Date', 'Sold To', 'Contact', 'Phone', 'PO #', 'Quantity', 'Location', 'Action'];

        $search = ProductionOrdersSearch::where('user_id', '=', $user->id)->first();

        $results = ProductionOrder::where('Invoiced','=', 1);

        if ($search && $search->count() > 0) {

            $lookin = $search->lookin;
            $match = $search->match;
            $keywords = $search->search;

            if ($match == 'whole') {

                $results = $results->where($lookin, '=', $keywords);

            } else if ($match == 'any') {

                $results = $results->whereRaw('UPPER('. $lookin . ') LIKE ?', ['%'.strtoupper($keywords) . '%']);               
                
            } else {

                $results = $results->whereRaw('UPPER(?) LIKE ?%', [$lookin, strtoupper($keywords)]);

            }

        } 

        $results = $results->get();

        $tbody = [];       

        foreach($results as $result) {

            list($year, $month, $day) = explode('-', $result->OrderDate);

            $edit = sprintf("<a data-toggle='tooltip' title='Edit' data-action='edit' href='/production-orders/%s/edit' class='btn btn-primary' title='Edit'><i class='fa fa-edit'></i></a>", $result->id);
            $print = sprintf("<a data-toggle='tooltip' title='Print' href='/production-orders/%s/print' class='btn btn-info' target='_blank' data-action='print' title='Print'><i class='fa fa-print'></i></a>", $result->id);
            $delete = sprintf("<a data-toggle='tooltip' title='Delete'  href='/product-orders/%s/delete' class='btn btn-danger' data-action='delete' title='Delete' data-id='%s'><i class='fa fa-trash'></i></a>", $result->id, $result->id);
            $copy = sprintf("<a data-toggle='tooltip' title='Duplicate' href='/production-orders/%s/copy' class='btn btn-success' data-action='success' title='Duplicate' data-id='%s'><i class='fa fa-copy'></i></a>", $result->id, $result->id);

            $tbody[] = [
                'id' => sprintf("<a href='/production-orders/%s/edit'>%s</a>", $result->id, $result->id),
                'JobTitle' => $result->JobTitle,
                'OrderDate' => sprintf("%s-%s-%s", $month, $day, $year),
                'SoldTo' => $result->customer ? $result->customer->name : '',
                'ContactName' => $result->ContactName,
                'Phone' => $result->Phone,
                'CustPO' => $result->CustPO,
                'Quantity' => $result->QtyNeeded,
                'Location' => $result->Location,
                'Action' => sprintf("%s %s %s %s", $copy, $edit, $print, $delete)
            ];
        }

        $fields = [
            'SoldTo' => 'Sold To',
            'Email' => 'Email',
            'JobTitle' => 'Job Title',
            'CustPO' => 'Customper PO#',
            'PreviousOrder' => 'Previous Order #',
            'QuotedPrice' => 'Quoted Price',
            'AdditionalChg' => 'Additional Changes',
            'OrderDate' => 'Order Date',
            'StockDueIn' => 'Stock Due in',
            'DateDue' => 'Date Due In',
            'ContactName' => 'Contact Name',
            'Phone' => 'Phone #',
            'PhoneExt' => 'Phone Ext',
            'Mobile' => 'Mobile #',
            'Fax' => 'Fax #',
            'Machine1' => 'Machine 1',
            'Machine2' => 'Machine 2',
            'Machine3' => 'Machine 3',
            'Machine4' => 'Machine 4',
            'Machine5' => 'Machine 5',
            'Machine6' => 'Machine 6',
            
            'QtyNeeded' => 'Quantity Needed',
            'OversAllow' => 'Overs Allowed',
            'Total' => 'Total',
            
            'SizeDimension1' => 'Size 1',
            'SizeDimension2' => 'Size 2',
            'Desc' => 'Description',
            'WindowDoubleDie' => 'Window Double Die',
            'SealFlapSz' => 'Seal Flap size',
            'WindowSz1' => 'Window Size 1',
            'WindowSz2' => 'Window Size 2',
            'WindowSz3' => 'Window Size 3',
            'WindowPos1' => 'Window Position 1',            
            'WindowPos2' => 'Window Position 2',            
            'WindowPos3' => 'Window Position 3',
            
            
            'SealFlap' => 'Seal Flap',
            'GumType' => 'Type of Gum',
            'AmountForJets' => 'Amount For Jets',
            'ofCopies' => '# no Copies',
            'SpecialConvInst' => 'Special Converting Instruction',
            
            'OutDiagonal' => 'Out Diagonal Seam',
            'OutSide' => 'Out side Seam',
            'OutCatalogEnd' => 'MO Open-End',
            'OutCatalogSide' => 'MO Open-side',
            
            'ColoEnvStock' => 'Colorado Env Stock',
            
            'CustomerSupp' => 'Cusetomer Supplied',
            
            'SpecialCuttingInst' => 'Special Cutting Instruction',
            'Printing' => 'Printing',
            'InsideTintStyle' => 'Style',
            'Sides' => 'Sides',
            'Colors1' => 'Color 1',
            'Colors2' => 'Color 2',
            'Colors3' => 'Color 3',
            'Colors4' => 'Color 4',
           
            'CustomerSup' => 'Customer Supplied',
            'SpecialPrintInst' => 'Special Printing Instructions',
           
            'BulkAmtPerCtn' => 'Amt Per Ctn',
            'BulkAmtPerBox' => 'Amt Per Box',
            'BulkBoxSz' => 'Box Size',
            
            'FoldingAmtPerBox' => 'Amt Per Box (folding box)',
            'FoldingBoxSz' => 'Box Size (folding box)',
            'FoldingCtnSize' => 'Ctn Size',
            'Labeling' => 'Labels on Box',
            
            'MarkAs' => 'Marked As',
      
      
            'ShipViaDetail' => 'Shipping Company',
            'Account' => 'Account #',
            'ShipTo' => 'Ship To',
            'Address1' => 'Address 1',
            'Address2' => 'Address 2',
            'City' => 'City',
            'ST' => 'State',
            'Zip' => 'Zip',
            'ShipAttn' => 'Attn',
            'ShipContactPhone' => 'Phone',
            'SHIPPINGINSTRUCTIONS' => 'SHIPPING INSTRUCTIONS',
            
            
        ];

        $data['fields'] = $fields;

        $data['tbody'] = $tbody;

        $data['search'] = view('production-orders.search', $data)->render();

        return view('production-orders.invoiced', $data);
    }

    public function getViewSchedulesData( Request $request ) {

        $machines = DB::table('machines')
                        ->select('machines.*', DB::raw('machine_masters.machine as title'), DB::raw('machine_masters.id as machine_id'))
                        ->join('machine_masters', 'machine_masters.category', '=', 'machines.id')
                        ->where('machine_masters.status', '=', 1)
                        ->orderBy('machine_masters.machine')
                        ->get();

        $results = ProductionOrder::select('production_orders.*', 'customers.name as SoldTo')
                        ->leftJoin('customers', 'customers.id', '=', 'production_orders.CustomerId')
                        ->whereNotIn('Location', ['Complete'])
                        ->orderBy('FoldingOrder')
                        ->orderBy('JetOrder')
                        ->get();;

        $data['machines'] = $machines;
        $data['results'] = $results;

        return response()->json( $data, 200, [], JSON_NUMERIC_CHECK );

    }

    public function getDocuments( Request $request ) {

        $id = $request->get('id');

        $documents = Document::where('production_order_id', '=', $id)->get();

        $data['documents'] = $documents;

        return response()->json( $data, 200, [], JSON_NUMERIC_CHECK );

    }

    public function upload( Request $request, $id ) {

        $document = $request->file('documents');

        $filename = $document->getClientOriginalName();

        Storage::put( 'public/pdf/' . $id . '/' . $filename, file_get_contents($document->getRealPath()) );

        $d = new Document;

        $d->production_order_id = $id;
        $d->filename = $filename;

        $d->save();

        return $id;

    }

    public function deleteDocument( Request $request ) {

        $document = Document::find( $request->get('id') );

        $file = 'public/pdf/' . $document->production_order_id . '/' . $document->filename;

        if (Storage::exists($file)) {

            Storage::delete($file);

        } 

        $document->delete();

        return response()->json(['success' => 1]);
    }

    public function dashboard() {

        $year = date("Y");

        $week = date("W");

        $dates = $this->getWeekDays( $week, $year );

        $envelopes = ProductionOrder::select(
                            DB::raw('SUM(QtyNeeded + (QtyNeeded * OversAllow / 100 ))  as quantity'),
                            DB::raw('DATE_FORMAT(DateDue, "%b") as month'),
                            DB::raw('YEAR(DateDue) as year')
                        )
                        ->where(DB::raw('YEAR(DateDue)'), '=', $year)
                        ->where('QtyNeeded', '>', 0)
                        ->orderBy('DateDue')
                        ->groupBy(DB::RAW('MONTH(DateDue)'))
                        ->get();

        $completed = ProductionOrder::select(
                            DB::raw('SUM(QtyNeeded + (QtyNeeded * OversAllow / 100 ))  as quantity'),
                            DB::raw('DATE_FORMAT(DateDue, "%b") as month'),
                            DB::raw('YEAR(DateDue) as year')
                        )
                        ->join('packing_slip_subs', 'packing_slip_subs.ColoEnvPo', '=', 'production_orders.id')
                        ->where('packing_slip_subs.OrderStatus', '=', 'COMPLETE')
                        ->where(DB::raw('YEAR(DateDue)'), '=', $year)
                        ->where('QtyNeeded', '>', 0)
                        ->orderBy('DateDue')
                        ->groupBy(DB::RAW('MONTH(DateDue)'))
                        ->get();

        $sales = ProductionOrder::select(
                            DB::raw('SUM(QuotedPrice) as amount'),
                            DB::raw('DATE_FORMAT(DateDue, "%b") as month'),
                            DB::raw('YEAR(DateDue) as year')
                        )
                        ->where(DB::raw('YEAR(DateDue)'), '=', $year)
                        ->where('QtyNeeded', '>', 0)
                        ->orderBy('DateDue')
                        ->groupBy(DB::RAW('MONTH(DateDue)'))
                        ->get();

        $weeks = ProductionOrder::select(
                            DB::raw('SUM(QtyNeeded + (QtyNeeded * OversAllow / 100 ))  as quantity'),
                            DB::raw('DATE_FORMAT(DateDue, "%a") as day'),
                            DB::raw('YEAR(DateDue) as year')
                        )
                        ->whereIn('DateDue', $dates)
                        ->where('QtyNeeded', '>', 0)
                        ->orderBy('DateDue')
                        ->groupBy(DB::RAW('DateDue'))
                        ->get();

        $completedThisWeek = ProductionOrder::select(
                                DB::raw('SUM(QtyNeeded + (QtyNeeded * OversAllow / 100 ))  as quantity'),
                                DB::raw('DATE_FORMAT(DateDue, "%a") as day'),
                                DB::raw('YEAR(DateDue) as year')
                            )
                            ->join('packing_slip_subs', 'packing_slip_subs.ColoEnvPo', '=', 'production_orders.id')
                            ->whereIn('DateDue', $dates)
                            ->where('QtyNeeded', '>', 0)
                            ->where('packing_slip_subs.OrderStatus', '=', 'COMPLETE')
                            ->orderBy('DateDue')                            
                            ->groupBy(DB::RAW('DateDue'))
                            ->get();

        $data['envelopes'] = $envelopes;
        $data['weeks'] = $weeks;
        $data['sales'] = $sales;
        $data['year'] = $year;
        $data['week'] = $week;
        $data['dates'] = $dates;
        $data['completed'] = $completed;
        $data['completedThisWeek'] = $completedThisWeek;

        return response()->json( $data, 200, [], JSON_NUMERIC_CHECK );

    }

    private function getWeekDays($week, $year) {
        
        $dates = [];

        $user = User::find(auth()->id());
      
        $now = time();

        $jan1 = strtotime( "January 1 " . $year );

        if ( date("w", $jan1) == 0) {

            $current = date("Y-m-d", strtotime( "January 1 " . $year. " + " . (int)($week - 1) . " Week") );

        } else {

            $current = date("Y-m-d", strtotime( "January 1 " . $year. " + " . (int)($week) . " Week") );

        }

        $base_mon = $this->getBaseSunday( $current );

        $ts_ref = $base_mon;
        
        for($i=0; $i< 7; $i += 1) {

            $ts = strtotime("+ $i day", $ts_ref);

            $dates[] = date("Y-m-d", $ts);

            
        }

        //print_r($headers);

        return $dates;
    }

    private function getBaseSunday( $date ) {

        $date_ts = $this->getTimeStamp( $date );

        $isSunday = $this->isSunday( $date_ts );

        if ($isSunday) {

            return $date_ts;

        } else {

            return strtotime("last Sunday", $date_ts);

        }

    }

    private function isSunday( $date_ts ) {

        $ref = (int)date("w", $date_ts);

        if ($ref == 0) {

            return true;

        }  else {

            return false;

        }

    }

    private function getTimeStamp( $date ) {

        list($y, $m, $d) = explode('-', $date);

        return mktime(0,0,0, (int)$m, (int)$d, $y);

    }

    public function getShipTo( Request $request ) {

        $customer = Customer::find( $request->get('SoldTo') );

        $data = [];

        foreach( $customer->shiptos as $s) {

            $data[] = [
                        'id' => $s->id,
                        'shipto' => $s->shipto,
                        'value' => $s->shipto,
                        'address1' => $s->address1,
                        'address2' => $s->address2,
                        'city' => $s->city,
                        'state' => $s->state,
                        'zip' => $s->zip,
                        'attn' => $s->attn,
                        'phone' => $s->phone
                    ];

        }

        return json_encode($data);

    }

}
