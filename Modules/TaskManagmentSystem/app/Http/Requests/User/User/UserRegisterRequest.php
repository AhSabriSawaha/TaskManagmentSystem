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
        ];
    }
    public function messages()
{
    return [
        'email.required' => __('auth_messages.email_required'),
        'email.email' => __('auth_messages.email_email'),
        'email.unique' => __('auth_messages.email_unique'),
        'first_name.required' => __('auth_messages.first_name_required'),
        'first_name.min' => __('auth_messages.first_name_min'),
        'first_name.max' => __('auth_messages.first_name_max'),
        'last_name.required' => __('auth_messages.last_name_required'),
        'last_name.min' => __('auth_messages.last_name_min'),
        'last_name.max' => __('auth_messages.last_name_max'),
        'password.required' => __('auth_messages.password_required'),
        'password.min' => __('auth_messages.password_min'),
        'password.max' => __('auth_messages.password_max'),
        'password.confirmed' => __('auth_messages.password_confirmed'),
        // ... other custom messages
    ];
}
}
