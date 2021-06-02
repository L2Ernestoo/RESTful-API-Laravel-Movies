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
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signUp');

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});


Route::group([
    'prefix' => 'movie',
    'middleware' => 'auth:api'
], function() {
    Route::get('{id_movie}', 'TmdbController@getMovie');
    Route::get('popular', 'TmdbController@getMoviePopular');
    Route::get('{id_movie}/reviews', 'TmdbController@getMovieReviews');
    Route::post('{id_movie}/review', 'TmdbController@putMovieReview');
});

Route::group([
    'prefix' => 'tv',
    'middleware' => 'auth:api'
], function() {
    Route::get('{id_tv_show}', 'TmdbController@getTvShow');
    Route::get('popular', 'TmdbController@getTVShowPopular');
    Route::get('{id_tv_show}/reviews', 'TmdbController@getTvShowReviews');
    Route::post('{id_tv_show}/review', 'TmdbController@putTvShowReview');
});

