<?php

namespace Modules\TaskManagmentSystem\app\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class TaskData extends Data
{
    public function __construct(
        public string|Optional $name,
        public string|Optional $description,
        public string|Optional $status,
        public string|Optional $dua_date,
        public string|Optional $assingee_id,
        public string|Optional $assinger_id,
        public string|Optional $project_id,
    ) {}
}
