<?php

namespace Modules\TaskManagmentSystem\app\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd($this->toArray());

        return [

            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'due_date' => $this->due_date,
            'assignee' => UserResource::make($this->whenLoaded('assignee')),
            'assigner' => UserResource::make($this->whenLoaded('assigner')),
            'project' => ProjectResource::make($this->whenLoaded('project')),
        ];
    }
}
