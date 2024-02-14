<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'second_name' => 'nullable|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user()->id, 'id')],
            'role' => 'required|string|exists:roles,name'
        ];
    }
}
