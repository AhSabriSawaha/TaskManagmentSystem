<?php

namespace Modules\TaskManagmentSystem\app\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class UserData extends Data
{
    public function __construct(
        public string|Optional $first_name,
        public string|Optional $last_name,
        public string|Optional $password,
        public int|Optional $role_id,
    ) {}
}
