<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Auth::routes();
Route::get('/', function() {
    return view('layouts.plane');  
});
Route::get('/home', function() {
    return view('layouts.plane');  
});

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/production-orders/{id}/print', 'ProductionOrders@print');
Route::get('/purchase-orders/{id}/print', 'PurchaseOrders@print');

Route::post('/production-orders/adddiagonal', 'ProductionOrders@addDiagonal');
Route::post('/production-orders/addmocatalog', 'ProductionOrders@addMoCatalog');
Route::post('/production-orders/addmobooklet', 'ProductionOrders@addMoBooklet');
Route::post('/production-orders/addsideseam', 'ProductionOrders@addSideSeam');

Route::get('/view-schedules', function() {
    return view('layouts.plane');  
});

Route::post('/production-orders/getcontacts', 'ProductionOrders@getContacts');

Route::post('/production-orders/getshipto', 'ProductionOrders@getShipTo');

Route::get('/production-orders/{id}/packing', 'ProductionOrders@getPackings');

Route::get('/production-orders/{id}/copy', 'ProductionOrders@copy');

Route::get('/production-orders/reset', 'ProductionOrders@reset');

Route::get('/customers/{id}/hide', 'CustomersController@hide');

Route::get('/double-die/show-all',  'DoubleDiesController@show_all');

Route::get('/production-orders/search', 'ProductionOrders@search');

Route::get('/customers/gets', 'CustomersController@gets');

Route::get('/packing/{id}/print', 'PackingController@print');
Route::post('/packing/sent', 'PackingController@sent');

Route::get('/purchase-orders/{n}/copy', 'PurchaseOrders@copy');

Route::get('/purchase-orders/search/{keywords}/{field}/{match}', 'PurchaseOrders@search');


Route::get('/jet-schedule/3inch1', 'JetSchedulesController@inch31');
Route::get('/jet-schedule/3inch2', 'JetSchedulesController@inch32');
Route::get('/jet-schedule/3inch3', 'JetSchedulesController@inch33');
Route::get('/jet-schedule/3inch4', 'JetSchedulesController@inch34');
Route::get('/jet-schedule/super-jet', 'JetSchedulesController@superJet');


Route::post('/get-contacts', 'CustomersController@getContacts');

Route::get('/latex-ps/schduled', 'LatexPsSchedulesController@index');





Route::get('/production-orders/{id}/info', 'ProductionOrders@getInfo');

Route::get('/not-invoiced', 'ProductionOrders@notInvoiced');
Route::get('/invoiced', 'ProductionOrders@invoiced');



Route::post('/production-orders/save-schedule', 'ProductionOrders@saveSchedule');
Route::post('/production-orders/save-schedule-ajax','ProductionOrders@saveScheduleAjax');



Route::resource('production-orders-search', 'ProductionOrdersSearchController');
Route::resource('/production-orders', 'ProductionOrders');

//Route::resource('/purchase-orders', 'PurchaseOrders');


Route::resource('customers', 'CustomersController');
Route::resource('double-die', 'DoubleDiesController');
Route::resource('packing', 'PackingController');

Route::resource('general-order-info', 'GeneralOrderInfoController');

Route::get('/tables', 'TablesController@index');

Route::post('/get-out-diagonals', 'TablesController@outDiagonals');
Route::post('/save-out-diagonals', 'TablesController@saveOutDiagonals');
Route::post('/delete-out-diagonal', 'TablesController@deleteOutDiagonal');
Route::post('/add-out-diagonal', 'TablesController@addOutDiagonal');

Route::post('/get-out-mo-booklet', 'TablesController@outMoBooklet');
Route::post('/save-out-mo-booklet', 'TablesController@saveOutMoBooklet');
Route::post('/delete-out-mo-booklet', 'TablesController@deleteOutMoBooklet');
Route::post('/add-out-mo-booklet', 'TablesController@addOutMoBooklet');

Route::post('/get-out-mo-catalog', 'TablesController@outMoCatalog');
Route::post('/save-out-mo-catalog', 'TablesController@saveOutMoCatalog');
Route::post('/delete-out-mo-catalog', 'TablesController@deleteOutMoCatalog');
Route::post('/add-out-mo-catalog', 'TablesController@addOutMoCatalog');

Route::post('/get-side-seam', 'TablesController@outSideSeam');
Route::post('/save-side-seam', 'TablesController@saveSideSeam');
Route::post('/delete-side-seam', 'TablesController@deleteSideSeam');
Route::post('/add-side-seam', 'TablesController@addSideSeam');

Route::get('/purchase-orders', 'PurchaseOrders@index');

Route::post('/get-adjustable', 'AdjustableController@get');
Route::post('/add-adjustable', 'AdjustableController@add');
Route::post('/save-adjustable', 'AdjustableController@save');
Route::post('/delete-adjustable', 'AdjustableController@delete');

Route::post('/get-web-ra', 'WebRaController@get');
Route::post('/add-web-ra', 'WebRaController@add');
Route::post('/save-web-ra', 'WebRaController@save');
Route::post('/delete-web-ra', 'WebRaController@delete');

