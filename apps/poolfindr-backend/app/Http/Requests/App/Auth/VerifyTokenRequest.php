<?php

namespace App\Http\Requests\App\Auth;

use Illuminate\Foundation\Http\FormRequest;

class VerifyTokenRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'token' => 'required',
            'email' => 'required|email'
        ];
    }
}
