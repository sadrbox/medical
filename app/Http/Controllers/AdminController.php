<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Category;
use App\Article;
use App\Page;
use App\Product;
use App\Call;
use App\Partner;

use Intervention\Image\ImageManagerStatic as Image;

class AdminController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        session()->forget('breadcrumbs');
        $this->Breadcrumbs('Панель управления', 'admin.index');
    }

    public function index()
    {
        $articles = Article::with('Category')->orderBy('created_at','desc')->limit(5)->get();
        $calls = Call::orderBy('done')->limit(5)->get();        
        $partners = Partner::orderBy('created_at','desc')->limit(5)->get();
        
        
        return view('admin.index', compact('articles', 'calls', 'partners'));
    }
    
    public function upload(Request $request)
    {
        if($request->hasFile('image')) {
            $image      = $request->file('image');
            $filename   = time().'.'.$image->getClientOriginalExtension();
        
            $make_image = Image::make($image->getRealPath());              
            $make_image->save(public_path('/img/content/' .$filename));
            
            if(is_file(public_path('img/content/'.$filename))){
                $imgUrl = asset('img/content/'.$filename);
            }
            else{
                // return false;
            }
        
            $response   = [
                    'name'=> $filename,
                    'url' => $imgUrl,
                    // 'url' => preg_replace('#^https?://#', '', $imgUrl),
                ]; 
            return json_encode($response);
        }
    }
}