Route::post('/get-documents', 'ProductionOrders@getDocuments');

Route::post('/documents/{id}/upload', 'ProductionOrders@upload');

Route::post('/delete-document', 'ProductionOrders@deleteDocument');

Route::post('/delete-customer', 'CustomersController@delete');

Route::get('/tables/out-diagonals', function() {
    return view('layouts.plane');  
});

Route::get('/tables/adjustable', function() {
    return view('layouts.plane');  
});

Route::get('/tables/web-ra', function() {
    return view('layouts.plane');  
});


Route::get('/tables/out-mo-booklet', function() {
    return view('layouts.plane');  
});

Route::get('/tables/out-mo-catalog', function() {
    return view('layouts.plane');  
});

Route::get('/tables/out-side-seam', function() {
    return view('layouts.plane');  
});

Route::get('/tables/machines', function() {
    return view('layouts.plane');  
});

Route::get('/tables/locations', function() {
    return view('layouts.plane');  
});

Route::get('/folding-schedule/unscheduled', function() {
    return view('layouts.plane');  
});

Route::get('/latex-ps/unscheduled', function() {
    return view('layouts.plane');  
});

Route::get('/jet-schedule/unscheduled', function() {
    return view('layouts.plane');  
});

Route::get('/straightknife/unscheduled', function() {
    return view('layouts.plane');  
});

Route::resource('folding-schedule', 'FoldingSchedulesController');
Route::resource('jet-schedule', 'JetSchedulesController');
Route::resource('latex-ps', 'LatexPsSchedulesController');

//Route::resource('straightknife', 'StraightKnifeController');

Route::get('/folding-schedule/mo', 'FoldingSchedulesController@mo');
Route::get('/folding-schedule/mow', 'FoldingSchedulesController@mow');
Route::get('/folding-schedule/ra-1', 'FoldingSchedulesController@ra1');
Route::get('/folding-schedule/ra-2', 'FoldingSchedulesController@ra2');
Route::get('/folding-schedule/ra-3', 'FoldingSchedulesController@ra3');
Route::get('/folding-schedule/so', 'FoldingSchedulesController@so');
Route::get('/folding-schedule/wr-1', 'FoldingSchedulesController@wr1');

Route::get('/folding-schedule/wr-2', 'FoldingSchedulesController@wr2');
Route::get('/folding-schedule/wr-3', 'FoldingSchedulesController@wr3');

Route::get('/folding-schedule/{id}', function() {
    return view('layouts.plane');  
});

Route::post('/tables/add-location', 'TablesController@addLocation');
Route::post('/tables/update-location', 'TablesController@updateLocation');
Route::post('/tables/delete-location', 'TablesController@deleteLocation');

Route::post('/tables/add-routing', 'TablesController@addRouting');
Route::post('/tables/update-routing', 'TablesController@updateRouting');
Route::post('/tables/delete-routing', 'TablesController@deleteRouting');

Route::post('/tables/add-gum', 'TablesController@addGum');
Route::post('/tables/update-gum', 'TablesController@updateGum');
Route::post('/tables/delete-gum', 'TablesController@deleteGum');

Route::post('/tables/add-description', 'TablesController@addDescription');
Route::post('/tables/update-description', 'TablesController@updateDescription');
Route::post('/tables/delete-description', 'TablesController@deleteDescription');

Route::post('/tables/add-seal', 'TablesController@addSeal');
Route::post('/tables/update-seal', 'TablesController@updateSeal');
Route::post('/tables/delete-seal', 'TablesController@deleteSeal');

Route::post('/tables/add-tint', 'TablesController@addTint');
Route::post('/tables/update-tint', 'TablesController@updateTint');
Route::post('/tables/delete-tint', 'TablesController@deleteTint');

Route::post('/tables/add-sides', 'TablesController@addSides');
Route::post('/tables/update-sides', 'TablesController@updateSides');
Route::post('/tables/delete-sides', 'TablesController@deleteSides');

Route::post('/tables/add-ctn-size', 'TablesController@addCtnSize');
Route::post('/tables/update-ctn-size', 'TablesController@updateCtnSize');
Route::post('/tables/delete-ctn-size', 'TablesController@deleteCtnSize');

Route::post('/tables/add-stock', 'TablesController@addStock');
Route::post('/tables/update-stock', 'TablesController@updateStock');
Route::post('/tables/delete-stock', 'TablesController@deleteStock');

Route::post('/tables/add-printing', 'TablesController@addPrinting');
Route::post('/tables/update-printing', 'TablesController@updatePrinting');
Route::post('/tables/delete-printing', 'TablesController@deletePrinting');

Route::post('/tables/get-machines', 'TablesController@getMachines');

Route::post('/tables/add-machine', 'TablesController@addMachine');
Route::post('/tables/delete-machine', 'TablesController@deleteMachine');
Route::post('/tables/save-machine', 'TablesController@saveMachine');

