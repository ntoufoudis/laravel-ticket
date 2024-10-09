<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLabelRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:30',
                'unique:labels,name',
            ],
            'slug' => [
                'required',
                'string',
                'min:3',
                'max:30',
                'unique:labels,slug',
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
