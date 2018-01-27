<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title','text','category_id','main_page','navigation','user_id'];
    
    public function getParent() {
        return $this->belongsTo(self::class, 'parent_id');
    }    
    
    public function childs() {
        return $this->hasMany(self::class,'parent_id','id');
    }
    
    public function Category() {
        return $this->belongsTo('App\Category', 'category_id');
    }       
    
    public function User() {
        return $this->belongsTo('App\User', 'user_id');
    } 
}
