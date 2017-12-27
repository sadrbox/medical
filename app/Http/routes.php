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
/*  
    example http requests
    
    GET     /posts              - index posts
    GET     /posts/create       - create posts
    GET     /posts/{id}/edit    - update posts
    POST    /posts              - send form action
    GET     /posts/{id}         - view posts
    PATCH   /posts/{id}         - 
    DELETE  /posts/{id}         - delete posts
*/

Route::get('/', "PostsController@index");
Route::get('/posts/{post}', "PostsController@show"); //->where('post', '\d+');

Route::get('/post/create/', "PostsController@create");
Route::get('/posts/{post}/edit/', "PostsController@edit"); //->where('post', '\d+');
Route::post('/post', "PostsController@store");
Route::patch('/post/{post}', "PostsController@update"); //->where('post', '\d+');
Route::delete('/posts/{post}', "PostsController@destroy"); //->where('post', '\d+');


