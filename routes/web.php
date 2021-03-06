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

Route::get("/", function (){
    return view("main");
});

Route::post("/api/queue/add.json", ["uses" => "ApiController@add"]);

Route::post("/api/queue/del.json", ["uses" => "ApiController@del"]);

Route::post("/api/queue/order/get.json", ["uses" => "ApiController@getOrder"]);

Route::post("/api/queue/element/get.json", ["uses" => "ApiController@getElement"]);
