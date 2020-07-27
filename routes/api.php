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

Route::group([
    'prefix' => 'community',
], function () {
    Route::post("add", 'CommunityController@createCommunity');
    Route::get("/{id}", 'CommunityController@getCommunityDetails');
    Route::put("update/{id}/community-privacy", 'CommunityController@updateCommunityPrivacy');
    Route::put("update/{id}/community-views", 'CommunityController@updateCommunityViews');
    Route::put("update/{id}/community-profile", 'CommunityController@updateCommunityProfile');
    Route::post("update/community-profile-pic", 'CommunityController@updateCommunityProfilePic');
    Route::post("update/community-cover-photo", 'CommunityController@updateCommunityCoverPhoto');
});
