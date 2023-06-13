<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PollStoreRequest extends FormRequest
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
            'name_of' => 'required',
            'question' => 'required|string|max:50',
            'duration' => 'required|integer',
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
            'name_of.required' => 'Le titre est requis !',
            'question.required' => 'La question est requise',
            'duration.required' => 'La durée est requise',
            'duration.integer' => 'La durée doit être au format numérique, ex. (60)',
        ];
    }
}
