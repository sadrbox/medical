<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PartnerRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // 'title' => 'required',
            // 'parent_id' => 'required',
        ];
    }
}
