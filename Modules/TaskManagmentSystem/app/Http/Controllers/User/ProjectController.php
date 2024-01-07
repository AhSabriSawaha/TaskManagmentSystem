<?php

namespace Modules\TaskManagmentSystem\app\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Modules\TaskManagmentSystem\app\Data\ProjectData;
use Modules\TaskManagmentSystem\app\Models\Project;
use Modules\TaskManagmentSystem\app\Requests\User\Project\StoreProjectRequest;
use Modules\TaskManagmentSystem\app\Requests\User\Project\UpdateProjectRequest;
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
        $categories = $this->projectService->get();
        return response()->json([
            'data' => ProjectResource::collection($categories)
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
        try {
            $project->delete();

            return response()->json(['data' => 'true']);
        } catch (\Exception $e) {

            // Retrieve the error message based on the application's current locale
            $errorMessage = __("delete_error");

            // Throw a new exception with the localized error message
            throw new \Exception($errorMessage);
        }
    }



}
