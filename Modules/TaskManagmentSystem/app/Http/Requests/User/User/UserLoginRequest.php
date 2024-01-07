<?php

namespace Modules\TaskManagmentSystem\app\Requests\User\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserLoginRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('auth_messages.email_required'),
            'email.email' => __('auth_messages.email_email'),
            'password.required' => __('auth_messages.password_required'),
            // ... other custom messages
        ];
    }

}
