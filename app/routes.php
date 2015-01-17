<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::group(array('before' => 'auth'), function()
{
	Route::get('flickr/disconnect', 'FlickrController@disconnect');
	Route::get('flickr/albums', 'FlickrController@albums');
	Route::any('flickr/albums/{album_id}/share', 'FlickrController@share');
	Route::any('flickr/shares/revoke/{id}', 'FlickrController@revoke');
});

Route::get('flickr/auth', 'FlickrController@auth');
Route::any('flickr/oauth_callback', 'FlickrController@authcallback');
Route::any('flickr/shares/access/{hash}', 'FlickrController@access');
