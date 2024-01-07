<?php

namespace Modules\TaskManagmentSystem\app\Requests\User\ProjectInvitation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectInvitationRequest extends FormRequest
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
            'user_id' => ['required', Rule::exists('users', 'id')],
            'project_id' => ['required', Rule::exists('projects', 'id')],
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => __('project_invitation_messages.user_id_required'),
            'user_id.exists' => __('project_invitation_messages.user_id_exists'),
            'user_id.not_in' => __('project_invitation_messages.user_id_not_in'),
            'user_id.different' => __('project_invitation_messages.user_id_different'),
            'project_id.required' => __('project_invitation_messages.project_id_required'),
            'project_id.exists' => __('project_invitation_messages.project_id_exists'),
            // ... other custom messages
        ];
    }
}
