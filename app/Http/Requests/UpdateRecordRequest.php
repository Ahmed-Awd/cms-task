<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecordRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $attributes = $this->entity->attributes()->select(["attributes.id","attributes.name","attributes.type"])
            ->get()->toArray();
        $rules = [];
        foreach ($attributes as $one) {
            $rules[$one["name"]] = "required|{$one['type']}";
        }
        return $rules;
    }
}
