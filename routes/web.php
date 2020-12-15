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
*/

Auth::routes(['password.request'=>false,'reset'=>false]);

Route::get('/', 'PageController@index')->name('application');
Route::get('/available', 'PageController@available')->name('available');
Route::get('/guide', 'PageController@guide')->name('guide');
Route::get('/faq', 'PageController@faq')->name('faq');
Route::get('/advices', 'PageController@advice')->name('advice');
Route::get('/contact', 'PageController@contact')->name('contact');

Route::group(['middleware'=>['auth:web']],function(){
    // INDEX-HOME-DEFAULT PAGE
    Route::get('/Dashboard', 'HomeController@index')->name('home');
    Route::get('/Dashboard/Menah', 'HomeController@menah')->name('dashboard.menah');
    Route::get('/Dashboard/Mission', 'HomeController@mission')->name('dashboard.mission');
    Route::get('/Mission', 'HomeController@showAllMissions')->name('mission.index');
    Route::get('/Mission/Create', 'HomeController@createMission')->name('mission.create');
    Route::post('/Mission/Create', 'HomeController@storeMission')->name('mission.store');
    Route::get('/Mission/Edit/{id}', 'HomeController@editMission')->name('mission.edit');
    Route::put('/Mission/Edit/{id}', 'HomeController@updateMission')->name('mission.update');
    Route::delete('/Mission/Delete/{id}', 'HomeController@destroyMission')->name('mission.destroy');

    // Application Process
    Route::delete('/Application/Delete/{id}/{type}', 'HomeController@destroy')->name('application.destroy');
    Route::post('/Application/Accept/{id}/{type}', 'HomeController@accept')->name('application.status.accept');
    Route::post('/Application/Refuse/{id}/{type}', 'HomeController@refuse')->name('application.status.refuse');

    // USER PROFILE
    Route::get('/My-Account','AccountController@showAccount')->name('my-account.show');
    Route::put('/Update-Account-Info','AccountController@updateInformation')->name('my-account.update');
    Route::put('/Reset-Account-Password','AccountController@resetPassword')->name('my-account.reset');

    //STUDIES OPERATION للمنح
    Route::get('/Studies','StudiesController@index')->name('studies.index');
    Route::get('/Studies/Create','StudiesController@create')->name('studies.create');
    Route::post('/Studies/Create','StudiesController@store')->name('studies.store');

    //STUDIES OPERATION للبعثات
    Route::get('/StudyMission','StudiesController@showAllMyMissions')->name('StudyMission.index');
    Route::get('/StudyMission/Create','StudiesController@createMission')->name('StudyMission.create');
    Route::post('/StudyMission/Create','StudiesController@storeMission')->name('StudyMission.store');


});




