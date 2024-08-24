<?php

use App\Http\Controllers\DemoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
//see all data
Route::get('/retrieve-all-row',[DemoController::class,'retrieveAllData']);
//see single row/data
Route::get('/retrieve-single-row',[DemoController::class,'retrieveSingleData']);

//see single calumn or key valu payer
Route::get('/retrieve-column',[DemoController::class,'retrieveColumn']);

//ritrive aggregates
Route::get('/retrieve-aggregates',[DemoController::class,'retrieveAggregates']);

//select clause
Route::get('/select-clause',[DemoController::class,'sekectClause']);

//select clause for unique value or not duplicate
Route::get('/select-clause-unique',[DemoController::class,'sekectClauseUniqque']);

