<?php

namespace Modules\TaskManagmentSystem\app\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\TaskManagmentSystem\app\Enums\TaskStatusEnum;
use Modules\TaskManagmentSystem\app\Models\Task;
use Modules\TaskManagmentSystem\app\Models\User;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }


    use HandlesAuthorization;

    public function delete(User $user, Task $task)
    {
        if ($task->status === TaskStatusEnum::IN_PROGRESS) {

            throw new \Exception('Tasks that are in progress cannot be deleted.');
        }
        return true;
    }

}
