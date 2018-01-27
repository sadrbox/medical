<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CategoryRequest;
use App\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        session()->forget('breadcrumbs');
        $this->Breadcrumbs(trans('app.panel'), 'admin.index');
    }
    
    public function index()
    {   
        $this->Breadcrumbs(trans('app.category'), 'admin.category.index');
        $categories = Category::with('getParent')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $this->Breadcrumbs(trans('app.category'), 'admin.category.index');
        $this->Breadcrumbs(trans('app.new'));
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->all());
        return redirect()->route('admin.category.index')->with('message', 'Новая запись сохранена!');
    }

    public function show(Category $category)
    {
        $this->Breadcrumbs(trans('app.category'), 'admin.category.index');
        $this->Breadcrumbs(trans('app.show'));
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $this->Breadcrumbs(trans('app.category'), 'admin.category.index');
        $this->Breadcrumbs(trans('app.edit'));
        $categories = Category::where('id', '<>', $category->id)->get();
        return view('admin.categories.edit', compact('category','categories'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        return redirect()->route('admin.category.index')->with('message', 'Изменения сохранены!');
    }

    public function destroy(Category $category)
    {
        $childs = Category::where('parent_id', '=', $category->id)->get();
        if(count($childs) > 0 || count($category->products) > 0){
            return redirect()->route('admin.category.index')->with(['message'=>'Не возможно удалить! '.$category->title.' имеет подчиненные группы или товары!', 'type'=>'danger']);
        }
        else{
            $category->delete();
            return redirect()->route('admin.category.index')->with(['message'=>'Удаление выполнено!', 'type'=>'success']);
        }
    }
}
