<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'old_password'  => 'required|string||min:8|max:50',
            'password'  => 'required|string|confirmed|min:8|max:50',
        ];
    }
}
