<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile', function () {
    return view('admin.profile');
});

Route::get('/index', function () {
    return view('admin.auth.index');
});

Route::get('/forgot', function () {
    return view('admin.auth.forgot');
})->name('forgot');
Route::get('/forgot-sent', function () {
    return view('admin.auth.forgot-sent');
});

Route::get('/reset-success', function () {
    return view('admin.auth.reset-success');
});
Route::get('/reset', function () {
    return view('admin.auth.reset');
});



