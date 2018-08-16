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

Route::get('/', function () { // the slash will be the shortcut to php - ROOT or LINK/URL
	return view('welcome');
});

Route::get('/chris', function () {
	return "Hello World";
});

Route::get('/hello', function () {
return view('hello', ['name' => 'Christine']); //the var name, will make bato on hello.blade.php
});

Route::get('/sample', function(){
	return view('content');
});

// Route::get('/menu', 'ItemController@showMenu'); //this will go to the showMenu function on the ItemController.php

// // /*this will filter the website if you have logged in or not*/
// Route::middleware('auth')->group(function(){

// Route::get('/menu/add', 'ItemController@addItem'); 
// Route::post('/menu/add', 'ItemController@saveItem');

// Route::get('/menu/{id}', 'ItemController@itemDetails');

// Route::get('/menu/{id}/edit', 'ItemController@editItemForm');

// Route::patch('/menu/{id}/edit','ItemController@updateItem');

// Route::delete('/menu/{id}/delete', 'ItemController@delete');
// Route::get('/categories', 'CategoryController@showCategories');

// Route::get('/categories/{id}', 'CategoryController@categoryDetails');
// Route::get('/checkout', 'ItemController@checkOut');
// Route::get('/orders', 'ItemController@showOrders');
// });

// // return view('hello', ['name' => 'Christine']);

// Route::post('/addtocart/{id}','ItemController@addtoCart');

// Route::get('/mycart','ItemController@showCart');

// Route::patch('/addtocart/{id}','ItemController@updateQuantity');

// Route::delete('/clearcart', 'ItemController@emptyCart');

// Route::delete('/remove/{id}', 'ItemController@removeCart');

// Route::get('/menu/categories/{id}', 'CategoryController@sortCategories');

// Task todo list

Route::get('/menu', 'TaskController@showTaskForm');
Route::post('/task', 'TaskController@addTask');
Route::delete('/task/{id}', 'TaskController@deleteTask');
Route::patch('/task/{id}/edit', 'TaskController@editTask');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
