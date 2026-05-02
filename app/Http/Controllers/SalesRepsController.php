<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SalesRep;

class SalesRepsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function get(Request $request)
  {
    $data['salesreps'] = SalesRep::where('customer_id', '=', $request->get('customerId'))->get();
    $data['customer_id'] = $request->get('customerId');

    return json_encode($data);
  }

  public function save(Request $request)
  {

    $reps = new SalesRep;

    $reps->name = $request->get('name');
    $reps->email = $request->get('email');
    $reps->phone = $request->get('phone');
    $reps->customer_id = $request->get('customerId');

    $reps->save();

    $data['salesreps'] = SalesRep::where('customer_id', '=', $request->get('customerId'))->orderBy('name')->get();


    return json_encode($data);
  }


}
