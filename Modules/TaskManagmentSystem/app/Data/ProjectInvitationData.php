<?php

namespace Modules\TaskManagmentSystem\app\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class ProjectInvitationData extends Data
{
    public function __construct(
        public string|Optional $token,
        public bool|Optional $accepted,
        public int|Optional $user_id,
        public int|Optional $project_id,
    ) {}
}
