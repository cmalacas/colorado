<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Adjustable;

use DB;

class AdjustableController extends Controller
{
    public function get() {

        $adjustables = Adjustable::orderBy(DB::raw('REPLACE(die_size, " ", "")'), 'asc')
                            ->orderBy('sheet_size', 'asc')
                            ->orderBy('number_out', 'asc')
                            ->get();

        $data['adjustables'] = $adjustables;

        return response()->json( $data, 200, [], JSON_NUMERIC_CHECK );

    }

    public function add( Request $request ) {

        $a = new Adjustable;

        $a->die_size = $request->get('die_size');
        $a->sheet_size = $request->get('sheet_size');
        $a->number_out = $request->get('number_out');
        $a->die_number = $request->get('die_number');
        $a->flat_size = $request->get('flat_size');
        $a->seal_flap_size = $request->get('seal_flap_size');

        $a->save();

        $lists = Adjustable::get();

        $data['adjustables'] = $lists;

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);

    }

    public function save( Request $request ) {

        $a = Adjustable::find( $request->get('id') );

        $a->die_size = $request->get('die_size');
        $a->sheet_size = $request->get('sheet_size');
        $a->number_out = $request->get('number_out');
        $a->die_number = $request->get('die_number');
        $a->flat_size = $request->get('flat_size');
        $a->seal_flap_size = $request->get('seal_flap_size');

        $a->save();

        $lists = Adjustable::get();

        $data['adjustables'] = $lists;

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);

    }

    public function delete( Request $request ) {

        $a = Adjustable::find( $request->get('id') );

        $a->delete();

        $lists = Adjustable::get();

        $data['adjustables'] = $lists;

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);

    }
}
