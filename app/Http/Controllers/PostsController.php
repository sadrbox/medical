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
     
    public function show(Post $post){
        // $post = Post::find($id);
        return view('posts.show', compact('post'));
    }
    
    public function create(){
        return view('posts.create');
    }
    
    public function store(Request $request){
        $this->validate(request(), [
            'title'     => 'required|min:2',
            'alias'     => 'required|min:2',
            'preview'   => 'required|min:2',
            'text'      => 'required|min:2',
        ]);
        
        $savePost = Post::create(
            request()->only(['title', 'alias', 'preview', 'text'])
        );
        
        if(isset($savePost)){
            return redirect('/');
        }
        else{}
    }
    
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }
    
    public function update(Post $post){
        $this->validate(request(), [
            'title'     => 'required|min:2',
            'alias'     => 'required|min:2',
            'preview'   => 'required|min:2',
            'text'      => 'required|min:2',
        ]); 
        
        $post->update(request()->only(['title', 'alias', 'preview', 'text']));
        return redirect('/');
    }
    
    public function destroy(Post $post){
        $post->delete();
        return redirect('/');
    }
}
