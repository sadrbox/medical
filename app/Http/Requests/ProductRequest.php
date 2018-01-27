<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductRequest extends Request
{

    public function authorize()
    {
        return true;
    }

    public function rules() 
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'price' => 'required',
        ];
    }
}
