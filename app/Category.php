<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Category extends Model
{
    protected $fillable = ['title','parent_id'];
    
    public function getParent() {
        return $this->belongsTo(self::class, 'parent_id');
    }    
    
    public function childs() {
        return $this->hasMany(self::class,'parent_id','id');
    }

    public function scopeParents($query)
    {
        //$parents = Category::parents()->get();
        
        return $query->where('parent_id', '=', 0);
    }
    
    public function products() {
        return $this->hasMany('App\Product','category_id','id');
    }    
    public function articles() {
        return $this->hasMany('App\Article','category_id','id');
    }  
    public function pages() {
        return $this->hasMany('App\Page','category_id','id');
    }
}
