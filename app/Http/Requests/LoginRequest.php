<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'username'                => 'required|string|min:3|max:50',
            'password'                => 'required|string|min:3|max:50',
            'role'                      => 'required|in:admin,operator'
        ];
    }
}
