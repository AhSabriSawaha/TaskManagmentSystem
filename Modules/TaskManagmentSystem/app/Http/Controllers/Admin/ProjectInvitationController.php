<?php

namespace Modules\TaskManagmentSystem\app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\TaskManagmentSystem\app\Data\ProjectInvitationData;
use Modules\TaskManagmentSystem\app\Models\ProjectInvitation;
use Modules\TaskManagmentSystem\app\Requests\Admin\ProjectInvitation\StoreProjectInvitationRequest;
use Modules\TaskManagmentSystem\app\Resources\ProjectInvitationResource;
use Modules\TaskManagmentSystem\app\Services\ProjectInvitationService;

class ProjectInvitationController extends Controller
{

    public function __construct(
        public ProjectInvitationService $projectInvitationService
    )
    {}

    public function store(StoreProjectInvitationRequest $request)
    {
        $invitation = $this->projectInvitationService->store(ProjectInvitationData::from($request->validated()));

        return response()->json([
            'data' => ProjectInvitationResource::make($invitation)
        ]);
    }
    public function acceptInvitation($token) {
        // Retrieve the invitation by the token
        $invitation = ProjectInvitation::where('token', $token)->first();

        // Check if the invitation exists and hasn't been accepted yet
        if (!$invitation || $invitation->accepted) {
            throw new Exception('Invalid or already accepted invitation');
        } else {
            // Begin a transaction to ensure database consistency
            DB::beginTransaction();
            try {
                // Attach the user to the project (adds a record to the project_user table)
                $invitation->project->users()->attach($invitation->user_id);

                // Delete the invitation record as it's no longer needed
                $invitation->delete();

                // Commit the transaction
                DB::commit();

                // Return a success response or perform additional post-acceptance logic
                // ...
            } catch (\Exception $e) {
                // Rollback the transaction in case of any failure
                DB::rollBack();
                throw $e;  // Re-throw the exception for further handling
            }
        }
    }
}
