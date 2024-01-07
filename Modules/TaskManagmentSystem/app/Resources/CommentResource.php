<?php

namespace Modules\TaskManagmentSystem\app\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        // dd('helllo');
        return [
            'id' => $this->id,
            'content' => $this->content,
            'user' => UserResource::make($this->whenLoaded('user')),
        ];
    }
}
