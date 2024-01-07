<?php

namespace Modules\TaskManagmentSystem\app\Requests\User\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRegisterRequest extends FormRequest
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
            'email' => ['required','email', Rule::unique('users','email')],
            'first_name' => ['required', 'min:2', 'max:255'],
            'last_name' => ['required', 'min:2', 'max:255'],
            'password' => ['required', 'min:4', 'max:8', 'confirmed'],
            'image' => 'required'
        ];
    }
}
