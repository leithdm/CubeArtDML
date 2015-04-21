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

//Route::get('/', function()
//{
//	return View::make('hello');
//});

Route::when('*', 'csfr', ['post', 'put', 'patch']);

Route::get('/', ['as' => 'home', 'uses' => 'PagesController@home']);

Route::resource('ims/arts', 'ArtsController');

Route::resource('ims/dashboard', 'DashBoardController', ['only' => ['index']]);

Route::resource('ims/artists', 'ArtistController');

Route::get('/admin', 'SessionsController@create');

Route::get('/logout', 'SessionsController@destroy');

Route::resource('sessions', 'SessionsController', ['only' => ['create', 'store', 'destroy']]);

Route::resource('ims/employees', 'EmployeeController');

Route::resource('ims/events', 'ExhibitionsController');

Route::resource('ims/customers', 'CustomerController');

Route::resource('ims/orders', 'OrderController');

Route::resource('ims/gallery', 'GalleryController', ['only' => ['index', 'edit', 'update']]);

Route::resource('ims/carousel', 'CarouselController', ['only' => ['index', 'edit', 'update']]);

Route::get('/art/Collage/', 'PagesController@collageIndex');

Route::get('/art/Painting/', 'PagesController@paintingIndex');

Route::get('/art/Photography/', 'PagesController@photographyIndex');

Route::get('/art/Drawing/', 'PagesController@drawingIndex');

Route::get('/art/Sculpture/', 'PagesController@sculptureIndex');

Route::get('/art/Collage/{id}', 'PagesController@collageView');

Route::get('/art/Painting/{id}', 'PagesController@paintingView');

Route::get('/art/Photography/{id}', 'PagesController@photographyView');

Route::get('/art/Drawing/{id}', 'PagesController@drawingView');

Route::get('/art/Sculpture/{id}', 'PagesController@sculptureView');

Route::get('/events', 'PagesController@events');

Route::get('/artist/{id}', function($id) {
  $artist = Artist::find($id);
  $artistArt = Art::where('artist_id', $id)->get();
  $artistCategory = Art::where('category', $artist->category)->get();
  $count = Art::where('artist_id', $id)->count();
  return View::make('artist', ['artist' => $artist, 'artistArt' => $artistArt, 'artistCategory' => $artistCategory,
                               'count' => $count]);
});