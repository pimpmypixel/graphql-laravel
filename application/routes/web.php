<?php

Route::get('/', function () {
    return view('welcome');
});

Route::post('graphql/login', 'AuthenticateController@authenticate');
// Route::post('graphql/login', 'App\Http\Controllers\AuthenticateController@authenticate');
