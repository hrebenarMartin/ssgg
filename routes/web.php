<?php

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


use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();


//Route::resource('/conference', 'Frontend\Conference\PagesController');

Route::resource('/dashboard', 'Backend\Dashboard\DashboardController');

Route::get('/set_locale/{locale}', 'Helpers\LocaleController@setLocale')->name('set_locale');

Route::get('/konferencia', 'Frontend\ConferencePagesController@index')->name('conference.index');
Route::get("/konferencia/{page}", 'Frontend\ConferencePagesController@show')->name('conference.show');

Route::get('/', 'Frontend\PagesController@index')->name("index");
Route::get('/{page}', 'Frontend\PagesController@show')->name('show');


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function (){
    Route::resource('/user','Backend\User\UserController');

    Route::resource('/cms', 'Backend\CMS\PagesController');
    Route::resource('/cms/content', 'Backend\CMS\ContentController');
    Route::get('/cms/content/create/{page_id}', 'Backend\CMS\ContentController@createForPage')->name('content.createForPage');
    Route::resource('/cms/front_menu', 'Backend\CMS\FrontMenuController');

    Route::resource('/conferences', 'Backend\Admin\ConferenceController');
});

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth']], function () {
    Route::resource('/profile', 'Backend\User\ProfileController');
    Route::resource('/myContribution', 'Backend\User\ContributionController');
    Route::get('/myContribution/download/{id}', 'Backend\User\ContributionController@downloadContribution')->name('myContribution.download');
    Route::get('/myContribution/download_template/{id}', 'Backend\User\ContributionController@downloadTemplate')->name('myContribution.download_template');
});
