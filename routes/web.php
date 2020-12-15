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
Auth::routes(['password.request'=>false,'reset'=>false]);

$languageMiddleware= [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ];
$attributes=['prefix' => LaravelLocalization::setLocale(),'middleware' => $languageMiddleware];
// apply some middleware to make the system support multi languages
Route::group($attributes, function(){
    Route::group(['prefix' => config('general.routes.backend.prefix')],function (){




        // all routes here required the user to be authenticated
        Route::group(['middleware' => ['auth:web']],function(){

            // show the current authenticated user account info and update the information
            Route::group(['namespace' => 'Auth'],function (){
                Route::get('/logout','LoginController@logout')->name('logout');
                Route::get('/My-Account','AccountController@showAccount')->name('my-account.show');
                Route::put('/Update-Account-Info','AccountController@updateInformation')->name('my-account.update');
                Route::put('/Reset-Account-Password','AccountController@resetPassword')->name('my-account.reset');
            });


            // show the home page of the dashboard
            Route::group(['middleware' => 'auth:web'],function (){
                Route::get('/','DashboardController@index')->name('dashboard');
                Route::get('/Home','DashboardController@index')->name('dashboard');
                Route::get('/Dashboard','DashboardController@index')->name('dashboard');
                Route::get('/Mark-all-notification-as-read','DashboardController@markAllAsRead')->name('notification.mark_all_as_read');
                Route::get('/Mark-notification-as-read/{notification}','DashboardController@markAsRead')->name('notification.mark_as_read');




            });




            // manage the translations
            Route::group(['middleware' => ['auth:web','AdminOnly']],function (){
                Route::get('/Setting','SettingController@index')->name('setting.index');
                Route::get('/Translation','TranslationController@index')->name('translation.index');
                Route::post('/Translation','TranslationController@save')->name('translation.save');
            });

            // manage the subscription
            Route::get('old-subscription-records','SubscriberController@show')->name('Subscribe.show-old-records');
            Route::resource('/Subscribe','SubscriberController')->except('show');
        });

    });
});























