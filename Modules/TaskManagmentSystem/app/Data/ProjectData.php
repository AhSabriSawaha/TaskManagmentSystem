<?php

namespace Modules\TaskManagmentSystem\app\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class ProjectData extends Data
{
    public function __construct(
        public string|Optional $title,
        public string|Optional $description,
    ) {}
}
