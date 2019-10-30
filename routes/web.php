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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->middleware('auth');

// Inspecciones
Route::get('inspections/index', 'InspectionController@index');
Route::get('inspections/detail/{id}', 'InspectionController@detail')->name('inspection.detail');
Route::get('inspections/create', 'InspectionController@create')->name('inspection.create');
Route::post('inspections/store', 'InspectionController@store')->name('inspection.store');
Route::get('inspections/revisions/{id}', 'InspectionController@getRevisions')->name('inspection.revisions');

// Revisions
Route::post('revisions/store', 'RevisionController@store')->name('revisions.store');
Route::get('revisions/show/{id}', 'RevisionController@show')->name('revisions.show');
Route::get('revisions/getpieces/{id}', 'RevisionController@getPieces')->name('revisions.pieces');

// Empresas  
Route::get('company/create', 'CompanyController@create');
Route::post('company/store', 'CompanyController@store')->name('company.store');
Route::get('company/index', 'CompanyController@index');

// Productos
Route::get('product/create', 'ProductController@create');
Route::get('product/index', 'ProductController@index');
Route::post('product/store', 'ProductController@store')->name('product.store');