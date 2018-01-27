<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested. 
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'SiteController@index');

Route::group(['prefix'=>'site'], function(){
    Route::get('/', 'SiteController@index')->name('site.index'); 
     
    Route::get('/article/{category?}', 'SiteController@article')->name('site.article');
    Route::get('/article/show/{article}', 'SiteController@articleShow')->name('site.article.show');
    
    // Route::get('/page/{category?}', 'SiteController@page')->name('site.page');
    Route::get('/page/show/{page}', 'SiteController@pageShow')->name('site.page.show');    
    
    Route::get('/product/{category?}', 'SiteController@product')->name('site.product');
    Route::get('/product/show/{product}', 'SiteController@productShow')->name('site.product.show');
    
    Route::get('/formcallme', 'SiteController@formCallMe')->name('site.formcallme');
    Route::post('/querycallme', 'SiteController@queryCallMe')->name('site.querycallme');
});


Route::group(['prefix'=>'admin'], function(){
    Route::auth();
    Route::group(['middleware'=>'auth'], function(){
        Route::get('/', 'AdminController@index')->name('admin.index');
        Route::post('upload', 'AdminController@upload');
        Route::resource('article', 'ArticleController');
        Route::resource('page', 'PageController');
        Route::resource('product', 'ProductController');
        Route::resource('category', 'CategoryController');
        Route::resource('call', 'CallController');
        Route::get('call/done/{call}', 'CallController@done')->name('admin.call.done');
    });
});

// Route::get('/getpreview64/{path}', 'ToolController@getpreview64')->name('tool.getpreview64');


Route::group(['prefix'=>'partner'], function(){
    
    Route::get('/', 'PartnerController@index');
    
    // Authentication Routes...
    Route::get('login', 'PartnerController@showLoginForm');
    Route::post('login', 'PartnerController@login');
    Route::get('logout', 'PartnerController@logout');
    
    // // Registration Routes...
    Route::get('register', 'PartnerController@showRegistrationForm');
    Route::post('register', 'PartnerController@register');
    
    // // Password Reset Routes...
    // Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
    // Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
    // Route::post('password/reset', 'Auth\PasswordController@reset');
});