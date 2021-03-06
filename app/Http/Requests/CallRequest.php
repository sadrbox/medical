<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CallRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'phone' => 'required|min:11',
            // 'done' => 'required',
        ];
    }
}
