<?php

namespace Modules\TaskManagmentSystem\app\Services;
use Illuminate\Support\Str;
use Modules\TaskManagmentSystem\app\Data\ProjectInvitationData;
use Modules\TaskManagmentSystem\app\Models\ProjectInvitation;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProjectInvitationService
{
    public function get()
    {
        return QueryBuilder::for(ProjectInvitation::query())
            ->allowedFilters([
                AllowedFilter::exact('id')
            ])
            ->paginate();
    }

    public function store(ProjectInvitationData $data)
    {
        $token =  Str::random(32);
        $data['token'] = $token;
        $data['accepted'] = false;
        return ProjectInvitation::create($data->toArray());
    }

    public function update(ProjectInvitationData $data, ProjectInvitation $invitation)
    {
        $invitation->update($data->toArray());

        return $invitation;
    }
}

