<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_phone' => substr($this->user_phone, 0, 2),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('id');
        return [
            'user_name' => 'required',
            'user_email' => [
                'required',
                'email',
                Rule::unique('users', 'user_email')->exclude($id)
            ],
            'user_phone' => [
                'required',
                'numeric',
                Rule::unique('users', 'user_phone')->exclude($id),
                'digits_between:10,13',
            ],
            'user_address' => 'required|string',
        ];
    }

    protected function passedValidation(): void
    {
        $this->replace(['user_phone' => '62'.$this->user_phone]);
    }
}
