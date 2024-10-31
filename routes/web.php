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


//inner join
Route::get('/inner-join',[DemoController::class,'innerJoin']);

//left join
Route::get('/left-join',[DemoController::class,'leftJoin']);

//right join
Route::get('/right-join',[DemoController::class,'rightJoin']);

//cross join
Route::get('/cross-join',[DemoController::class,'crossJoin']);

//===========================================================//


//advance joine clauses

//advance joinclauses
Route::get('/advance-join-clause',[DemoController::class,'advanceJoinClause']);

//unions joine
Route::get('/union-join',[Democontroller::class, 'unionJoin']);

//basic where clauses
Route::get('/basic-where-clauses',[Democontroller::class, 'basicWhereClauses']);

//advance where clauses
Route::get('/advance-where-clauses',[Democontroller::class, 'advanceWhereClauses']);

//order by ascending
Route::get('/order-by-ascending',[Democontroller::class, 'orderByAscending']);

//order by descending
Route::get('/order-by-descending',[Democontroller::class, 'orderByDescending']);

//order by random
Route::get('/order-by-random',[Democontroller::class, 'orderByRandom']);

//order by skip and take
Route::get('/order-by-skip-take',[Democontroller::class, 'orderBySkipTake']);

//Group by
Route::get('/group-by',[Democontroller::class, 'groupBy']);

//Group by having
Route::get('/group-by-having',[Democontroller::class, 'groupByHaving']);


//===========================================================//

// CURD Operation

// insert data
Route::post('/insert-data',[Democontroller::class, 'insertData']);

// update data
Route::post('/update-data/{id?}',[Democontroller::class, 'updateData']);

// Update or Create data
Route::post('/update-or-insert-data',[Democontroller::class, 'updateOrInsertData']);

// increment data
Route::post('/increment/{id?}',[Democontroller::class, 'incrementData']);

//Decrement Data
Route::post('/decrement/{id?}', [DemoController::class, 'decrementData']);

//Decrement Data
Route::post('/delete/{id?}', [DemoController::class, 'deleteData']);

//=======================ALBAM APP====================================//




