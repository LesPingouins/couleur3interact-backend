<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|max:50',
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'email' => ['required', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'password' => 'required|string|max:50'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.required' => 'Le username est requis !',
            'firstname.required' => 'Le prénom est requis !',
            'lastname.required' => 'Le nom est requis !',
            'email.required' => "L'email est requis !",
            'password.required' => 'Le mot de passe est requis !'
        ];
    }
}
