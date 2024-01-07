<?php

namespace Modules\TaskManagmentSystem\app\Requests\User\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'first_name' => ['required',Rule::unique('categories','name')],
            'last_name' => ['required',Rule::unique('categories','name')],
            'role' => ['required',Rule::unique('categories','name')],
            // 'password' => ['required',Rule::unique('categories','name')],
        ];
    }
    public function messages()
{
    return [
        'first_name.required' => __('user_messages.first_name_required'),
        'first_name.unique' => __('user_messages.first_name_unique'),
        'last_name.required' => __('user_messages.last_name_required'),
        'last_name.unique' => __('user_messages.last_name_unique'),
        'role.required' => __('user_messages.role_required'),
        'role.unique' => __('user_messages.role_unique'),
        'password.required' => __('user_messages.password_required'),
        'password.unique' => __('user_messages.password_unique'),
        // ... other custom messages
    ];
}
}
