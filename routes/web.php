<?php

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

Auth::routes(['register' => false]);
// Auth::routes();


Route::get('/', function(){
   return redirect()->route('login');
});


//Language Translation


Route::middleware(['auth'])->group(function () {

   Route::post('test', 'manage\ClientController@delete')->name('test');
   Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);
   Route::get('check_duplicate', 'CommonController@check_duplicate')->name('check_duplicate');
   Route::get('check_update_duplicate', 'CommonController@check_update_duplicate')->name('check_update_duplicate');

   Route::get('index', 'HomeController@root')->name('index');
   Route::get('profile', 'ProfileController@index')->name('profile');
   Route::put('profile-update/{user_id}', 'ProfileController@update')->name('profile_update');

   Route::get('change-password', function(){
      return view('other.change-pass');
   })->name('change-password');
   
   Route::post('reset-password', 'ProfileController@change_password')->name('reset-password');

   // digital page
   Route::get('digital', 'market\DigitalController@index')->name('digital.index');
   // Route::get('digital/digital-client', 'market\DigitalController@client_digital')->name('digital.client');

   //social media page
   Route::get('social-media', 'market\SocialMediaController@index')->name('social-media.index');

   //creative
   Route::get('creative', 'market\CreativeController@index')->name('creative.index');

   //report
   Route::get('report', 'market\AddReportController@index')->name('report.index');

   //media
   Route::get('media', 'market\MediaController@index')->name('media.index');

   //invoice
   Route::get('invoice', 'market\InvoiceController@index')->name('invoice.index');


   Route::resource('notification', 'NotificationController');

   Route::middleware(['isEmp'])->group(function(){
      Route::get('digital/create', 'market\DigitalController@create')->name('digital.create');
      Route::get('digital/edit/{id}', 'market\DigitalController@edit')->name('digital.edit');
      Route::put('digital/update/{id}', 'market\DigitalController@update')->name('digital.update');
      Route::delete('digital-delete', 'market\DigitalController@delete')->name('digital.delete');
      Route::post('digital/store', 'market\DigitalController@store')->name('digital.store');

      Route::resource('social-media', 'market\SocialMediaController')->except(['index']);
      Route::delete('social-media-delete', 'market\SocialMediaController@delete')->name('social-media.delete');

      Route::resource('creative', 'market\CreativeController')->except(['index']);
      Route::delete('creative-delete', 'market\CreativeController@delete')->name('creative.delete');

      Route::resource('report', 'market\AddReportController')->except(['index']);
      Route::delete('report-delete', 'market\AddReportController@delete')->name('report.delete');

      //media
      Route::resource('media', 'market\MediaController')->except(['index']);
      Route::delete('media-delete', 'market\MediaController@delete')->name('media.delete');


      Route::resource('invoice', 'market\InvoiceController')->except(['index']);
      Route::delete('invoice-delete', 'market\InvoiceController@delete')->name('invoice.delete');

   });

   Route::middleware(['isManager'])->group(function(){
      Route::resource('emp', 'manage\EmpController');
      Route::delete('emp-delete', 'manage\EmpController@delete')->name('emp.delete');

      Route::resource('client', 'manage\ClientController');
      Route::delete('client-delete', 'manage\ClientController@delete')->name('client.delete');

      Route::delete('ad', 'AdController@delete')->name('ad.delete');
      Route::resource('ad', 'AdController');

      Route::get('admin-notificatin', 'NotificationController@admin_create')->name('admin.notification.create');
      Route::post('admin-notificatin', 'NotificationController@admin_store')->name('admin.notification.store');
   });

   Route::middleware(['isAdmin'])->group(function(){
      Route::resource('all-users', 'manage\UserController');
      Route::delete('all-users-delete', 'manage\UserController@delete')->name('all-users.delete');
   });

});

