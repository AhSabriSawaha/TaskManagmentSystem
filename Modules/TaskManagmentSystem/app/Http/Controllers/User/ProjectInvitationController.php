<?php

namespace Modules\TaskManagmentSystem\app\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Modules\TaskManagmentSystem\app\Data\ProjectInvitationData;
use Modules\TaskManagmentSystem\app\Models\ProjectInvitation;
use Modules\TaskManagmentSystem\app\Requests\User\ProjectInvitation\StoreProjectInvitationRequest;
use Modules\TaskManagmentSystem\app\Resources\ProjectInvitationResource;
use Modules\TaskManagmentSystem\app\Services\ProjectInvitationService;

class ProjectInvitationController extends Controller
{
    public function __construct(
        public ProjectInvitationService $invitationService
    ){}

    public function index()
    {
        $tasks = $this->invitationService->get();

        return response()->json([
            'data' => ProjectInvitationResource::make($tasks)
        ]);
    }

    public function store(StoreProjectInvitationRequest $request)
    {
        $project = $this->invitationService->store(ProjectInvitationData::from($request->validated()));

        return response()->json([
            'data' => ProjectInvitationResource::make($project)
        ]);
    }


    public function show(ProjectInvitation $invitation)
    {
        return response()->json([
            'data' => ProjectInvitationResource::make($invitation)
        ]);
    }

    public function delete(ProjectInvitation $invitation)
    {
        try {
            $invitation->delete();

            return response()->json(['data' => 'true']);
        } catch (\Exception $e) {

            $errorMessage = __("delete_error");

            // Throw a new exception with the localized error message
            throw new \Exception($errorMessage);
        }
    }


}
