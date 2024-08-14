<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Home'], function () {
    Route::get('/', 'HomeController@index')->name('home');
});


Route::group(['namespace' => 'Auth', 'middleware' => 'guest'], function () {
    Route::get('/register', 'RegisterController@index')->name('register.index');
    Route::post('/register', 'RegisterController@register')->name('register');

    Route::get('/login', 'LoginController@index')->name('login.index');
    Route::post('/login', 'LoginController@login')->name('login');
    Route::post('/logout', 'LoginController@logout')->name('logout');
});
Route::group(['namespace' => 'Auth', 'middleware' => 'auth'], function () {
    Route::post('/logout', 'LoginController@logout')->name('logout');
});

Route::group(['namespace' => 'Home', 'middleware' => 'auth', 'prefix' => 'user'], function () {
    // Route::get('/booking', 'BookingController@index')->name('booking');
    // Route::get('/get-price', 'BookingController@getPrice')->name('getPrice');
    // Route::post('/booking', 'BookingController@store')->name('booking.store');

    Route::get('/booking', 'PesanController@index')->name('pesan.index');
    Route::post('/booking/search', 'PesanController@search')->name('pesan.search');
    Route::post('/booking/store', 'PesanController@store')->name('pesan.store');
    Route::get('/booking/form/{id}', 'PesanController@form')->name('pesan.form');
    Route::post('/booking/save', 'PesanController@save')->name('pesan.save');
    Route::get('/price/{type}/{id]', 'PesanController@getPrice')->name('pesan.getPrice');

    Route::get('/pesan/form/penumpang/{id}', 'PesanController@formPenumpang')->name('pesan.form.penumpang');
    Route::get('/pesan/form/kendaraan/{id}', 'PesanController@formKendaraan')->name('pesan.form.kendaraan');
    Route::get('/pesan/form/both/{id}', 'PesanController@formBoth')->name('pesan.form.both');

    // Rute untuk menyimpan data penumpang
    Route::post('/pesan/store/penumpang/{id}', 'PesanController@storePenumpang')->name('pesan.store.penumpang');

    // Rute untuk menyimpan data kendaraan
    Route::post('/pesan/store/kendaraan/{id}', 'PesanController@storeKendaraan')->name('pesan.store.kendaraan');

    // Rute untuk menyimpan data penumpang dan kendaraan
    Route::post('/pesan/store/both/{id}', 'PesanController@storeBoth')->name('pesan.store.both');


    Route::get('/payment/create/{id}', 'PaymentController@index')->name('payment.index');
    Route::get('/payment/process/{id}', 'PaymentController@payment')->name('payment.payment');
    Route::post('/payment/process', 'PaymentController@process')->name('payment.process');

    Route::get('/booking/history', 'PesanController@history')->name('pesan.history');
    Route::get('/booking/history/{id}', 'PesanController@show')->name('pesan.show');
    Route::get('/print/tiket/{id}', 'PesanController@printTicket')->name('tiket.print');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'manage', 'middleware' => 'role'], function () {
    // controller dashboard
    Route::get('/admin', 'HomeController@index')->name('dashboard');

    // controller rute
    Route::get('/route', 'RouteController@index')->name('route.index');
    Route::post('/route', 'RouteController@store')->name('route.store');
    Route::get('/route/create', 'RouteController@create')->name('route.create');
    Route::get('/route/{id}/edit', 'RouteController@edit')->name('route.edit');
    Route::put('/route/{id}/update', 'RouteController@update')->name('route.update');
    Route::delete('/route/dell/{id}', 'RouteController@destroy')->name('route.dell');

    // controller transport
    Route::get('/transport', 'TransportController@index')->name('transport.index');
    Route::get('/transport/create', 'TransportController@create')->name('transport.create');
    Route::post('/transport/store', 'TransportController@store')->name('transport.store');
    Route::get('/transport/{id}/edit', 'TransportController@edit')->name('transport.edit');
    Route::put('/transport/{id}/update', 'TransportController@update')->name('transport.update');
    Route::delete('/transport/{id}/dell', 'TransportController@destroy')->name('transport.dell');

    //controller bank
    Route::get('/bank', 'BankController@index')->name('bank.index');
    Route::get('/bank/create', 'BankController@create')->name('bank.create');
    Route::post('/bank/store', 'BankController@store')->name('bank.store');
    Route::get('/bank/{id}/edit', 'BankController@edit')->name('bank.edit');
    Route::put('/bank/{id}/update', 'BankController@update')->name('bank.update');
    Route::delete('/bank/dell/{id}', 'BankController@destroy')->name('bank.dell');


    Route::get('/kendaraan', 'KendaraanController@index')->name('kendaraan.index');
    Route::get('/kendaraan/create', 'KendaraanController@create')->name('kendaraan.create');
    Route::post('/kendaraan/store', 'KendaraanController@store')->name('kendaraan.store');
    Route::get('/kendaraan/{id}/edit', 'KendaraanController@edit')->name('kendaraan.edit');
    Route::put('/kendaraan/{id}/update', 'KendaraanController@update')->name('kendaraan.update');
    Route::delete('/kendaraan/dell/{id}', 'KendaraanController@destroy')->name('kendaraan.dell');

    Route::get('/penumpang', 'PenumpangController@index')->name('penumpang.index');
    Route::get('/penumpang/create', 'PenumpangController@create')->name('penumpang.create');
    Route::post('/penumpang/store', 'PenumpangController@store')->name('penumpang.store');
    Route::get('/penumpang/{id}/edit', 'PenumpangController@edit')->name('penumpang.edit');
    Route::put('/penumpang/{id}/update', 'PenumpangController@update')->name('penumpang.update');
    Route::delete('/penumpang/{id}/dell', 'PenumpangController@destroy')->name('penumpang.dell');

    Route::get('/tiket', 'TiketController@index')->name('tiket.index');
    Route::get('/tiket/create', 'TiketController@create')->name('tiket.create');
    Route::post('/tiket/store', 'TiketController@store')->name('tiket.store');
    Route::get('/tiket/{id}/edit', 'TiketController@edit')->name('tiket.edit');
    Route::put('/tiket/{id}/update', 'TiketController@update')->name('tiket.update');
    Route::delete('/tiket/{id}/dell', 'TiketController@destroy')->name('tiket.dell');


    //controller bookings
    Route::get('/pemesanan', 'PemesananController@index')->name('pemesanan.index');
    Route::put('/pemesanan/{id}/status', 'PemesananController@updateStatus')->name('pemesanan.updateStatus');
    Route::delete('/pemesanan/{id}/dell', 'PemesananController@destroy')->name('pemesanan.delete');
});
// sudah jadi