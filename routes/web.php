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

Route::post('/ajax', 'Helpers\AjaxController@main')->name('ajax');
Route::post('/ajax-ext', 'Helpers\AjaxExternalController@main')->name('ajax_ext');

Route::get('/cron', 'Backend\EmailSenderController@cron')->middleware("auth")->name('cron');
Route::get('/e55252b69c7a68861c2bf80d2506324f', 'Backend\EmailSenderController@cron');

Route::resource('/dashboard', 'Backend\Dashboard\DashboardController');

Route::get('/set_locale/{locale}', 'Helpers\LocaleController@setLocale')->name('set_locale');

Route::get('/konferencia', 'Frontend\ConferencePagesController@index')->name('conference.index');
Route::get("/konferencia/{page}", 'Frontend\ConferencePagesController@show')->name('conference.show');
Route::get("/konferencia/zbornik_download/{year}", 'Frontend\ConferencePagesController@proceedingsDownload')->name('conference.proceedings_download');

Route::get('/archiv/{rocnik}', 'Frontend\PagesController@archiveEntry')->name('archive.show');

Route::get('/', 'Frontend\PagesController@index')->name("index");
Route::get('/{page}', 'Frontend\PagesController@show')->name('show');

Route::get('/404', 'ErrorHandlerController@e_404')->name("e404");

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {

    Route::resource('/user', 'Backend\User\UserController')->middleware("admin");

    Route::resource('/cms', 'Backend\CMS\PagesController')->middleware("admin");
    Route::resource('/cms/content', 'Backend\CMS\ContentController')->middleware("admin");
    Route::get('/cms/content/create/{page_id}', 'Backend\CMS\ContentController@createForPage')->name('content.createForPage')->middleware("admin");
    Route::resource('/cms/front_menu', 'Backend\CMS\FrontMenuController')->middleware("admin");

    Route::resource('/conferences', 'Backend\Admin\ConferenceController');
    Route::delete( '/conferences/{id}/delete_image', 'Backend\Admin\ConferenceController@deleteImage')->name('conferences.delete_image');
    Route::get('/conferences/{id}/participants', 'Backend\Admin\ConferenceController@conferenceParticipants')->name('conferences.conference_participants');
    Route::get('/conferences/{cid}/participants/{aid}/confirm', 'Backend\Admin\ApplicationsController@confirmApplication')->name('conferences.conference_participants.confirm');
    Route::get('/conferences/{cid}/participants/{aid}/confirm-payment', 'Backend\Admin\ApplicationsController@confirmApplicationPayment')->name('conferences.conference_participants.confirm_payment');
    Route::get('/conferences/{cid}/participants/{aid}/', 'Backend\Admin\ApplicationsController@show')->name('conferences.conference_participants.show');
    Route::get('/conferences/{id}/contributions', 'Backend\Admin\ConferenceController@conferenceContributions')->name('conferences.conference_contributions');
    Route::get('/conferences/{id}/statistics', 'Backend\Admin\ConferenceController@conferenceStatistics')->name('conferences.conference_statistics');
    Route::get('/conferences/{id}/review_form', 'Backend\Admin\ConferenceReviewFormController@index')->name('conferences.review_form.index');
    Route::post('/conferences/{id}/review_form', 'Backend\Admin\ConferenceReviewFormController@store')->name('conferences.review_form.store');
    Route::put('/conferences/{id}/review_form', 'Backend\Admin\ConferenceReviewFormController@update')->name('conferences.review_form.update');

    Route::post('/conference_upload_images', 'Backend\Admin\ConferenceController@uploadImagesBlueImp')->name('conferences.upload_images');

    Route::resource('/contributions', 'Backend\Admin\ContributionsController');
    Route::post('/contributions/assign_reviewer/{contribution_id}', 'Backend\Admin\ContributionsController@assignReviewer')->name('contributions.assignReviewer');

    Route::resource('/email-queue', 'Backend\Admin\EmailQueueController')->middleware('admin');

    Route::get('/test', 'Backend\Admin\TestController@index')->name('test')->middleware("admin");
});

Route::group(['prefix' => 'review', 'as' => 'review.', 'middleware' => ['auth']], function () {
    Route::resource('/myReview', 'Backend\Review\UserReviewController');
    Route::get('/myReview/accept/{review_id}', 'Backend\Review\UserReviewController@acceptReview')->name('accept');
    Route::get('/myReview/reject/{review_id}', 'Backend\Review\UserReviewController@rejectReview')->name('reject');
});

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth']], function () {
    Route::resource('/profile', 'Backend\User\ProfileController');
    Route::resource('/myContribution', 'Backend\User\ContributionController');
    Route::get('/myContribution/download/{id}', 'Backend\User\ContributionController@downloadContribution')->name('myContribution.download');
    Route::get('/myContribution/download_template/{id}', 'Backend\User\ContributionController@downloadTemplate')->name('myContribution.download_template');

    Route::resource('/application', 'Backend\User\ApplicationController');
    Route::get('/application-confirm', 'Backend\User\ApplicationController@confirm')->name('application.confirm');
});


Route::group(['prefix' => 'pp', 'as' => 'pp.'], function (){
   Route::get('/~hrebenar', 'PP\PersonalPageController@hrebenar');
});
