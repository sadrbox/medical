<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ProductRequest; 
use App\Product;
use App\Category;

use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{
    public function __construct()
    {
        session()->forget('breadcrumbs');
        $this->Breadcrumbs(trans('app.panel'), 'admin.index');
        
        // $this->middleware('auth');
    }
    
    public function index()
    {   
        $this->Breadcrumbs(trans('app.product'), 'admin.product.index');
        $products = Product::with('Category')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $this->Breadcrumbs(trans('app.product'), 'admin.product.index');
        $this->Breadcrumbs(trans('app.new'));
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        if($request->hasFile('image')) {
            $image       = $request->file('image');
            $filename    = time().'.'.$image->getClientOriginalExtension();
        
            $image_resize = Image::make($image->getRealPath());              
            $image_resize->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_resize->save(public_path('img/products/' .$filename));
            $request->merge(['img' => $filename]);
        }
        Product::create($request->all());
        return redirect()->route('admin.product.index')->with('message', 'Новая запись сохранена!');
    }

    public function show(Product $product)
    {
        $this->Breadcrumbs(trans('app.product'), 'admin.product.index');
        $this->Breadcrumbs(trans('app.show'));
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        if(is_file(public_path('img/products/'.$product->img))){
            $product->image = asset('img/products/'.$product->img);
        }
        
        $this->Breadcrumbs(trans('app.product'), 'admin.product.index');
        $this->Breadcrumbs(trans('app.edit'));

        $categories = Category::all();
        return view('admin.products.edit', compact('product','categories'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        if($request->hasFile('image')) {
            
            if($product->img){ /* delete old image */
                $image = public_path('img/products/' .$product->img);
                if(is_file($image)){
                    unlink($image);
                }
            }
            $image       = $request->file('image');
            $filename    = time().'.'.$image->getClientOriginalExtension();
        
            $image_resize = Image::make($image->getRealPath());              
            $image_resize->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_resize->save(public_path('img/products/' .$filename));
            $request->merge(['img' => $filename]);
        }
        $product->update($request->all());
        return redirect()->route('admin.product.index')->with('message', 'Изменения сохранены!');
    }

    public function destroy(Product $product)
    {   
        if($product->img){
            $image = public_path('img/products/' .$product->img);
            if(is_file($image)){
                unlink($image);
            }
        }
        $product->delete();
        return redirect()->route('admin.product.index')->with(['message'=>'Удаление выполнено!', 'type'=>'success']);
    }
}
