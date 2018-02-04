<?php

Route::get('/', 'SiteController@index');
// Route::post('/', 'SiteController@index');

Route::group(['prefix'=>'site'], function(){
    Route::get('/', 'SiteController@index')->name('site.index'); 
    // Route::post('/', 'SiteController@index');
    
    Route::get('/article/{category?}', 'SiteController@article')->name('site.article');
    Route::get('/article/show/{article}', 'SiteController@articleShow')->name('site.article.show');
    
    // Route::get('/page/{category?}', 'SiteController@page')->name('site.page');
    Route::get('/page/show/{page}', 'SiteController@pageShow')->name('site.page.show');    
    
    Route::get('/product/{category?}', 'SiteController@product')->name('site.product');
    Route::get('/product/show/{product}', 'SiteController@productShow')->name('site.product.show');
    
    Route::get('/formcallme', 'SiteController@formCallMe')->name('site.formcallme');
    Route::post('/querycallme', 'SiteController@queryCallMe')->name('site.querycallme');
});

/* Models manager in admin */
Route::group(['prefix'=>'admin','middleware'=>'auth:admin'], function(){

    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::post('upload', 'AdminController@upload');
    Route::resource('article', 'ArticleController');
    Route::resource('page', 'PageController');
    Route::resource('product', 'ProductController');
    Route::resource('category', 'CategoryController');
    Route::resource('call', 'CallController');
    Route::resource('partner', 'PartnerController');
    Route::resource('offer', 'OfferController');
    Route::get('call/done/{call}', 'CallController@done')->name('admin.call.done');
    
    /******************************/
    // Route::get('partner', 'PartnerController@index')->name('admin.partner.index');
    Route::get('partner/partnership/{partner}', 'PartnerController@partnership')->name('admin.partner.partnership');
    Route::get('partner/profile/{partner}', 'PartnerController@profile')->name('admin.partner.profile');
    // Route::post('partner/destroy', 'PartnerController@destroy')->name('admin.partner.destroy');
});

/* Models manager in partners*/
Route::group(['prefix'=>'partner','middleware'=>'auth:partner'], function(){
    Route::get('/', 'SiteController@index'); 
    Route::get('profile', 'PartnerController@profile')->name('partner.profile');
});


/* Administrator authenticate */
Route::group(['prefix'=>'admin'], function(){
    
    // Route::auth();
    Route::get('login', 'Auth\Admin\AuthController@showLoginForm');
    Route::post('login', 'Auth\Admin\AuthController@login');
    Route::get('logout', 'Auth\Admin\AuthController@logout');
    
    // // Registration Routes...
    Route::get('register', 'Auth\Admin\AuthController@showRegistrationForm');
    Route::post('register', 'Auth\Admin\AuthController@register');
    
    // Password Reset Routes...
    // Route::get('password/reset/{token?}', 'Auth\Admin\PasswordController@showResetForm');
    // Route::post('password/email', 'Auth\Admin\PasswordController@sendResetLinkEmail');
    // Route::post('password/reset', 'Auth\Admin\PasswordController@reset');
});

/* Partners authenticate */
Route::group(['prefix'=>'partner'], function(){

    // Route::get('profile', ['middleware'=>'auth', 'uses'=>'PartnerController@profile'])->name('partner.profile');
    Route::post('loginSocial', 'Auth\Partner\AuthController@loginSocial');
    // Authentication Routes...
    // Route::get('login', 'Auth\Partner\AuthController@showLoginForm');
    // Route::post('login', 'Auth\Partner\AuthController@login');
    Route::get('logout', 'Auth\Partner\AuthController@logout');
    // // Registration Routes...
    // Route::get('register', 'Auth\Partner\AuthController@showRegistrationForm');
    // Route::post('register', 'Auth\Partner\AuthController@register');
    
    // Password Reset Routes...
    // Route::get('password/reset/{token?}', 'Auth\Partner\AuthController@showResetForm');
    // Route::post('password/email', 'Auth\Partner\AuthController@sendResetLinkEmail');
    // Route::post('password/reset', 'Auth\Partner\AuthController@reset');
});