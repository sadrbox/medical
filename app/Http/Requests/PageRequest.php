<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PageRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules() 
    {
        return [
            'title' => 'required',
            'text' => 'required',
            'category_id' => 'required',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'main_page' => 'boolean', 
            'navigation' => 'boolean',
            'user_id' => 'required',
        ];
    }
}
