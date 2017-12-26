<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Post;

class PostsController extends Controller
{
    public function index(){ 
        $posts = Post::all();
        return view('index', compact('posts'));
    }
    
    public function view($id){
        $post = Post::find($id);
        return view('posts.view', compact('post'));
    }
    
    public function create(){
        return view('posts.create');
    }
}
