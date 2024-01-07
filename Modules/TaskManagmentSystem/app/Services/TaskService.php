<?php

namespace Modules\TaskManagmentSystem\app\Services;

use App\Models\User;
use Exception;
use Modules\TaskManagmentSystem\app\Models\Task;
use Modules\TaskManagmentSystem\app\Data\TaskData;
use Modules\TaskManagmentSystem\app\Enums\TaskStatusEnum;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskService
{

public function get()
{
//  dd('hai');
    return QueryBuilder::for(Task::query())
        ->allowedFilters([
            AllowedFilter::callback('title', function ($query, $value) {
                $query->where('title', 'LIKE', "%$value%");
            }),
            AllowedFilter::callback('assigner', function ($query, $value) {
                $query->whereHas('assigner', function ($query) use ($value) {
                    $query->where('name', 'LIKE', "%$value%");
                });
            }),
            AllowedFilter::callback('assignee', function ($query, $value) {
                $query->whereHas('assignee', function ($query) use ($value) {
                    $query->where('name', 'LIKE', "%$value%");
                });
            }),
            AllowedFilter::callback('project_title', function ($query, $value) {
                $query->whereHas('project', function ($query) use ($value) {
                    $query->where('title', 'LIKE', "%$value%");
                });
            }),
        ])
        ->get();
            // dd($d);
}


public function getByUser(User $user)
{
    return Task::query()->where('assignee_id',$user->id)
    ->orWhere('assigner_id',$user->id)
    ->get();
}

    public function store(TaskData $data)
    {
        return Task::create($data->toArray());
    }

    public function update(TaskData $data,Task $task)
    {

        if ($task->status !== TaskStatusEnum::IN_PROGRESS) {
            throw new Exception('Task cannot be edited.');
        }

        $task->update($data->toArray());

        return $task;
    }
}

