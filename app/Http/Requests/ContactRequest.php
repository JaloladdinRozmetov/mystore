<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        // если доступно всем пользователям, даже гостям:
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'phone'       => 'required|string|max:50',
            'description' => 'nullable|string|max:1000',
        ];
    }
}
