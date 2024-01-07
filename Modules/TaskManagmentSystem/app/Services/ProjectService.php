<?php

namespace Modules\TaskManagmentSystem\app\Services;

use Modules\TaskManagmentSystem\app\Models\Project;
use Modules\TaskManagmentSystem\app\Data\ProjectData;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProjectService
{
    public function get()
    {
        return QueryBuilder::for(Project::class)
        ->allowedFilters([
            AllowedFilter::callback('title', function ($query, $value) {
                $query->where('title', 'LIKE', "%$value%");
            }),
            AllowedFilter::callback('task_title', function ($query, $value) {
                $query->whereHas('tasks', function ($query) use ($value) {
                    $query->where('title', 'LIKE', "%$value%");
                });
            }),
        ])
        ->paginate();
    }

    public function store(ProjectData $data)
    {
        return Project::create($data->toArray());
    }

    public function update(ProjectData $data,Project $project)
    {
        $project->update($data->toArray());

        return $project;
    }
}

