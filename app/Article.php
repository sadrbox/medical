<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title','text','category_id','main_page','user_id'];
    
    public function Category() {
        return $this->belongsTo('App\Category', 'category_id');
    }       
    
    public function User() {
        return $this->belongsTo('App\User', 'user_id');
    }   
}
