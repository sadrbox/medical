<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Product extends Model
{
    protected $fillable = ['title','description','category_id','price','img'];
    
    public function Category() {
        return $this->belongsTo('App\Category', 'category_id');
    }       
    
    
}
