<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/




	Route::get('/', 'PagesController@getIndex');
	Route::get('about', 'PagesController@getAbout');
	Route::get('faq', 'PagesController@getFAQ');
	Route::get('contact', 'PagesController@getContact');
	Route::post('contact', 'PagesController@postContact');
	Route::resource('articles', 'ArticlesController');
	Route::resource('products', 'ProductsController');
	Route::resource('categories', 'CategoriesController');
	Route::resource('administrators', 'AdministratorsController');
	Route::delete('administrators', ['uses' => 'AdministratorsController@delete_user', 'as' => 'user.delete']);
	Route::resource('profiles', 'ProfilesController');
	Route::get('carts', ['uses' => 'CartController@show', 'as' => 'cart.show']);
	Route::post('add_to_cart/{pid}', ['uses' => 'CartController@addProduct', 'as' => 'cart.add']);
	Route::post('remove_from_cart/{pid}', ['uses' => 'CartController@removeProduct', 'as' => 'cart.remove']);
	Route::get('confirmuser/{userhash}', ['uses' => 'AdministratorsController@confirmUser', 'as' => 'userConfirm']);
	/*Route::post('sendmail', function(\Illuminate\Http\Request $request, 
		\Illuminate\Mail\Mailer $mailer) {
			$mailer->to
			return redirect()->back();
	})->name('sendmail');*/


Auth::routes();

Route::get('/home', 'HomeController@index');
