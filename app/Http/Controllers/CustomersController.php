<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;
use App\Contact;
use App\ShipTo;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['customers'] = Customer::where('status','=',1)->get();

        $data['table'] = view('customers.table', $data)->render();

        return json_encode($data);
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
        $customer = new Customer;

        $customer->name = $request->get('name');

        $customer->save();

        $customer_id = $customer->id;

        $contacts = $request->get('contact');

        $shiptos = $request->get('shiptos');

        if ($contacts)
        {
            foreach($contacts as $contact)
            {
                $c = new Contact;

                $c->id = $contact['id'];
                $c->name = $contact['name'];
                $c->email = $contact['email'];
                $c->phone = $contact['phone'];
                $c->phone_ext = $contact['ext'];
                $c->mobile = $contact['mobile'];
                $c->fax = $contact['fax'];
                $c->customer_id = $customer->id;

                $c->save();
            }
        }

        if ($shiptos)
        {
            foreach($shiptos as $shipto)
            {
                $c = new ShipTo;

                $c->shipto = $shipto['shipto'];
                $c->address1 = $shipto['address1'];
                $c->address2 = $shipto['address2'];
                $c->city = $shipto['city'];
                $c->state = $shipto['state'];
                $c->zip = $shipto['zip'];
                $c->attn = $shipto['attn'];
                $c->phone = $shipto['phone'];
                $c->customer_id = $customer->id;

                $c->save();
            }
        }

        $customers = Customer::where('status','=',1)->get();

        $data['customers'] = $customers;

        $data['customer_id'] = $customer_id;

        $data['options'] = $customers->pluck('name', 'id');

        $data['table'] = view('customers.table', $data)->render();

        return json_encode($data);
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
        $customer = Customer::find($id);

        $data['customer'] = $customer;
        $data['contacts'] = $customer->contacts;

        $data['table'] = view('contacts.table', $data)->render();

        return json_encode($data);
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
        $customer = Customer::find($id);

        $customer->name = $request->get('name');

        $customer->save();

        foreach($customer->contacts as $contact)
        {
            $contact->delete();
        }

        $contacts = $request->get('contact');

        if ($contacts) {

            foreach($contacts as $contact)
            {
                $c = new Contact;

                $c->id = $contact['id'];
                $c->name = $contact['name'];
                $c->email = $contact['email'];
                $c->phone = $contact['phone'];
                $c->phone_ext = $contact['ext'];
                $c->mobile = $contact['mobile'];
                $c->fax = $contact['fax'];
                $c->customer_id = $customer->id;

                $c->save();
            }
        }

        return json_encode(['success' => 1]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);

        foreach($customer->contacts as $contact)
        {
            $contact->delete();
        }

        $customer->delete();

        $customers = Customer::where('status','=',1)->get();

        $data['customers'] = $customers;
        $data['options'] = $customers->pluck('Name', 'id');

        $data['table'] = view('customers.table', $data)->render();

        return json_encode($data);
    }

    public function hide($id) {
        
        $customer = Customer::find($id);

        $customer->status = 0;

        $customer->save();

        return json_encode(['success' => 1]);
    }

    public function gets() {

        $customers = Customer::OrderBy('name')->get();

        echo json_encode(['customers' => $customers]);

    }

    public function getData() {

        $customers = Customer::OrderBy('name')->get();

        $contacts = Contact::orderBy('name')->get();
        $shiptos = ShipTo::orderBy('shipto')->get();

        $data['customers'] = $customers;
        $data['contacts'] = $contacts;
        $data['shiptos'] = $shiptos;

        return response()->json( $data, 200, [], JSON_NUMERIC_CHECK );

    }

    public function updateCustomer( Request $request ) {

        $customer = Customer::find( $request->get('id') );

        $customer->name = $request->get('name');

        $customer->save();

        foreach( $customer->contacts as $co ) {

            $co->delete();

        }

        foreach( $customer->shiptos as $co ) {

            $co->delete();

        }

        if ( $request->has('contacts') ) {

            $contacts = $request->get('contacts');

            foreach( $contacts as $c ) {

                $name = $c['name'];

                if ( strlen($name) > 0 ) {

                    $contact = new Contact;

                    $contact->customer_id = $customer->id;
                    $contact->name = $c['name'];
                    $contact->phone = $c['phone'];
                    $contact->phone_ext = $c['phone_ext'];
                    $contact->email = $c['email'];
                    $contact->mobile = $c['mobile'];
                    $contact->fax = $c['fax'];

                    $contact->save();

                }

            }

        }

        if ( $request->has('shiptos') ) {

            $shiptos = $request->get('shiptos');

            foreach( $shiptos as $c ) {

                $shipto = $c['shipto'];

                if ( strlen($shipto) > 0 ) {

                    $s = new ShipTo;

                    $s->customer_id = $customer->id;
                    $s->shipto = $c['shipto'];
                    $s->address1 = $c['address1'];
                    $s->address2 = $c['address2'];
                    $s->city = $c['city'];
                    $s->state = $c['state'];
                    $s->zip = $c['zip'];
                    $s->attn = $c['attn'];
                    $s->phone = $c['phone'];

                    $s->save();

                }

            }

        }


        $customers = Customer::OrderBy('name')->get();
        $shiptos = ShipTo::orderBy('shipto')->get();

        $data['customers'] = $customers;
        $data['contacts'] = Contact::orderBy('name')->get();
        $data['shiptos'] = $shiptos;

        return response()->json( $data, 200, [], JSON_NUMERIC_CHECK );

    }

    public function saveCustomer( Request $request ) {

        $customer = new Customer;

        $customer->name = $request->get('name');

        $customer->save();

        $customers = Customer::OrderBy('name')->get();

        if ( $request->has('contacts') ) {

            $contacts = $request->get('contacts');

            foreach( $contacts as $c ) {

                $name = $c['name'];

                if ( strlen($name) > 0 ) {

                    $contact = new Contact;

                    $contact->customer_id = $customer->id;
                    $contact->name = $c['name'];
                    $contact->phone = $c['phone'];
                    $contact->phone_ext = $c['phone_ext'];
                    $contact->email = $c['email'];
                    $contact->mobile = $c['mobile'];
                    $contact->fax = $c['fax'];

                    $contact->save();

                }

            }

        }

        if ( $request->has('shiptos') ) {

            $shiptos = $request->get('shiptos');

            foreach($shiptos as $shipto) {

                if (strlen($shipto['shipto']) > 0 ) {

                    $c = new ShipTo;

                    $c->shipto = $shipto['shipto'];
                    $c->address1 = $shipto['address1'];
                    $c->address2 = $shipto['address2'];
                    $c->city = $shipto['city'];
                    $c->state = $shipto['state'];
                    $c->zip = $shipto['zip'];
                    $c->attn = $shipto['attn'];
                    $c->phone = $shipto['phone'];
                    $c->customer_id = $customer->id;

                    $c->save();

                }
            }

        }

        $data['customers'] = $customers;
        $data['contacts'] = Contact::orderBy('name')->get();
        $data['shiptos'] = ShipTo::orderBy('shipto')->get();


        return response()->json( $data, 200, [], JSON_NUMERIC_CHECK );

    }

    public function delete( Request $request ) {

        $customer = Customer::find( $request->get('id') );

        foreach( $customer->contacts as $co )  {

            $co->delete();

        }

        $customer->delete();

        return response()->json(['success' => 1], 200, [], JSON_NUMERIC_CHECK);

    }
}
