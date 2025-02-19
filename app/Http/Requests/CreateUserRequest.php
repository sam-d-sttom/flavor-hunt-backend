<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|regex:/^(?![.-])(?!.*[_.-]{2})[a-zA-Z0-9._-]{3,30}(?<![.-])$/|unique:users,username',
            'last_name' => 'required|string|regex:/^(?!.*[\'-]{2})(?!.*\s{2})[a-zA-ZÀ-ÖØ-öø-ÿ]+(?:[\'-][a-zA-ZÀ-ÖØ-öø-ÿ]+)?(?:\s[a-zA-ZÀ-ÖØ-öø-ÿ]+(?:[\'-][a-zA-ZÀ-ÖØ-öø-ÿ]+)?)?$/',
            'first_name' => 'required|string|regex:/^(?!.*[\'-]{2})(?!.*\s{2})[a-zA-ZÀ-ÖØ-öø-ÿ]+(?:[\'-][a-zA-ZÀ-ÖØ-öø-ÿ]+)?(?:\s[a-zA-ZÀ-ÖØ-öø-ÿ]+(?:[\'-][a-zA-ZÀ-ÖØ-öø-ÿ]+)?)?$/',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:64|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,64}$/',
        ];
    }
}
