<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            'user_name' => 'required',
            'user_email' => [
                'required',
                'email',
                Rule::unique('users', 'user_email')
            ],
            'user_phone' => [
                'required',
                'numeric',
                'digits_between:10,13',
                Rule::unique('users', 'user_phone'),
            ],
            'user_address' => 'required|string',
        ];
    }

    protected function passedValidation(): void
    {
        $this->replace(['user_phone' => '62'.$this->user_phone]);
    }
}
