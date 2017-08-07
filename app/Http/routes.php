<?php

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    // Area publica ------------------------------------------------------------
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('google-news', [
        'as' => 'googleNews', 'uses' => 'RssController@index'
    ]);
    // FIM - Area publica ------------------------------------------------------

    // Area restrita ----------------------------------------------------------
    Route::group(['prefix'=>'/admin'], function() {
        Route::get('dashboard', [
            'as' => 'adminDashboard', 'uses' => 'Admin\DashboardController@index'
        ]);

        Route::get('usuarios', [
            'as' => 'adminUsers', 'uses' => 'Admin\UserController@index'
        ]);

        Route::post('usuarios', [
            'as' => 'adminUsers', 'uses' => 'Admin\UserController@index'
        ]);

        Route::get('usuarios/criar', [
            'as' => 'adminUsersCreate', 'uses' => 'Admin\UserController@create'
        ]);

        Route::post('usuarios/gravar', [
            'as' => 'adminUsersSave', 'uses' => 'Admin\UserController@save'
        ]);

        Route::get('usuarios/{id}/atualizar', [
            'as' => 'adminUsersUpdate', 'uses' => 'Admin\UserController@update'
        ]);

        Route::get('usuarios/{id}/excluir', [
            'as' => 'adminUsersDelete', 'uses' => 'Admin\UserController@delete'
        ]);
    });
    // FIM - Area restrita ----------------------------------------------------------
});

// Comentado/desabilitado quando em producao -------------------------------------
Route::get('routes', function () {
    \Artisan::call('route:list');
    return "<pre>".\Artisan::output();
});