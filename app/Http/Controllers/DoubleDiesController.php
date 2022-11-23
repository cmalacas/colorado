<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DoubleDie;

use DB;

class DoubleDiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['theads'] = ['#','No', 'Size 1', 'Size 2', 'Size 3', 'Position 1' ,'Position 2', 'Position 3', 'Envelope Size', 'Action'];

        $results = DoubleDie::select('double_dies.*', DB::RAW('WindowDoubleDie as no'))->where('status','=','Enabled')->orderBy('WindowDoubleDie', 'desc')->get();

        $data['tbody'] = [];

        foreach($results as $result) {
            $data['tbody'][] = [
                'no' => $result->no,
                'id' => sprintf("<a href='/double-die/%s/edit'>%s</a>", $result->id, $result->WindowDoubleDie),
                'size1' => $result->WindowSize1,
                'size2' => $result->WindowSize2,
                'size3' => $result->WindowSize3,
                'pos1' => $result->WindowPosition1,
                'pos2' => $result->WindowPosition2,
                'pos3' => $result->WindowPosition3,
                'envelope' => $result->EnvelopeSize,
                'Action' => sprintf("
                    <a data-action='edit' href='/double-die/%s/edit' class='btn btn-primary' title='Edit'><i class='fa fa-edit'></i></a>                     
                    <a href='/double-die/%s/delete' class='btn btn-danger' data-action='delete' title='Delete' data-id='%s'><i class='fa fa-trash'></i></a>", 
                    $result->id, $result->id, $result->id)
            ];
        }

        return view('double-dies.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['FORM'] = view('double-dies.form');

        return view('double-dies.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dd = new DoubleDie;

        $dd->WindowDoubleDie = $request->get('WindowDoubleDie');

        $dd->WindowSize1 = $request->get('WindowSize1');
        $dd->WindowSize2 = $request->get('WindowSize2');
        $dd->WindowSize3 = $request->get('WindowSize3');

        $dd->WindowPosition1 = $request->get('WindowPosition1');
        $dd->WindowPosition2 = $request->get('WindowPosition2');
        $dd->WindowPosition3 = $request->get('WindowPosition3');

        $dd->EnvelopeSize = $request->get('EnvelopeSize');

        $dd->status = $request->get('status');

        $dd->save();

        $id = $dd->id;

        return redirect('double-die/' . $id . '/edit')->with('message', 'Double Die succesfully added');
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
        $data['info'] = DoubleDie::find($id);

        $data['FORM'] = view('double-dies.form', $data)->render();

        return view('double-dies.edit', $data);
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
        $dd = DoubleDie::find($id);

        $dd->WindowDoubleDie = $request->get('WindowDoubleDie');

        $dd->WindowSize1 = $request->get('WindowSize1');
        $dd->WindowSize2 = $request->get('WindowSize2');
        $dd->WindowSize3 = $request->get('WindowSize3');

        $dd->WindowPosition1 = $request->get('WindowPosition1');
        $dd->WindowPosition2 = $request->get('WindowPosition2');
        $dd->WindowPosition3 = $request->get('WindowPosition3');

        $dd->EnvelopeSize = $request->get('EnvelopeSize');

        $dd->status = $request->get('status');

        $dd->save();

        return redirect('double-die/' . $id . '/edit')->with('message', 'Double Die succesfully saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DoubleDie::find($id)->delete();
    }

    public function show_all() {
        $data['theads'] = ['No', 'Size 1', 'Size 2', 'Size 3', 'Position 1' ,'Position 2', 'Position 3', 'Envelope Size', 'Action'];

        $results = DoubleDie::all();

        $data['tbody'] = [];

        foreach($results as $result) {
            $data['tbody'][] = [
                'id' => sprintf("<a href='/double-die/%s/edit'>%s</a>", $result->id, $result->WindowDoubleDie),
                'size1' => $result->WindowSize1,
                'size2' => $result->WindowSize2,
                'size3' => $result->WindowSize3,
                'pos1' => $result->WindowPosition1,
                'pos2' => $result->WindowPosition2,
                'pos3' => $result->WindowPosition3,
                'envelope' => $result->EnvelopeSize,
                'Action' => sprintf("
                    <a data-action='edit' href='/double-die/%s/edit' class='btn btn-primary' title='Edit'><i class='fa fa-pencil'></i></a>                     
                    <a href='/double-die/%s/delete' class='btn btn-danger' data-action='delete' title='Delete' data-id='%s'><i class='fa fa-trash'></i></a>", 
                    $result->id, $result->id, $result->id)
            ];
        }

        return view('double-dies.list', $data);
    }
}
