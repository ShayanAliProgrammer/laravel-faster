<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['route_caching'])->group(function () {
    Route::view('/', 'welcome')->name('home');

    Route::view('/{category}', 'category')->name('category');
    Route::view('/{category}/{sub_category}', 'sub_category')->name('sub_category');
    Route::view('/{category}/{sub_category}/{nested_sub_category}', 'products')->name('nested_sub_category');
    Route::view('/{category}/{sub_category}/{nested_sub_category}/{product}', 'product')->name('product');
});