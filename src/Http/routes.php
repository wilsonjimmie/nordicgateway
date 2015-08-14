<?php

Route::group(['prefix' => 'nordicgateway'], function() {
    Route::get('/', 'MainController@index');
    Route::post('/add/{newsletter}', 'MainController@store');
    //Route::put('/update/{newsletter}', 'NewsletterController@update');
    Route::get('/find/{id}', 'MainController@show');
    Route::get('/delete/{id}', 'MainController@destroy');
});