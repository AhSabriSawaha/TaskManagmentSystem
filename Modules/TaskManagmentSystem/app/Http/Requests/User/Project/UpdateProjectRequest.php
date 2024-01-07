<?php

namespace Modules\TaskManagmentSystem\app\Requests\User\Project;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
        ];
    }

    public function messages()
{
    return [
        'title.required' => __('project_messages.title_required'),
        'title.min' => __('project_messages.title_min'),
        'title.max' => __('project_messages.title_max'),
        'title.string' => __('project_messages.title_string'),
        'description.max' => __('project_messages.description_max'),
        'description.string' => __('project_messages.description_string'),
        'description.min' => __('project_messages.description_min'),
        // ... other custom messages
    ];
}
}
