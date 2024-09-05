<?php

use App\Http\Controllers\SalesReportController;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test-role', function () {
    return Auth::user() ? Auth::user()->role : 'No user authenticated';
})->middleware('role:admin');

// Admin routes (Admin can manage everything)
// Route::middleware(['role:admin'])->group(function () {
    // Menu routes
    Route::resource('menus', 'MenuController');

    // Meja routes
    Route::resource('mejas', 'MejaController');

    // Orders routes
    Route::resource('orders', 'OrderController');

    // Pembayaran routes
    Route::resource('pembayarans', 'PembayaranController');
// });

// Route::middleware(['role:staff'])->group(function () {
//     //meja
//     Route::get('/mejas', 'MejaController@index')->name('mejas.index');
//     Route::get('/mejas/{meja}/edit', 'MejaController@index')->name('mejas.edit');
//     Route::patch('/mejas/{meja}','MejaController@update')->name('mejas.update');

//     //menu
//     Route::get('/menus', 'MenuController@index')->name('menus.index');


//     //order
//     Route::get('/orders', 'OrderController@index')->name('orders.index');
//     Route::get('/orders/create', 'OrderController@create')->name('orders.create');
//     Route::post('/orders', 'OrderController@store')->name('orders.store');
//     Route::get('/orders/{order}/edit', 'OrderController@edit')->name('orders.edit');
//     Route::patch('/orders/{order}','OrderController@update')->name('orders.update');

//     //pembayaran
//     Route::get('/pembayarans', 'PembayaranController@index')->name('pembayarans.index');
//     Route::get('/pembayarans/create', 'PembayaranController@create')->name('pembayarans.create');
//     Route::post('/pembayarans', 'PembayaranController@store')->name('pembayarans.store');


// });
Route::get('/reports', [SalesReportController::class, 'index'])->name('reports.index');
Route::post('/reports/generate', [SalesReportController::class, 'generate'])->name('reports.generate');


Route::get('/forbidden', function () {
    return view('forbidden');
});
