<?php

namespace Modules\TaskManagmentSystem\app\Http\Requests\Admin\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
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
            'name' => ['required', 'min:2', 'max:20', 'string'],
            'description' => ['nullable', 'max:50', 'string', 'min:2'],
            'due_date' => ['nullable', 'date'],
            'status' => ['required'],
            'assignee_id' => ['required', Rule::exists('users', 'id')],
            // 'assigner_id' => ['required', Rule::exists('users', 'id')],
        ];
    }
}
