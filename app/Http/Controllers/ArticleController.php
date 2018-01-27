<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ArticleRequest;
use App\Article;
use App\Category;

class ArticleController extends Controller
{
    public function __construct()
    {
        session()->forget('breadcrumbs');
        $this->Breadcrumbs(trans('app.panel'), 'admin.index');
        
        // $this->middleware('auth');
    }
   
    public function index()
    {
        $this->Breadcrumbs(trans('app.article'), 'admin.article.index');
        $articles = Article::with('Category')->orderBy('created_at','desc')->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $this->Breadcrumbs(trans('app.article'), 'admin.article.index');
        $this->Breadcrumbs(trans('app.new'));
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(ArticleRequest $request)
    {
        $article = new Article;
        if(isset($request->main_page)){
            Article::where('main_page', '=', 1)->update(['main_page' => 0]);
        }
        else{
            $article->main_page = 0;
        }
        $article->create($request->all());
        return redirect()->route('admin.article.index')->with('message', 'Новая запись сохранена!');
    }

    public function show(Article $article)
    {
        $this->Breadcrumbs(trans('app.article'), 'admin.article.index');
        $this->Breadcrumbs(trans('app.show'));
        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $this->Breadcrumbs(trans('app.article'), 'admin.article.index');
        $this->Breadcrumbs(trans('app.edit'));
        $categories = Category::all();
        return view('admin.articles.edit', compact('article','categories'));
    }

    public function update(ArticleRequest $request, Article $article)
    {
        if(isset($request->main_page)){
            Article::where('main_page', '=', 1)->update(['main_page' => 0]);
        }
        else{
            $article->main_page = 0;
        }
        $article->update($request->all());
        return redirect()->route('admin.article.index')->with('message', 'Изменения сохранены!');
    }

    public function destroy(Article $article)
    {   
        $article->delete();
        return redirect()->route('admin.article.index')->with(['message'=>'Удаление выполнено!', 'type'=>'success']);
    }
}
