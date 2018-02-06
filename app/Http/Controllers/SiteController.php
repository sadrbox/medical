<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\Category;
use App\Article;
use App\Page;
use App\Product;
use App\Call;
use App\Http\Requests\CallRequest;


class SiteController extends Controller
{

    public function __construct()
    {
        session()->forget('breadcrumbs');
        $this->Breadcrumbs(trans('app.main'), 'site.index');
    }

    public function index()
    {
        $articles = Article::orderBy('created_at','desc')->limit(5)->get();
        $main_page = Page::where('main_page', true)->first();
        $main_article = Article::where('main_page', true)->first();
        return view('home', compact('articles', 'main_page', 'main_article'));
    }

    public function article(Category $category)
    {
        $title = trans('app.article');
        $this->Breadcrumbs($title, 'site.article');
        $categories = Category::with('articles')->get();
        if(isset($category->id)){
            $articles = Article::with('Category')->where('category_id', '=', $category->id)->paginate(5);
            $this->Breadcrumbs($category->title);
        }
        else{
            $articles = Article::with('Category')->orderBy('created_at','desc')->paginate(5);
        }
        return view('site.article.index', compact('articles', 'categories', 'title'));
    }
    
    public function articleShow(Article $article)
    {
        $title = $article->title;
        $this->Breadcrumbs(trans('app.article'), 'site.article');
        if(isset($article->category->id)){
            $this->Breadcrumbs($article->category->title, 'site.article', ['category'=>$article->category->id]);
        }
        $this->Breadcrumbs($title);
        return view('site.article.show', compact('article','title'));
    }    
    
    public function pageShow(Page $page)
    {
        $title = $page->title;
        $this->Breadcrumbs($title);
        return view('site.page.show', compact('page','title'));
    }    
    
    /***************/
    public function product(Category $category)
    {
        $title = trans('app.product');
        $this->Breadcrumbs($title, 'site.product');
        $categories = Category::with('products')->parents()->get();
        if(isset($category->id)){
            $products = Product::with('Category')->where('category_id', '=', $category->id)->paginate(10);
            $this->Breadcrumbs($category->title);
        }
        else{
            $products = Product::with('Category')->paginate(10);
        }
        return view('site.product.index', compact('products', 'categories', 'title'));
    }
    
    public function productShow(Product $product)
    {
        $title = $product->title;
        $this->Breadcrumbs(trans('app.product'), 'site.product');
        if(isset($product->category->id)){
            $this->Breadcrumbs($product->category->title, 'site.product', ['category'=>$product->category->id]);
        }
        $this->Breadcrumbs($title);
        return view('site.product.show', compact('product','title'));
    }
    
    public function formCallMe()
    {
        return view('site.template.call');
    }
    
    public function queryCallMe(Request $request)
    {
        // 'name' => 'required',
        // 'phone' => 'required|min:11',
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|min:11',
        ]);

        if ($validator->fails()) {
            return redirect('site/')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        Call::create($request->all());
        return redirect()->route('site.formcallme')->with('message', 'Ожидайте звнока.<br> Мы обязательно Вам перезвоним!');
    }
    
}
