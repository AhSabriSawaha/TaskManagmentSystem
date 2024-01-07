<?php

namespace Modules\TaskManagmentSystem\app\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class CommentData extends Data
{
    public function __construct(
        public string|Optional $text,
        public int|Optional $user_id,
        public int|Optional $task_id,
    ) {}
}
