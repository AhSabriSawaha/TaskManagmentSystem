<?php

namespace Modules\TaskManagmentSystem\app\Requests\User\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
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
            'title' => ['required', 'min:2', 'max:20', 'string'],
            'description' => ['nullable', 'max:50', 'string', 'min:2'],
            'due_date' => ['nullable', 'date'],
            'status' => ['required'],
            'assignee_id' => ['required', Rule::exists('users', 'id')],
            // 'assigner_id' => ['required', Rule::exists('users', 'id')],
        ];
    }
    public function messages()
{
    return [
        'name.required' => __('task_messages.name_required'),
        'name.min' => __('task_messages.name_min'),
        'name.max' => __('task_messages.name_max'),
        'name.string' => __('task_messages.name_string'),
        'description.max' => __('task_messages.description_max'),
        'description.string' => __('task_messages.description_string'),
        'description.min' => __('task_messages.description_min'),
        'due_date.date' => __('task_messages.due_date_date'),
        'status.required' => __('task_messages.status_required'),
        'assignee_id.required' => __('task_messages.assignee_id_required'),
        'assignee_id.exists' => __('task_messages.assignee_id_exists'),
        'file.required' => __('task_messages.file_required'),
        // ... other custom messages
    ];
}
}
