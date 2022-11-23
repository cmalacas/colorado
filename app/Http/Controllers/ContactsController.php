<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contact;

class ContactsController extends Controller
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
        $contact = new Contact;

        $contact->name = $request->get('name');
        $contact->email = $request->get('email');
        $contact->phone = $request->get('phone');
        $contact->phone_ext = $request->get('phone_ext');
        $contact->fax = $request->get('fax');
        $contact->mobile = $request->get('mobile');
        $contact->customer_id = $request->get('customer_id');

        $contact->save();

        $contacts = Contact::orderBy('name')->get();

        return response()->json( ['contacts' => $contacts ], 200, [], JSON_NUMERIC_CHECK );
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
    public function update(Request $request)
    {
        $id = $request->get('id');

        $contact = Contact::find( $id );

        $contact->name = $request->get('name');
        $contact->email = $request->get('email');
        $contact->phone = $request->get('phone');
        $contact->phone_ext = $request->get('phone_ext');
        $contact->fax = $request->get('fax');
        $contact->mobile = $request->get('mobile');

        $contact->save();

        $contacts = Contact::orderBy('name')->get();

        return response()->json( ['contacts' => $contacts ], 200, [], JSON_NUMERIC_CHECK );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete( Request $request )
    {
        $id = $request->get('id');

        $contact = Contact::find( $id );

        $contact->delete();

        $contacts = Contact::orderBy('name')->get();

        return response()->json( ['contacts' => $contacts ], 200, [], JSON_NUMERIC_CHECK );
    }
}
