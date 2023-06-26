<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $rules = [
            'name' => 'required', 'min:4', 'max:255',
            'email' => 'required', 'min:4', 'max:255', 'email', 'unique:users',
            'password'=> 'required', 'min:2', 'max:255',
        ];

        if($this->method() === 'PATCH'){
            $rules['email'] = [
                'required',
                'min:4',
                'max:255',
                'email',
                Rule::unique('users')->ignore($this->id),
            ];

            $rules['password'] = [
                'nullable',
                'min:6',
                'max:100',
            ];
        }
        return $rules;
    }
}
