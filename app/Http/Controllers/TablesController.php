<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Location;
use App\Machine;
use App\Gum;
use App\InsideTintStyle;
use App\Description;
use App\SealFlap;
use App\OptionPrint;
use App\ColoStock;
use App\BoxSize;
use App\CtnSize;

use App\OutDiagonal;
use App\OutMoBooklet;
use App\OutMoCatalog;
use App\OutSideSeam;
use App\MachineMaster;
use App\ScheduleStatus;
use App\JetStatus;
use App\JetStock;

use DB;

class TablesController extends Controller
{
    public function index() {

        $data = [
            'locations' => Location::orderBy('location')->get(),
            'machines' => Machine::get(),
            'gums' => Gum::get(),
            'descriptions' => Description::get(),
            'seals' => SealFlap::get(),
            'tints' => InsideTintStyle::get(),
            'prints' => OptionPrint::get(),
            'stocks' => ColoStock::get(),
            'boxes' => BoxSize::get(),
            'cartoons' => CtnSize::get(),
            'schedules' => ScheduleStatus::get(),
            'jets' => JetStatus::get(),
            'jet_stocks' => JetStock::get()
        ];

        return view('tables/main', $data);

    }

    /* LOCATION */

    public function addLocation( Request $request ) {

        $name = $request->get('location');

        $location = new Location;

        $location->location = $name;

        $location->save();


        $locations = Location::orderBy('location')->get();

        $data['locations'] = $locations;

        $data['table'] = view('tables.location-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);

    }

    public function updateLocation( Request $request ) {


        $location = Location::find( $request->get('id') );

        $location->location = $request->get('location');

        $location->save();


        $locations = Location::orderby('location')->get();

        $data['locations'] = $locations;

        $data['table'] = view('tables.location-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);


    }

    public function deleteLocation( Request $request ) {


        $location = Location::find( $request->get('id') );

        $location->delete();


        $locations = Location::get();

        $data['locations'] = $locations;

        $data['table'] = view('tables.location-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);


    }

    /* ROUTING */

    public function addRouting( Request $request ) {

        $name = $request->get('machine');

        $machine = new Machine;

        $machine->machine = $name;

        $machine->save();


        $machines = Machine::get();

        $data['machines'] = $machines;

        $data['table'] = view('tables.machine-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);

    }

    public function updateRouting( Request $request ) {


        $machine = Machine::find( $request->get('id') );

        $machine->machine = $request->get('machine');

        $machine->save();

        $machines = Machine::get();

        $data['machines'] = $machines;

        $data['table'] = view('tables.machine-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);


    }

    public function deleteRouting( Request $request ) {


        $machine = Machine::find( $request->get('id') );

        $machine->delete();

        $machines = Machine::get();

        $data['machines'] = $machines;

        $data['table'] = view('tables.machine-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);


    }

    /* GUM */

    public function addGum( Request $request ) {

        $name = $request->get('gum');

        $gum = new Gum;

        $gum->gum = $name;

        $gum->save();


        $gums = Gum::get();

        $data['gums'] = $gums;

        $data['table'] = view('tables.gum-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);

    }

    public function updateGum( Request $request ) {


        $gum = Gum::find( $request->get('id') );

        $gum->gum = $request->get('gum');

        $gum->save();


        $gums = Gum::get();

        $data['gums'] = $gums;

        $data['table'] = view('tables.gum-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);


    }

    public function deleteGum( Request $request ) {


        $gum = Gum::find( $request->get('id') );

        $gum->delete();


        $gums = Gum::get();

        $data['gums'] = $gums;

        $data['table'] = view('tables.gum-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);


    }

    /* DESCRIPTION */

    public function addDescription( Request $request ) {

        $name = $request->get('description');

        $description = new Description;

        $description->description = $name;

        $description->save();


        $descriptions = Description::get();

        $data['descriptions'] = $descriptions;

        $data['table'] = view('tables.description-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);

    }

    public function updateDescription( Request $request ) {


        $description = Description::find( $request->get('id') );

        $description->description = $request->get('description');

        $description->save();


        $descriptions = Description::get();

        $data['descriptions'] = $descriptions;

        $data['table'] = view('tables.description-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);


    }

    public function deleteDescription( Request $request ) {


        $description = Description::find( $request->get('id') );

        $description->delete();


        $descriptions = Description::get();

        $data['descriptions'] = $descriptions;

        $data['table'] = view('tables.description-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);


    }

    /* SEAL */

    public function addSeal( Request $request ) {

        $name = $request->get('sealFlap');

        $seal = new SealFlap;

        $seal->sealFlap = $name;

        $seal->save();


        $seals = SealFlap::get();

        $data['seals'] = $seals;

        $data['table'] = view('tables.seal-flap-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);

    }

    public function updateSeal( Request $request ) {


        $seal = SealFlap::find( $request->get('id') );

        $seal->sealFlap = $request->get('sealFlap');

        $seal->save();


        $seals = SealFlap::get();

        $data['seals'] = $seals;

        $data['table'] = view('tables.seal-flap-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);


    }

    public function deleteSeal( Request $request ) {


        $seal = SealFlap::find( $request->get('id') );

        $seal->delete();


        $seals = SealFlap::get();

        $data['seals'] = $seals;

        $data['table'] = view('tables.seal-flap-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);


    }

    /* TINT */

    public function addTint( Request $request ) {

        $name = $request->get('style');

        $style = new InsideTintStyle;

        $style->style = $name;

        $style->save();


        $tints = InsideTintStyle::get();

        $data['tints'] = $tints;

        $data['table'] = view('tables.inside-tint-style-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);

    }

    public function updateTint( Request $request ) {


        $style = InsideTintStyle::find( $request->get('id') );

        $style->style = $request->get('style');

        $style->save();


        $tints = InsideTintStyle::get();

        $data['tints'] = $tints;

        $data['table'] = view('tables.inside-tint-style-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);


    }

    public function deleteTint( Request $request ) {


        $style = InsideTintStyle::find( $request->get('id') );

        $style->delete();


        $tints = InsideTintStyle::get();

        $data['tints'] = $tints;

        $data['table'] = view('tables.inside-tint-style-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);


    }

    /* SIDES */

    public function addSides( Request $request ) {

        $name = $request->get('size');

        $box = new BoxSize;

        $box->size = $name;

        $box->save();


        $boxes = BoxSize::get();

        $data['boxes'] = $boxes;

        $data['table'] = view('tables.box-size-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);

    }

    public function updateSides( Request $request ) {


        $box = BoxSize::find( $request->get('id') );

        $box->size = $request->get('size');

        $box->save();


        $boxes = BoxSize::get();

        $data['boxes'] = $boxes;

        $data['table'] = view('tables.box-size-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);


    }

    public function deleteSides( Request $request ) {


        $box = BoxSize::find( $request->get('id') );

        $box->delete();


        $boxes = BoxSize::get();

        $data['boxes'] = $boxes;

        $data['table'] = view('tables.box-size-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);


    }

    /* CTN SIZE */

    public function addCtnSize( Request $request ) {

        $name = $request->get('size');

        $ctn = new CtnSize;

        $ctn->size = $name;

        $ctn->save();


        $cartoons = CtnSize::get();

        $data['cartoons'] = $cartoons;

        $data['table'] = view('tables.ctn-size-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);

    }

    public function updateCtnSize( Request $request ) {


        $ctn = CtnSize::find( $request->get('id') );

        $ctn->size = $request->get('size');

        $ctn->save();


        $cartoons = CtnSize::get();

        $data['cartoons'] = $cartoons;

        $data['table'] = view('tables.ctn-size-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);


    }

    public function deleteCtnSize( Request $request ) {


        $ctn = CtnSize::find( $request->get('id') );

        $ctn->delete();


        $cartoons = CtnSize::get();

        $data['cartoons'] = $cartoons;

        $data['table'] = view('tables.ctn-size-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);


    }

    /* STOCK */

    public function addStock( Request $request ) {

        $name = $request->get('size');

        $size = new ColoStock;

        $size->size = $name;

        $size->save();


        $stocks = ColoStock::get();

        $data['stocks'] = $stocks;

        $data['table'] = view('tables.stock-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);

    }

    public function updateStock( Request $request ) {


        $size = ColoStock::find( $request->get('id') );

        $size->size = $request->get('size');

        $size->save();


        $stocks = ColoStock::get();

        $data['stocks'] = $stocks;

        $data['table'] = view('tables.stock-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);


    }

    public function deleteStock( Request $request ) {


        $size = ColoStock::find( $request->get('id') );

        $size->delete();


        $stocks = ColoStock::get();

        $data['stocks'] = $stocks;

        $data['table'] = view('tables.stock-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);


    }

    /* PRINTING */

    public function addPrinting( Request $request ) {

        $name = $request->get('print');

        $print = new OptionPrint;

        $print->print = $name;

        $print->save();


        $prints = OptionPrint::get();

        $data['prints'] = $prints;

        $data['table'] = view('tables.printing-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);

    }

    public function updatePrinting( Request $request ) {


        $print = OptionPrint::find( $request->get('id') );

        $print->print = $request->get('print');

        $print->save();


        $prints = OptionPrint::get();

        $data['prints'] = $prints;

        $data['table'] = view('tables.printing-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);


    }

    public function deletePrinting( Request $request ) {


        $print = OptionPrint::find( $request->get('id') );

        $print->delete();


        $prints = OptionPrint::get();

        $data['prints'] = $prints;

        $data['table'] = view('tables.printing-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);


    }

    public function outDiagonals() {

        $lists = OutDiagonal::get();

        $data['outDiagonals'] = $lists;

        return response()->json($data);

    }

    public function saveOutDiagonals(Request $request)  {

        $out = OutDiagonal::find( $request->get('id') );

        $out->die_size = $request->get('die_size');
        $out->sheet_size = $request->get('sheet_size');
        $out->number_out = $request->get('number_out');
        $out->die_number = $request->get('die_number');
        $out->seal_flap_size = $request->get('seal_flap_size');

        $out->save();

        $lists = OutDiagonal::get();

        $data['outDiagonals'] = $lists;

        return response()->json($data);

    }

    public function addOutDiagonal(Request $request)  {

        $out = new OutDiagonal;

        $out->die_size = $request->get('die_size');
        $out->sheet_size = $request->get('sheet_size');
        $out->number_out = $request->get('number_out');
        $out->die_number = $request->get('die_number');
        $out->seal_flap_size = $request->get('seal_flap_size');

        $out->save();

        $lists = OutDiagonal::get();

        $data['outDiagonals'] = $lists;

        return response()->json($data);

    }

    public function deleteOutDiagonal(Request $request)  {

        $out = OutDiagonal::find( $request->get('id') );

        $out->delete();

        $lists = OutDiagonal::get();

        $data['outDiagonals'] = $lists;

        return response()->json($data);

    }

    public function outMoBooklet() {

        $lists = OutMoBooklet::get();

        $data['booklets'] = $lists;

        return response()->json( $data );

    }

    public function saveOutMoBooklet(Request $request)  {

        $out = OutMoBooklet::find( $request->get('id') );

        $out->die_size = $request->get('die_size');
        $out->sheet_size = $request->get('sheet_size');
        $out->number_out = $request->get('number_out');
        $out->die_number = $request->get('die_number');
        $out->flat_size = $request->get('flat_size');
        $out->seal_flap_size = $request->get('seal_flap_size');

        $out->save();

        $lists = OutMoBooklet::get();

        $data['booklets'] = $lists;

        return response()->json($data);

    }

    public function addOutMoBooklet(Request $request)  {

        $out = new OutMoBooklet;

        $out->die_size = $request->get('die_size');
        $out->sheet_size = $request->get('sheet_size');
        $out->number_out = $request->get('number_out');
        $out->die_number = $request->get('die_number');
        $out->flat_size = $request->get('flat_size');
        $out->seal_flap_size = $request->get('seal_flap_size');

        $out->save();

        $lists = OutMoBooklet::get();

        $data['booklets'] = $lists;

        return response()->json($data);

    }

    public function deleteOutMoBooklet(Request $request)  {

        $out = OutMoBooklet::find( $request->get('id') );

        $out->delete();

        $lists = OutMoBooklet::get();

        $data['booklets'] = $lists;

        return response()->json($data);

    }

    public function outMoCatalog() {

        $lists = OutMoCatalog::get();

        $data['catalogs'] = $lists;

        return response()->json($data);

    }

    public function saveOutMoCatalog(Request $request)  {

        $out = OutMoCatalog::find( $request->get('id') );

        $out->die_size = $request->get('die_size');
        $out->sheet_size = $request->get('sheet_size');
        $out->number_out = $request->get('number_out');
        $out->die_number = $request->get('die_number');
        $out->flat_size = $request->get('flat_size');
        $out->seal_flap_size = $request->get('seal_flap_size');

        $out->save();

        $lists = OutMoCatalog::get();

        $data['catalogs'] = $lists;

        return response()->json($data);

    }

    public function addOutMoCatalog(Request $request)  {

        $out = new OutMoCatalog;

        $out->die_size = $request->get('die_size');
        $out->sheet_size = $request->get('sheet_size');
        $out->number_out = $request->get('number_out');
        $out->die_number = $request->get('die_number');
        $out->flat_size = $request->get('flat_size');
        $out->seal_flap_size = $request->get('seal_flap_size');

        $out->save();

        $lists = OutMoCatalog::get();

        $data['catalogs'] = $lists;

        return response()->json($data);

    }

    public function deleteOutMoCatalog(Request $request)  {

        $out = OutMoCatalog::find( $request->get('id') );

        $out->delete();

        $lists = OutMoCatalog::get();

        $data['catalogs'] = $lists;

        return response()->json($data);

    }

    public function outSideSeam() {

        $lists = OutSideSeam::get();

        $data['sides'] = $lists;

        return response()->json($data);

    }

    public function saveSideSeam(Request $request)  {

        $out = OutSideSeam::find( $request->get('id') );

        $out->die_size = $request->get('die_size');
        $out->sheet_size = $request->get('sheet_size');
        $out->number_out = $request->get('number_out');
        $out->die_number = $request->get('die_number');
        $out->flat_size = $request->get('flat_size');
        $out->seal_flap_size = $request->get('seal_flap_size');

        $out->save();

        $lists = OutSideSeam::get();

        $data['sides'] = $lists;


        return response()->json($data);

    }

    public function addSideSeam(Request $request)  {

        $out = new OutSideSeam;

        $out->die_size = $request->get('die_size');
        $out->sheet_size = $request->get('sheet_size');
        $out->number_out = $request->get('number_out');
        $out->die_number = $request->get('die_number');
        $out->flat_size = $request->get('flat_size');
        $out->seal_flap_size = $request->get('seal_flap_size');

        $out->save();

        $lists = OutSideSeam::get();

        $data['sides'] = $lists;


        return response()->json($data);

    }

    public function deleteSideSeam(Request $request)  {

        $out = OutSideSeam::find( $request->get('id') );

        $out->delete();

        $lists = OutSideSeam::get();

        $data['sides'] = $lists;


        return response()->json($data);

    }

    public function getMachines(Request $request)  {

        $lists = MachineMaster::select('machine_masters.*', 
                        DB::raw('machines.machine as category_name'), 
                        DB::raw('IF( machine_masters.status = 1, "Enable", "Disable") as status_name')
                    )
                    ->leftJoin('machines', 'machines.id', 'machine_masters.category')
                    ->get();

        $categories = Machine::get();

        $data['machines'] = $lists;
        $data['categories'] = $categories;

        return response()->json($data);

    }

    public function addMachine(Request $request)  {

        $machine = new MachineMaster;

        $machine->machine = $request->get('machine');
        $machine->category = $request->get('category');
        $machine->status = $request->get('status');

        $machine->save();

        return $this->getMachines( $request );

    }

    public function deleteMachine(Request $request)  {

        $machine = MachineMaster::find( $request->get('id') );

        $machine->delete();

        return $this->getMachines( $request );

    }

    public function saveMachine(Request $request)  {

        $machine = MachineMaster::find( $request->get('id') );

        $machine->machine = $request->get('machine');
        $machine->category = $request->get('category');
        $machine->status = $request->get('status');

        $machine->save();

        return $this->getMachines( $request );

    }


    public function addMachineCategory(Request $request)  {

        $machine = new Machine;

        $machine->machine = $request->get('machine');
        $machine->routing = $request->get('routing');
        
        $machine->save();

        return $this->getMachines( $request );

    }

    public function saveMachineCategory(Request $request)  {

        $machine = Machine::find( $request->get('id') );

        $machine->machine = $request->get('machine');     
        $machine->routing = $request->get('routing');

        $machine->save();

        return $this->getMachines( $request );

    }

    public function deleteMachineCategory(Request $request)  {

        $machine = Machine::find( $request->get('id') );

        $machine->delete();

        return $this->getMachines( $request );

    }

    public function sidebar(Request $request) {

       

        $jet = MachineMaster::select(
                        DB::raw('machine_masters.*'),
                        DB::raw('machines.machine as machine_category')
                    )
                    ->join('machines', 'machines.id', '=', 'machine_masters.category')
                    ->orderBy(DB::raw('machine_masters.machine'))
                    ->where(DB::raw('machine_masters.status'), '=', 1)
                    ->where(DB::raw('machines.machine'), '=', 'Jet')
                    ->get();
        
        $ra = MachineMaster::select(
                        DB::raw('machine_masters.*'),
                        DB::raw('machines.machine as machine_category')
                    )
                    ->join('machines', 'machines.id', '=', 'machine_masters.category')
                    ->orderBy(DB::raw('machine_masters.machine'))
                    ->where(DB::raw('machine_masters.status'), '=', 1)
                    ->where(DB::raw('machines.machine'), '=', 'RA')
                    ->get();    
         
        $mo = MachineMaster::select(
                        DB::raw('machine_masters.*'),
                        DB::raw('machines.machine as machine_category')
                    )
                    ->join('machines', 'machines.id', '=', 'machine_masters.category')
                    ->orderBy(DB::raw('machine_masters.machine'))
                    ->where(DB::raw('machine_masters.status'), '=', 1)
                    ->whereRaw('(machines.machine = "MOW" OR machines.machine = "MO" OR machines.machine = "Latex / PS" )')
                    ->get();

        $wr = MachineMaster::select(
                        DB::raw('machine_masters.*'),
                        DB::raw('machines.machine as machine_category')
                    )
                    ->join('machines', 'machines.id', '=', 'machine_masters.category')
                    ->orderBy(DB::raw('machine_masters.machine'))
                    ->where(DB::raw('machine_masters.status'), '=', 1)
                    ->where(DB::raw('machines.machine'), '=', 'WR')
                    ->get();

        $data = [
            'jet' => $jet,
            'ra' => $ra,
            'mo' => $mo,
            'wr' => $wr,
            'sidebar' => 1
        ];

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);

    }   


    /* SCHEDULE STATUS */

    public function addSchedule( Request $request ) {

        $status = $request->get('status');

        $schedule = new ScheduleStatus;

        $schedule->status = $status;

        $schedule->save();


        $schedules = ScheduleStatus::get();

        $data['schedules'] = $schedules;

        $data['table'] = view('tables.schedule-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);

    }

    public function updateSchedule( Request $request ) {


        $schedule = ScheduleStatus::find( $request->get('id') );

        $schedule->status = $request->get('status');

        $schedule->save();


        $schedules = ScheduleStatus::get();

        $data['schedules'] = $schedules;

        $data['table'] = view('tables.schedule-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);


    }

    public function deleteSchedule( Request $request ) {


        $schedule = ScheduleStatus::find( $request->get('id') );

        $schedule->delete();


        $schedules = ScheduleStatus::get();

        $data['schedules'] = $schedules;

        $data['table'] = view('tables.schedule-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);


    }

    /* JET STATUS */

    public function addJetStatus( Request $request ) {

        $status = $request->get('status');

        $jet = new JetStatus;

        $jet->status = $status;

        $jet->save();


        $jets = JetStatus::get();

        $data['jets'] = $jets;

        $data['table'] = view('tables.jet-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);

    }

    public function updateJetStatus( Request $request ) {


        $jet = JetStatus::find( $request->get('id') );

        $jet->status = $request->get('status');

        $jet->save();


        $jets = JetStatus::get();

        $data['jets'] = $jets;

        $data['table'] = view('tables.jet-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);


    }

    public function deleteJetStatus( Request $request ) {


        $jet = JetStatus::find( $request->get('id') );

        $jet->delete();


        $jets = JetStatus::get();

        $data['jets'] = $jets;

        $data['table'] = view('tables.jet-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);


    }

    /* JET STOCK */

    public function addJetStock( Request $request ) {

        $stock = $request->get('stock');

        $jet = new JetStock;

        $jet->stock = $stock;

        $jet->save();


        $jet_stocks = JetStock::get();

        $data['jet_stocks'] = $jet_stocks;

        $data['table'] = view('tables.jet-stock-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);

    }

    public function updateJetStock( Request $request ) {


        $jet = JetStock::find( $request->get('id') );

        $jet->stock = $request->get('stock');

        $jet->save();


        $jet_stocks = JetStock::get();

        $data['jet_stocks'] = $jet_stocks;

        $data['table'] = view('tables.jet-stock-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);



    }

    public function deleteJetStock( Request $request ) {


        $jet = JetStock::find( $request->get('id') );

        $jet->delete();


        $jet_stocks = JetStock::get();

        $data['jet_stocks'] = $jet_stocks;

        $data['table'] = view('tables.jet-stock-data', $data)->render();

        return response()->json($data, 200, [], JSON_NUMERIC_CHECK);



    }
    
}
