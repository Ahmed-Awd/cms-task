<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttributeRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            "name" => "required|string|min:2|max:50|unique:entities,name",
            "type"  => "required|in:string,numeric,date"
        ];
    }
}
