<?php

Route::get('/', function () {
    return view('welcome');
});

Route::post('graphql/login', 'AuthenticateController@authenticate');