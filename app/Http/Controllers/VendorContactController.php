<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\VendorContact;

class VendorContactController extends Controller
{
    public function save( Request $request ) {

        $vendor = new VendorContact;

        $vendor->vendor_id = $request->get('vendor_id');

        $vendor->name = $request->get('name');
        $vendor->email = $request->get('email');
        $vendor->phone = $request->get('phone');
        $vendor->phone_ext = $request->get('phone_ext');
        $vendor->fax = $request->get('fax');
        $vendor->email = $request->get('email');
        $vendor->mobile = $request->get('mobile');

        $vendor->save();

        $contacts = VendorContact::orderBy('name')->get();

        $data['contacts'] = $contacts;

        return response()->json( $data, 200, [], JSON_NUMERIC_CHECK );

    }

    public function update( Request $request ) {

        $vendor = VendorContact::find( $request->get('id') );

        $vendor->name = $request->get('name');
        $vendor->email = $request->get('email');
        $vendor->phone = $request->get('phone');
        $vendor->phone_ext = $request->get('phone_ext');
        $vendor->fax = $request->get('fax');
        $vendor->email = $request->get('email');
        $vendor->mobile = $request->get('mobile');

        $vendor->save();

        $contacts = VendorContact::orderBy('name')->get();

        $data['contacts'] = $contacts;

        return response()->json( $data, 200, [], JSON_NUMERIC_CHECK );

    }

    public function delete( Request $request ) {

        $vendor = VendorContact::find( $request->get('id') );

        $vendor->delete();

        $contacts = VendorContact::orderBy('name')->get();

        $data['contacts'] = $contacts;

        return response()->json( $data, 200, [], JSON_NUMERIC_CHECK );

    }
}
