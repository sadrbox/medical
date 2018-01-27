<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\PageRequest;
use App\Page;
use App\Category;

class PageController extends Controller
{
    public function __construct()
    {
        session()->forget('breadcrumbs');
        $this->Breadcrumbs('Панель управления', 'admin.index');
    }
   
    public function index()
    {
        $this->Breadcrumbs('Страницы', 'admin.page.index');
        $pages = Page::with('Category')->paginate(10);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        $this->Breadcrumbs('Страницы', 'admin.page.index');
        $this->Breadcrumbs('Новый');
        $categories = Category::all();
        return view('admin.pages.create', compact('categories')); 
    }

    public function store(PageRequest $request)
    {
        $page = new Page;
        if(isset($request->main_page)){
            Page::where('main_page', '=', 1)->update(['main_page' => 0]);
        }
        else{
            $page->main_page = 0;
        }
        $page->navigation = (isset($request->navigation)) ? 1 : 0;
        $page->create($request->all());
        return redirect()->route('admin.page.index')->with('message', 'Новая запись сохранена!');
    }

    public function show(Page $page)
    {
        $this->Breadcrumbs('Страницы', 'admin.page.index');
        $this->Breadcrumbs('Просмотр');
        return view('admin.pages.show', compact('page'));
    }

    public function edit(Page $page)
    {
        $this->Breadcrumbs('Страницы', 'admin.page.index');
        $this->Breadcrumbs('Редактирование');
        $categories = Category::all();
        return view('admin.pages.edit', compact('page','categories'));
    }

    public function update(PageRequest $request, Page $page)
    {
        if(isset($request->main_page)){
            Page::where('main_page', '=', 1)->update(['main_page' => 0]);
        }
        else{
            $page->main_page = 0;
        }
        $page->navigation = (isset($request->navigation)) ? 1 : 0;
        $page->update($request->all());
        return redirect()->route('admin.page.index')->with('message', 'Изменения сохранены!');
    }

    public function destroy(Page $page)
    {   
        $page->delete();
        return redirect()->route('admin.page.index')->with(['message'=>'Удаление выполнено!', 'type'=>'success']);
    }

}
