<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*Route::group([
    'prefix' => 'community',
], function () {
    Route::post("add", 'CommunityController@createCommunity');
    Route::get("/{id}", 'CommunityController@getCommunityDetails');
    Route::put("update/{id}/community-privacy", 'CommunityController@updateCommunityPrivacy');
    Route::put("update/{id}/community-views", 'CommunityController@updateCommunityViews');
    Route::put("update/{id}/community-profile", 'CommunityController@updateCommunityProfile');
    Route::post("update/community-profile-pic", 'CommunityController@updateCommunityProfilePic');
    Route::post("update/community-cover-photo", 'CommunityController@updateCommunityCoverPhoto');

});*/
Route::group([
    'prefix' => 'business',
], function () {
    Route::post("/add", 'BusinessController@createBusiness');
    Route::get("/{id}", 'BusinessController@getBusinessDetails');
    Route::put("update/{id}/business-privacy", 'BusinessController@updateBusinessPrivacy');
    Route::put("update/{id}/business-views", 'BusinessController@updateBusinessViews');
    Route::put("update/{id}/business-profile", 'BusinessController@updateBusinessProfile');
    Route::post("update/business-profile-pic", 'BusinessController@updateBusinessProfilePic');
    Route::post("update/business-cover-photo", 'BusinessController@updateBusinessCoverPhoto');
    Route::post("/add-business-partner", 'BusinessController@addBusinessPartner');
    Route::post("/accept-bussiness-partner-request", 'BusinessController@acceptBusinessPartnerRequest');
    Route::get("/get-partners/{id}", 'BusinessController@getPartners');
});


// update from Arphie

Route::group([
    'prefix' => 'company',
], function () {
    Route::post("add", 'CompanyController@insert'); 
});

Route::group([
    'prefix' => 'teams',
], function () {
    Route::post("add", 'CompanyController@addTeam'); 
    Route::post("invite", 'CompanyController@invite'); 
    Route::post("uninvite", 'CompanyController@uninvite'); 

    Route::get("members", 'CompanyController@members'); 
});

Route::group([
    'prefix' => 'kb',
], function () {
    Route::post("insert", 'KnowledgeBaseController@insert'); 
    Route::post("edit", 'KnowledgeBaseController@edit'); 
    Route::post("deactive", 'KnowledgeBaseController@deactive'); 
});

Route::group([
    'prefix' => 'manage',
], function () {
    Route::post("/", 'CompanyController@manage'); 
});

Route::group([
    'prefix' => 'hashtags',
], function () {
    Route::get("suggest", 'CompanyController@suggest');
});
