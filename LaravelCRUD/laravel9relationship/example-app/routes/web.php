<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartegoryController;


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

// Route::get('/', function () {
// $id= '12';
// $datas= DB::table('users')->get();

//     return view('welcome' ,compact('datas' , 'id'));
// });



Route::prefix('admin')->group(function () {

    Route::controller(App\Http\Controllers\CartegoryController::class)->group(function () {

        Route::get('cartegory' , 'index');
        Route::get('cartegory/create' , 'create');
        Route::post('cartegory', 'store');
    });

    Route::controller(App\Http\Controllers\ProductController::class)->group(function () {

        Route::get('product' , 'index');
        Route::get('product/create' , 'create');
        Route::post('product', 'store');
    });

});
