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

// Menu Section
Route::get('getMenu', 'API\MenuController@getMenu');
Route::post('storeMenu', 'API\MenuController@storeMenu');
Route::put('updateMenu', 'API\MenuController@updateMenu');
Route::delete('deleteMenu/{id}', 'API\MenuController@deleteMenu');
Route::get('getNumOfItems/{id}', 'API\MenuController@getNumOfItems');

// Item Serction 
Route::get('getItems', 'API\ItemController@getItem');
Route::post('storeItem', 'API\ItemController@storeItem');
Route::put('updateItem', 'API\ItemController@updateItem');
Route::delete('deleteItem/{id}', 'API\ItemController@deleteItem');
Route::get('getItem/{id}', 'API\ItemController@getItem');
Route::get('getNumOfCatForEachItem/{id}', 'API\ItemController@getNumOfCatForEachItem');

//Categories Section
Route::get('getCategories', 'API\CategoriesController@getCategories');
Route::post('storeCategories', 'API\CategoriesController@storeCategories');
Route::put('updateCategories', 'API\CategoriesController@updateCategories');
Route::delete('deleteCategories/{id}', 'API\CategoriesController@deleteCategories');
Route::get('getCategory/{id}', 'API\CategoriesController@getCategory');