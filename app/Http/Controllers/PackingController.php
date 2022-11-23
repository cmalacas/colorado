<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\PackingSlipSub;

use App\Mail\SendMailable;
use App\Mail\PackingSlipMail;
use Illuminate\Support\Facades\Mail;

use PDF;

class PackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $packing = new PackingSlipSub;

        $post = $request->get('packing');

        $packing->ColoEnvPO = $post['ColoEnvPO'];

        list($month, $day, $year) = explode('-', $post['DateShip']);

        $packing->DateShip = sprintf("%s-%s-%s", $year, $month, $day);
        $packing->TotalShip = $post['TotalShip'];
        $packing->Details = $post['Details'];
        $packing->OrderStatus = $post['OrderStatus'];

        $packing->save();

        $data['results'] = PackingSlipSub::where('ColoEnvPO', '=', $post['ColoEnvPO'])->get();

        $data['html'] = view('production-orders.packing-table', $data)->render();

        echo json_encode($data);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $packing = PackingSlipSub::find($id);

        $customer = $packing->production_order->customer;

        $data['packing'] = $packing;

        $data['table'] = view('packing.email-table', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['packing'] = PackingSlipSub::find($id);

        $data['html'] = view('production-orders.packing-form', $data)->render();

        echo json_encode($data);
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
        $packing = PackingSlipSub::find($id);

        $post = $request->get('packing');

        list( $month, $day, $year ) = explode('-', $post['DateShip']);

        $packing->DateShip = date("Y-m-d", mktime(0,0,0, $month, $day, $year));
        $packing->TotalShip = $post['TotalShip'];
        $packing->Details = $post['Details'];
        $packing->OrderStatus = $post['OrderStatus'];

        $packing->save();

        $data['results'] = PackingSlipSub::where('ColoEnvPO', '=', $post['ColoEnvPO'])->get();

        $data['html'] = view('production-orders.packing-table', $data)->render();

        echo json_encode($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PackingSlipSub::find($id)->delete();
    }

    public function print($id) {

        $packing = PackingSlipSub::find($id);

        $order = $packing->production_order;

        $counter = 0;

        foreach( $order->packings as $i => $p ) {

            if ( $p->id === $packing->id ) {

                $counter = $i + 1;

            }

        }

        $data['order'] = $order;
        $data['packing'] = $packing;
        $data['counter'] = $counter;

        $data['id'] = $id;

        return view('packing.print', $data);
    }

    public function sent(Request $request) {

        $packing = PackingSlipSub::find($request->get('id'));

        $order = $packing->production_order;

        $counter = 0;

        foreach( $order->packings as $i => $p ) {

            if ( $p->id === $packing->id ) {

                $counter = $i + 1;

            }

        }

        $data['order'] = $order;
        $data['packing'] = $packing;
        $data['counter'] = $counter;        
        $data['remarks'] = $request->get('remarks'); 

        $email = $request->get('email');

        $pdf = PDF::loadView('packing.pdf-print', $data );

        Storage::put('pdf/'.$order->id . '-' . $counter .'.pdf', $pdf->output());

        $mail = new PackingSlipMail( $data );

        $mail->file = Storage::path('pdf/' . $order->id . '-' . $counter . '.pdf');

        Mail::to($request->get('email'))->send( $mail );        
        
        //Mail::to('celsomalacasjr@gmail.com')->send( $mail );

        return response()->json(['success' => 1]);

    }
}
