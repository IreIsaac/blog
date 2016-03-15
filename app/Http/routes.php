<?php

Route::group(['middleware' => 'web'], function () {
    /*
     * Default auth routes
     * 
     * Not huge fan of the \Route::auth() 
     * shortcut I'd rather see the
     * actual routes
     */
    Route::get('login', [
        'uses' => 'Auth\AuthController@showLoginForm',
        'as'   => 'login',
    ]);

    Route::post('login', [
        'uses' => 'Auth\AuthController@login',
        'as'   => 'login.post',
    ]);

    Route::get('logout', [
        'uses' => 'Auth\AuthController@logout',
        'as'   => 'logout',
    ]);

    /*
     * Registration Routes
     */
    Route::get('register', [
        'uses' => 'Auth\AuthController@showRegistrationForm',
        'as'   => 'register.show',
    ]);

    Route::post('register', [
        'uses' => 'Auth\AuthController@register',
        'as'   => 'register.post',
    ]);

    /*
     * Password Reset Route
     */
    Route::get('password/reset/{token?}', [
        'uses' => 'Auth\PasswordController@showResetForm',
        'as'   => 'password.reset.show',
    ]);

    Route::post('password/email', [
        'uses' => 'Auth\PasswordController@sendResetLinkEmail',
        'as'   => 'password.email.post',
    ]);

    Route::post('password/reset', [
        'uses' => 'Auth\PasswordController@reset',
        'as'   => 'password.reset.post',
    ]);

    /*
     * Homepage
     */
    Route::get('/', [
        'uses' => 'PageController@home',
        'as'   => 'home',
    ]);

    /*
     * Blog
     */
    Route::get('blog', [
        'uses' => 'BlogController@index',
        'as'   => 'blog.index',
    ]);

    Route::get('blog/{post}', [
        'uses' => 'BlogController@show',
        'as'   => 'blog.show',
    ]);

});

/*
 * Admin
 */
Route::group(['middleware' => 'web'], function () {

    // Admin Dashboard
    Route::get('admin', [
        'uses' => 'Admin\DashboardController@index',
        'as'   => 'admin.dashboard',
    ]);

    Route::resource('admin/user', 'Admin\UserController');

    Route::delete('admin/user/cache', [
        'uses' => 'Admin\UserController@clearCache',
        'as'   => 'admin.user.cache:clear',
    ]);

    Route::resource('admin/post', 'Admin\PostController');

});
