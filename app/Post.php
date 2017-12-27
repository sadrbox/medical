<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";
    // protected $primaryKey = "id";
    
    protected $fillable = ['title','alias','preview','text'];   // $fillable - массовое назначение, massive assignable
    // protected $guarded = ['title','alias','preview','text']; // $guarded - защищенные поля
    
    public function getRouteKeyName()
    {
        return 'alias';
    }
}