Route::post('/tables/add-machine-category', 'TablesController@addMachineCategory');
Route::post('/tables/delete-machine-category', 'TablesController@deleteMachineCategory');
Route::post('/tables/save-machine-category', 'TablesController@saveMachineCategory');

Route::post('/get-sidebar', 'TablesController@sidebar');

Route::post('/tables/get-locations', 'TablesController@getLocations');
Route::post('/tables/add-location', 'TablesController@addLocation');
Route::post('/tables/save-location', 'TablesController@saveLocation');
Route::post('/tables/delete-location', 'TablesController@deleteLocation');

Route::post('/get-folding-unscheduled', 'FoldingSchedulesController@unscheduled');
Route::post('/get-latex-unscheduled', 'LatexPsSchedulesController@unscheduled');
Route::post('/get-jet-unscheduled', 'JetSchedulesController@unscheduled');
Route::post('/get-straight-knife-unscheduled', 'StraightKnifeController@unscheduled');

Route::post('/tables/add-schedule', 'TablesController@addSchedule');
Route::post('/tables/update-schedule', 'TablesController@updateSchedule');
Route::post('/tables/delete-schedule', 'TablesController@deleteSchedule');

Route::post('/tables/add-jet-status', 'TablesController@addJetStatus');
Route::post('/tables/update-jet-status', 'TablesController@updateJetStatus');
Route::post('/tables/delete-jet-status', 'TablesController@deleteJetStatus');

Route::post('/tables/add-jet-stock', 'TablesController@addJetStock');
Route::post('/tables/update-jet-stock', 'TablesController@updateJetStock');
Route::post('/tables/delete-jet-stock', 'TablesController@deleteJetStock');

Route::post('/tables/add-window-film', 'TablesController@addWindowFilm');
Route::post('/tables/delete-window-film', 'TablesController@deleteWindowFilm');
Route::post('/tables/save-window-film', 'TablesController@saveWindowFilm');
Route::post('/tables/update-window-film', 'TablesController@updateWindowFilm');

Route::post('/tables/ship-to', 'TablesController@updateShipTo');

Route::post('/tables/add-window-size', 'TablesController@addWindowSize');
Route::post('/tables/delete-window-size', 'TablesController@deleteWindowSize');
Route::post('/tables/save-window-size', 'TablesController@saveWindowSize');
Route::post('/tables/update-window-size', 'TablesController@updateWindowSize');

Route::post('/save-folding-schedule', 'FoldingSchedulesController@save');
Route::post('/save-jet-schedule', 'JetSchedulesController@save');
Route::post('/save-latex-ps-schedule', 'LatexPsSchedulesController@save');
Route::post('/save-straight-knife-schedule', 'StraightKnifeController@save');

Route::post('/get-folding-schedule-data', 'FoldingSchedulesController@get');

Route::post('/get-purchase-orders-data', 'PurchaseOrders@getData');

Route::post('/save-purchase-orders', 'PurchaseOrders@save');

Route::post('/update-purchase-orders', 'PurchaseOrders@update');

Route::post('/update-contact', 'ContactsController@update');

Route::post('/add-contact', 'ContactsController@store');

Route::post('/delete-contact', 'ContactsController@delete');

Route::post('/copy-purchase-order', 'PurchaseOrders@copy');

Route::post('/purchase-orders/delete', 'PurchaseOrders@delete');

Route::post('/get-straight-knife-data', 'StraightKnifeController@get');

Route::get('/folding-schedule/{id}/print', 'FoldingSchedulesController@doPrint');

Route::post('/get-view-schedules-data', 'ProductionOrders@getViewSchedulesData');

Route::post('/get-customer-data', 'CustomersController@getData');

Route::post('/update-customer', 'CustomersController@updateCustomer');
Route::post('/save-customer', 'CustomersController@saveCustomer');

Route::post('/get-vendors', 'VendorController@gets');
Route::post('/update-vendor', 'VendorController@update');
Route::post('/save-vendor', 'VendorController@save');
Route::post('/delete-vendor', 'VendorController@delete');
Route::post('/update-vendor-contact', 'VendorContactController@update');
Route::post('/add-vendor-contact', 'VendorContactController@save');
Route::post('/delete-vendor-contact', 'VendorContactController@delete');

Route::post('/purchase-orders/{id}/upload', 'PurchaseOrders@upload');

Route::post('/delete-purchase-order-document', 'PurchaseOrders@deleteDocument');

Route::post('/send-purchase-order-email', 'PurchaseOrders@send');

Route::get('/not-entered', 'PurchaseOrders@notEntered');

Route::post('/get-dashboard-data', 'ProductionOrders@dashboard');

Route::get('/straightknife', function() {
    return view('layouts.plane');  
});

Route::get('/purchase-orders/create', function() {

    return view('layouts.plane');

});

Route::get('/purchase-orders/{id}/edit', function() {

    return view('layouts.plane');

});

Route::get('/open-schedule/{id}', function() {

    return view('schedule');

});

Route::get('/customers-list', function() {

    return view('layouts.plane');

});

Route::get('/vendors', function() {

    return view('layouts.plane');

});
