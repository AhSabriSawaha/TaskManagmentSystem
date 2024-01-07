<?php

namespace Modules\TaskManagmentSystem\app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Modules\TaskManagmentSystem\app\Data\TaskData;
use Modules\TaskManagmentSystem\app\Models\Task;
use Modules\TaskManagmentSystem\app\Http\Requests\Admin\Task\StoreTaskRequest;
use Modules\TaskManagmentSystem\app\Http\Requests\Admin\Task\UpdateTaskRequest;
use Modules\TaskManagmentSystem\app\Resources\TaskResource;
use Modules\TaskManagmentSystem\app\Services\FileService;
use Modules\TaskManagmentSystem\app\Services\TaskService;

class TaskController extends Controller
{
    public function __construct(
        public TaskService $taskService
    ){}

    public function index()
    {
        $tasks = $this->taskService->get();

        return response()->json([
            'data' => TaskResource::collection($tasks)
        ]);
    }


    public function show(Task $task)
    {
        return response()->json([
            'data' => TaskResource::make($task)
        ]);
    }

    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();
        // assigner id is the auth user

        $validated['assinger_id'] = auth()->user()->id;

        // dd($validated);
        $file = $validated['file'];

        $task = $this->taskService->store(TaskData::from($request->validated()));

        FileService::uploadFile($task, $file, 'files');

        return response()->json([
            'data' => TaskResource::make($task)
        ]);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        // assigner id is the auth user id\

        try {
            $validated = $request->validated();
            $validated['assinger_id'] = auth()->user()->id;
            $task = $this->taskService
            ->update(TaskData::from($validated),$task);

            return response()->json([
                'data' => TaskResource::make($task)
            ]);
        } catch (Exception $e) {
            // Catch the exception thrown by the service and return an appropriate response
            return response()->json(['message' => $e->getMessage()], 403);
        }

    }

    public function delete(Task $task)
    {
            $task->delete();

            return response()->json(['data' => 'true']);
    }

}
