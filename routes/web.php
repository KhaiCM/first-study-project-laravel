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

Route::get('/', 'PagesController@home');
Route::get('/home', 'PagesController@home');
Route::get('/about', 'PagesController@about');
// contact
Route::get('/contact', 'TicketsController@create');
Route::post('contact', 'TicketsController@store');
//tickets
Route::get('/tickets', 'TicketsController@index');
Route::get('/ticket/{slug?}', 'TicketsController@show');
//edit contact
Route::get('/ticket/{slug?}/edit','TicketsController@edit');
Route::post('/ticket/{slug?}/edit','TicketsController@update');
//del ticket
Route::post('/ticket/{slug?}/delete','TicketsController@destroy');
// sending mail 
Route::get('sendemail', function () {
	$data = array(
		'name' => "xin chào tôi là leng keng đây",
	);
	Mail::send('emails.welcome', $data, function ($message) {
		$message->from('minhkhai97@gmail.com', 'Learning Laravel');
		$message->to('minhkhaichu@gmail.com')->subject('Learning Laravel test email');
	});
	return "Your email has been sent successfully";
});
// comment 
Route::post('/comment', 'CommentsController@newComment');
// register
Route::get('users/register', 'Auth\RegisterController@showRegistrationForm');
Route::post('users/register', 'Auth\RegisterController@register');
//logout
Route::get('users/logout', 'Auth\LoginController@logout');
//login
// Route::get('users/login', 'Auth\LoginController@showLoginForm');
Route::get('users/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('users/login', 'Auth\LoginController@login');
// admin 
Route::group(array('prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'manager'), function () 
{
	Route::get('users', [ 'as' => 'admin.user.index', 'uses' => 'UsersController@index']);
	Route::get('roles', 'RolesController@index');
	Route::get('roles/create', 'RolesController@create');
	Route::post('roles/create', 'RolesController@store');
	//edit roles
	Route::get('users/{id?}/edit', 'UsersController@edit');
	Route::post('users/{id?}/edit','UsersController@update');
	// font end admin 
	Route::get('/', 'PagesController@create');
	//post
	Route::get('posts', 'PostsController@index');
	Route::get('posts/create', 'PostsController@create');
	Route::post('posts/create', 'PostsController@store');
	Route::get('posts/{id?}/edit', 'PostsController@edit');
	Route::post('posts/{id?}/edit','PostsController@update');
	//category
	Route::get('categories', 'CategoriesController@index');
	Route::get('categories/create', 'CategoriesController@create');
	Route::post('categories/create', 'CategoriesController@store');

});
//blog
Route::get('/blog', 'BlogController@index');
Route::get('/blog/{slug?}', 'BlogController@show');