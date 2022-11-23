<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\WebRa;

class WebRaController extends Controller
{
    public function get() {

        $webs = WebRa::get();

        $data['webs'] = $webs;

        return response()->json( $data, 200, [], JSON_NUMERIC_CHECK );

    }

    public function add( Request $request ) {

        $a = new WebRa;

        $a->die_size = $request->get('die_size');
        $a->sheet_size = $request->get('sheet_size');
        $a->number_out = $request->get('number_out');
        $a->die_number = $request->get('die_number');
        $a->flat_size = $request->get('flat_size');
        $a->seal_flap_size = $request->get('seal_flap_size');

        $a->save();

        $lists = WebRa::get();

        $data['webs'] = $lists;

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);

    }

    public function save( Request $request ) {

        $a = WebRa::find( $request->get('id') );

        $a->die_size = $request->get('die_size');
        $a->sheet_size = $request->get('sheet_size');
        $a->number_out = $request->get('number_out');
        $a->die_number = $request->get('die_number');
        $a->flat_size = $request->get('flat_size');
        $a->seal_flap_size = $request->get('seal_flap_size');

        $a->save();

        $lists = WebRa::get();

        $data['webs'] = $lists;

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);

    }

    public function delete( Request $request ) {

        $a = WebRa::find( $request->get('id') );

        $a->delete();

        $lists = WebRa::get();

        $data['webs'] = $lists;

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);

    }
}
