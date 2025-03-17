<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', function() {
    return view('login.login');
});

Route::get('/resgister', function() {
    return view('resgister.register');
});


Route::get('/dashboard', function() {
    return view('dashboard.dashboard');
});

Route::get('/create', function() {
    return view('create.create');
});

Route::get('/crud', function() {
    return view('crud.crud');
});
