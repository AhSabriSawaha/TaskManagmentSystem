<?php

namespace Modules\TaskManagmentSystem\app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\TaskManagmentSystem\app\Data\ProjectData;
use Modules\TaskManagmentSystem\app\Http\Requests\Admin\Project\StoreProjectRequest;
use Modules\TaskManagmentSystem\app\Http\Requests\Admin\Project\UpdateProjectRequest;
use Modules\TaskManagmentSystem\app\Models\Project;
use Modules\TaskManagmentSystem\app\Resources\ProjectResource;
use Modules\TaskManagmentSystem\app\Services\ProjectService;

class ProjectController extends Controller
{
    public function __construct(
        public ProjectService $projectService
    )
    {}
    public function index()
    {
        $projects = $this->projectService->get();
        return response()->json([
            'data' => ProjectResource::collection($projects)
        ]);
    }


    public function show(Project $Project)
    {
        return response()->json([
            'data' => ProjectResource::make($Project)
        ]);
    }


    public function store(StoreProjectRequest $request)
    {
        $project = $this->projectService->store(ProjectData::from($request->validated()));

        return response()->json([
            'data' => ProjectResource::make($project)
        ]);
    }

    public function update(UpdateProjectRequest $request,Project $project)
    {
        $Project = $this->projectService->update(ProjectData::from($request->validated()),$project);

        return response()->json([
            'data' => ProjectResource::make($project)
        ]);
    }

    public function delete(Project $project)
    {
        $project->delete();

        return response()->json([
            'data' => 'true'
        ]);
    }



}
