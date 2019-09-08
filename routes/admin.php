<?php


Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Config::set('auth.defines', 'admin');
    route::get('login', 'AdminAuth@login');
    route::post('login', 'AdminAuth@dologin');
    route::get('forgot/password', 'AdminAuth@forgot_password');
    route::post('forgot/password', 'AdminAuth@forgot_password_post');
    route::get('reset/password/{token}', 'AdminAuth@reset_password');
    route::post('reset/password/{token}', 'AdminAuth@reset_password_final');
    route::group(['middleware' => 'admin:admin'], function() {
        
        route::resource('users', 'UsersController');
        route::delete('users/destroy/all', 'UsersController@multi_delete');

        route::resource('admin', 'AdminController');
        route::delete('admin/destroy/all', 'AdminController@multi_delete');
        route::resource('countries', 'CountriesController');
        route::delete('countries/destroy/all', 'CountriesController@multi_delete');

        route::resource('cities', 'CitiesController');
        route::delete('cities/destroy/all', 'CitiesController@multi_delete');

        route::get('/', function (){ return view('admin.home'); });
        
        route::get('settings', 'Settings@setting');
        route::post('settings', 'Settings@setting_save');

        route::any('logout', 'AdminAuth@logout');
    });
    route::get('lang/{lang}', function($lang) {
        session()->has('lang')?session()->forget('lang'):'';
        $lang == 'ar'?session()->put('lang', 'ar'):session()->put('lang', 'en');
        return back();
    });
});