<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOperatorRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            "username" => "required|alpha_num|min:8|max:30|unique:users,username",
            "password" => "required|string|min:8|max:30",
            "name" => "required|string|min:5|max:30",
        ];
    }
}
