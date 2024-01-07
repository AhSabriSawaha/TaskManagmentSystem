<?php

namespace Modules\TaskManagmentSystem\app\Requests\Admin\User;

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
            'first_name' => ['required',Rule::unique('categories','name')],
            'last_name' => ['required',Rule::unique('categories','name')],
            'role' => ['required',Rule::unique('categories','name')],
            'password' => ['required',Rule::unique('categories','name')],
        ];
    }
}
