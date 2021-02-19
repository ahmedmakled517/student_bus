<?php



Route::get('/', function () {
    return view('welcome');
});

    Route::prefix('dashboard')->name('dashboard.')->group(function () {

         Route::get('index', 'Dashboard\DashboardController@index')->name('index');

         //untie routes
         Route::resource('unites', 'Dashboard\UnitesController');

         //store routes
         Route::resource('stores', 'Dashboard\StoreController');

         
        //client routes
        Route::resource('clients', 'Dashboard\ClientController');
        // Route::resource('clients.orders', 'Client\OrderController')->except(['show']);
        
        //items routes
          Route::resource('items', 'Dashboard\ItemController');

        // stock route
          Route::resource('stockes', 'Dashboard\StockController');
         //safe routes
         Route::resource('safes', 'Dashboard\SafeController');

        // //order routes
        // Route::resource('orders', 'OrderController');
        // Route::get('/orders/{order}/products', 'OrderController@products')->name('orders.products');


         //selles routes
         Route::get('selles', 'Dashboard\SallesController@index')->name('selles');
         Route::get('get_report', 'Dashboard\SallesController@get_report')->name('get_report');
         Route::get('get_tottal', 'Dashboard\SallesController@get_tottal')->name('get_tottal');
         Route::get('get_price', 'Dashboard\SallesController@get_price')->name('get_price');
         Route::get('get_item', 'Dashboard\SallesController@get_item')->name('get_item');
         Route::get('get_unite', 'Dashboard\SallesController@get_unite')->name('get_unite');
         Route::post('save_data', 'Dashboard\SallesController@save_data')->name('save_data');
         Route::post('save_data_head', 'Dashboard\SallesController@save_data_head')->name('save_data_head');
         Route::get('bill_heades_index', 'Dashboard\SallesController@bill_heades_index')->name('bill_heades_index');
         Route::get('bill_details/{id}', 'Dashboard\SallesController@bill_details')->name('bill_details');
        // client account stamp
        Route::get('client_acount_index', 'Dashboard\Clien_AcountController@index')->name('client_acount_index');
        Route::get('client_acount_get', 'Dashboard\Clien_AcountController@get_report')->name('client_acount_get');
        // safe stamp
        Route::get('safe_index', 'Dashboard\Safe_StampController@safe_index')->name('safe_index');
        Route::get('safe_stamp_get', 'Dashboard\Safe_StampController@get_report')->name('safe_stamp_get');
        // back
        Route::get('back', 'Dashboard\BackController@index')->name('back');
        Route::get('back_get', 'Dashboard\BackController@get_data_head')->name('back_get');
        Route::post('back_save_data', 'Dashboard\BackController@save_data')->name('back_save_data');
        Route::get('back_details/{id}', 'Dashboard\BackController@back_details')->name('back_details');

    });