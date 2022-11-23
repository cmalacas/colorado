<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Vendor;
use App\VendorContact;

class VendorController extends Controller
{
    public function gets() {

        $vendors = Vendor::orderBy('vendor')->get();

        $contacts = VendorContact::orderBy('name')->get();

        $data['vendors'] = $vendors;
        $data['contacts'] = $contacts;

        return response()->json( $data, 200, [], JSON_NUMERIC_CHECK );

    }

    public function update( Request $request ) {

        $vendor = Vendor::find( $request->get('id') );

        $vendor->vendor = $request->get('vendor');
        $vendor->address = $request->get('address');

        $vendor->save();

        $vendors = Vendor::orderBy('vendor')->get();

        $data['vendors'] = $vendors;

        return response()->json( $data, 200, [], JSON_NUMERIC_CHECK );

    }

    public function save( Request $request ) {

        $vendor = new Vendor;

        $vendor->vendor = $request->get('vendor');
        $vendor->address = $request->get('address');

        $vendor->save();

        $vendors = Vendor::orderBy('vendor')->get();

        $data['vendors'] = $vendors;

        return response()->json( $data, 200, [], JSON_NUMERIC_CHECK );

    }

    public function delete( Request $request ) {

        $vendor = Vendor::find( $request->get('id') );

        foreach( $vendor->contacts as $v ) {

            $v->delete();

        }
        

        $vendor->delete();

        $vendors = Vendor::orderBy('vendor')->get();

        $data['vendors'] = $vendors;

        return response()->json( $data, 200, [], JSON_NUMERIC_CHECK );

    }
}
