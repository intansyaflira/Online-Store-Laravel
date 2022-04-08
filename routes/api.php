<?php
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: *');
// header('Access-Control-Allow-Headers: *');

use App\Http\Controllers\Customers2_TabelController;
use App\Http\Controllers\petugas_tabelController;
use App\Http\Controllers\product_TabelController;
use App\Http\Controllers\transaksi_TabelController;
use App\Http\Controllers\detail_order2_TabelController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user(); //fungsi middleware=untuk mengondisikan siapa yg login/ke validan user yg mengakses
});

Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');
Route::get('/getAuthUser', 'UserController@getAuthenticatedUser');

Route::group(['middleware' => ['jwt.verify']], function ()
{
    Route::group(['middleware' => ['api.superadmin']], function()
    {
        Route::delete('/customers2_tabel/{id}', 'Customers2_TabelController@destroy');
        Route::delete('/product_tabel/{id}', 'product_tabelController@destroy');
        Route::delete('/petugas/{id}', 'PetugasController@destroy');
        Route::delete('/transaksi/{id}', 'TransaksiController@destroy');
        Route::delete('/detail_transaksi/{id}', 'Detail_TransaksiController@destroy');
    });

    Route::group(['middleware'=> ['api.admin']], function()
    {
        Route::post('/customers2_tabel', 'Customers2_TabelController@store');
        Route::put('/customers2_tabel/{id}', 'Customers2_TabelController@update');

        Route::post('/product_tabel', 'product_tabelController@store');
        Route::put('/product_tabel/{id}', 'product_tabelController@update');

        Route::post('/transaksi_tabel', 'transaksi_tabelController@store');
        Route::put('/transaksi_tabel/{id}', 'transaksi_tabelController@update');

        Route::post('/detail_order2_tabel', 'detail_order2_tabelController@store');
        Route::put('/detail_order2_tabel/{id}', 'detail_order2_tabelController@update');
    });

    
    Route::get('/customers2_tabel', 'Customers2_TabelController@show');
    Route::get('/customers2_tabel/{id}', 'Customers2_TabelController@detail');

    Route::get('/product_tabel', 'product_tabelController@show');
    Route::get('/product_tabel/{id}', 'product_tabelController@detail');
    
    Route::get('/petugas', 'PetugasController@show');
    Route::get('/petugas/{id}', 'PetugasController@detail');
    
    Route::get('/transaksi_tabel', 'transaksi_tabelController@show');
    Route::get('/transaksi_tabel/{id}', 'transaksi_tabelController@detail');
  
    Route::get('/detail_order2_tabel', 'detail_order2_tabelController@show');
    Route::get('/detail_order2_tabel/{id}', 'detail_order2_tabelController@detail');
    
});
//customer
Route::get('/customers2_tabel', 'Customers2_TabelController@index');
Route::get('/customers2_tabel/{id}', 'Customers2_TabelController@detail');
Route::put('/editpelanggan/{id}', 'Customers2_TabelController@editpelanggan');
Route::post('/tambahpelanggan', 'Customers2_TabelController@simpan');
// Route::put('/customers2_tabel/{id}', 'customers2_tabelController@update');
Route::get('/getdetailpelanggan/{id}','Customers2_TabelController@getdetailpelanggan');
Route::delete('/hapuspelanggan/{id}','Customers2_TabelController@hapuspelanggan');

//produk
Route::get('/product_tabel', 'product_TabelController@index');
Route::get('/product_tabel/{id}', 'product_TabelController@cari_data');
Route::put('/editproduct/{id}', 'product_TabelController@editproduct');
Route::post('/product_tabel', 'product_TabelController@simpan');
// Route::put('/product_tabel/{id}', 'product_tabelController@update');
Route::get('/getdetailproduct/{id}','product_TabelController@getdetailproduct');
Route::delete('/hapusproduct/{id}','product_TabelController@hapusproduct');

