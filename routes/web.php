<?php

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
    return view('frontend.index1');
});

Route::get('/admin', function () {
    return view('dashboard.dashboard.index1');
    // return view('frontend.index1');
});
/* admin */


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/checkout', 'App\Http\Controllers\Checkout\CheckoutController');
Route::get('/transaction', 'App\Http\Controllers\Checkout\CheckoutController@transaction');
Route::post('/preview', 'App\Http\Controllers\Checkout\CheckoutController@preview');


Route::get('/preview_report', 'App\Http\Controllers\Dashboard\PaymentController@preview_report');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
/* landingpage  */

/* dashboard user || admin */
Route::group(['middleware' => 'auth'], function() {
    //dashboard admin
    Route::resource('/dashboard', 'App\Http\Controllers\Dashboard\DashboradController');

    //payment
    Route::resource('/payment', 'App\Http\Controllers\Dashboard\PaymentController');  
    Route::post('/payment/upload_docs', 'App\Http\Controllers\Dashboard\PaymentController@upload_docs');
     
    // Route::get('/payment/preview_report', function () {
    //     return view('dashboard.payment.report_sample');
    // }); 
    
    Route::resource('/contact', 'App\Http\Controllers\Dashboard\ContactController');
    
    
    Route::resource('/report', 'App\Http\Controllers\Dashboard\ReportController');

    Route::resource('/task', 'App\Http\Controllers\Dashboard\TaskController');
    Route::get('/task-phone-number', 'App\Http\Controllers\Dashboard\TaskController@task_phone_number');
    Route::post('/upload-list-phone-number', 'App\Http\Controllers\Dashboard\TaskController@upload_list_phone_number');
});
