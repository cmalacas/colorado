<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PurchaseOrder;
use App\ProductionOrder;
use App\Vendor;
use App\VendorContact;
use App\PurchaseOrderItem;

use App\Customer;
use App\Contact;

class PurchaseOrders extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['theads'] = ['PO#', 'Todays Date', 'Date Required', 'To', 'For', 'Action'];

        $results = PurchaseOrder::orderBy('id', 'asc')->get();        

        $tbody = [];

        foreach($results as $result) {
            $tbody[] = [
                //'ColoEnvPO' => $result->ColoEnvPO,
                'id' => sprintf("<a href='/purchase-orders/%s/edit' title='Edit' data-action='edit'>%s</a>", $result->id, $result->id),
                'todasydate' => $result->todaysdate,
                'datereqd' => $result->datereqd,
                'to' => $result->vendor ? $result->vendor->vendor : '',
                'for' => $result->for,
                'Action' => sprintf("<a href='/purchase-orders/%s/edit' class='btn btn-primary' title='Edit' data-action='edit'><i class='fa fa-edit'></i></a> <a href='/purchase-orders/%s/print' target='_blank' class='btn btn-info' title='Print' data-action='print' data-id='%s'><i class='fa fa-print'></i></a> <a title='Delete' data-action='delete' data-id='%s' href='' class='btn btn-danger'><i class='fa fa-trash'></i></a>", $result->id, $result->id, $result->id, $result->id)
            ];
        }

        $data['tbody'] = $tbody;

        return view('purchase-orders.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productionOrders = ProductionOrder::where('Location','=','Complete')->orderBy('id')->get();

        $data['vendors'] = Vendor::pluck('vendor')->toArray();
        $data['productionOrders'] = json_encode($productionOrders);
        $data['ColoEnvPO'] = $productionOrders->pluck('id');
        //$data['FORM'] = view('purchase-orders.form', $data)->render();

        return view('purchase-orders.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $po = new PurchaseOrder;

        $po->ColoEnvPO = $request->get('ColoEnvPO');
        $po->to = $request->get('to');
        $po->phone = $request->get('phone');
        $po->cellphone = $request->get('cellphone');
        $po->fax = $request->get('fax');
        $po->for = $request->get('for');
        $po->ship = $request->get('ship');
        $po->shippingco = $request->get('shippingco');
        $po->todaysdate = $request->get('todaysdate');
        $po->datereqd = $request->get('datereqd');
        $po->comments = $request->get('comments');
        $po->email = $request->get('email');
        $po->contact = $request->get('contact');
        $po->address = $request->get('address');
        $po->extension = $request->get('extension');

        $po->save();

        $purchaseOrderId = $po->id;

        if ($request->has('items')) {

            $items = $request->get('items');

            foreach($items as $item) {

                $poItem = new PurchaseOrderItem;

                $poItem->production_order_id = $item['po'];
                $poItem->description = $item['desc'];
                $poItem->qty = $item['qty'];
                $poItem->price = $item['price'];
                $poItem->recvd = $item['recvd'];
                $poItem->date = $item['date'];
                $poItem->purchase_order_id = $purchaseOrderId;

                $poItem->save();

            }

        }


        return redirect('purchase-orders/' . $po->id . '/edit')->with('message', 'Purchase Successfully created');
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
        $purchaseOrder = PurchaseOrder::find($id);

        $productionOrders = ProductionOrder::where('Location', '=', 'Complete')->orderBy('id')->get();

        $data['items'] = $purchaseOrder->items;
        $data['val'] = $purchaseOrder;
        $data['vendors'] = Vendor::pluck('vendor')->toArray();
        
        $data['productionOrders'] = json_encode($productionOrders);
        $data['ColoEnvPO'] = $productionOrders->pluck('id');

        return view('purchase-orders.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->get('id');

        $po = PurchaseOrder::find($id);

        $po->ColoEnvPO = $request->get('ColoEnvPO');
        $po->to = $request->get('to');
        $po->phone = $request->get('phone');
        $po->cellphone = $request->get('cellphone');
        $po->fax = $request->get('fax');
        $po->for = $request->get('_for');
        $po->ship = $request->get('ship');
        $po->shippingco = $request->get('shippingco');
        $po->todaysdate = $request->get('todaysdate');
        $po->datereqd = $request->get('datereqd');
        $po->comments = $request->get('comments');
        $po->email = $request->get('email');
        $po->contact = $request->get('contact');
        $po->address = $request->get('address');
        $po->extension = $request->get('extension');
        
        $po->save();

        $purchaseOrderId = $po->id;

        $items = $po->items;

        foreach($items as $item) {
            $item->delete();
        }

        if ($request->has('productionOrders')) {

            $items = $request->get('productionOrders');

            foreach($items as $item) {

                $poItem = new PurchaseOrderItem;

                $poItem->production_order_id = $item['production_order_id'];
                $poItem->description = $item['description'];
                $poItem->qty = $item['qty'];
                $poItem->price = $item['price'];
                $poItem->recvd = $item['recvd'];
                $poItem->date = $item['date'];
                $poItem->purchase_order_id = $purchaseOrderId;

                $poItem->save();

            }

        }

        return response()->json(['success' => 1], 200, [], JSON_NUMERIC_CHECK);

        //return redirect('purchase-orders/' . $po->id . '/edit')->with('message', 'Purchase Successfully saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->get('id');

        PurchaseOrder::find($id)->delete();
    }

    public function print($id) 
    {
        $data = PurchaseOrder::find($id);

        return view('purchase-orders.print')->with('data', $data);
    }

    public function copy(Request $request ) {

        $id = $request->get('id');

        $order = PurchaseOrder::find($id);

        $items = $order->items;

        $new = $order->replicate();

        $new->todaysdate = null;
        $new->datereqd = null;

        $new->save();

        foreach($items as $item) {

            $newItem = $item->replicate();

            $newItem->purchase_order_id = $new->id;

            $newItem->save();

        }

        $data['id'] = $new->id;

        return response()->json( $data, 200, [], JSON_NUMERIC_CHECK );

        //return redirect('purchase-orders/' . $new->id . '/edit')->with('message', 'Purchase Order succesfully duplicate');

    }

    public function getData( Request $request ) {

        $customers = Vendor::orderBy('vendor')->get();

        $contacts = VendorContact::orderBy('name')->get();

        $production_orders = ProductionOrder::orderBy('id')->get();

        $purchase = [];

        if ( $request->has('id')) {

            $purchase = PurchaseOrder::find( $request->get('id') );

            $purchase->items;

            $result = PurchaseOrder::where('id', '>', $request->get('id'))->orderBy('id','asc')->first();

            $next = $result ? $result->id : $request->get('id');
        
            $result = PurchaseOrder::where('id', '<', $request->get('id'))->orderBy('id', 'desc')->first();

            $previous = $result ? $result->id : $request->get('id');

            $data['pos'] = PurchaseOrder::select('id')->orderBy('id')->get();
            $data['next'] = $next;
            $data['previous'] = $previous;

        }

        

        $data['purchase'] = $purchase;

        $data['customers'] = $customers;

        $data['contacts'] = $contacts;

        $data['production_orders'] = $production_orders;

        return response()->json( $data, 200, [], JSON_NUMERIC_CHECK );


    }

    public function save( Request $request ) {

        $po = new PurchaseOrder;

        //$po->ColoEnvPO = $request->get('ColoEnvPO');
        
        $po->to = $request->get('to');
        $po->phone = $request->get('phone');
        $po->cellphone = $request->get('cellphone');
        $po->fax = $request->get('fax');
        $po->for = $request->get('_for');
        $po->ship = $request->get('ship');
        $po->shippingco = $request->get('shippingco');
        $po->todaysdate = $request->get('todaysdate');
        $po->datereqd = $request->get('datereqd');
        $po->comments = $request->get('comments');
        $po->email = $request->get('email');
        $po->extension = $request->get('extension');

        $po->save();

        $items = $request->get('productionOrders');

        foreach( $items as $i ) {

            $item = new PurchaseOrderItem;

            $item->production_order_id = $i['production_order_id'];
            $item->purchase_order_id =  $po->id;
            $item->description = $i['description'];
            $item->price = $i['price'];
            $item->recvd = $i['recvd'];
            $item->date = $i['date'];
            $item->qty = $i['qty'];

            $item->save();

        }

        $data['purchase'] = $po;
        $data['success'] = 1;

        return response()->json( $data, 200, [], JSON_NUMERIC_CHECK );
        
    }
}
