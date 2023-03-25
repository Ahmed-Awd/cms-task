<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEntityRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            "name" => "string|min:2|max:50|unique:entities,name,{$this->entity->id}"
        ];
    }
}
