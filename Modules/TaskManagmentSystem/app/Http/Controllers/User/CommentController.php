<?php

namespace Modules\TaskManagmentSystem\app\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Modules\TaskManagmentSystem\app\Data\CommentData;
use Modules\TaskManagmentSystem\app\Models\Comment;
use Modules\TaskManagmentSystem\app\Requests\User\Comment\UpdateCommentRequest;
use Modules\TaskManagmentSystem\app\Resources\CommentResource;
use Modules\TaskManagmentSystem\app\Services\CommentService;

class CommentController extends Controller
{
    public function __construct(
        public CommentService $commentService
    )
    {}
    public function index()
    {
        $comments = $this->commentService->get();

        return response()->json([
            'data' => CommentResource::collection($comments)
        ]);
    }


    public function show(Comment $comment)
    {
        return response()->json([
            'data' => CommentResource::make($comment)
        ]);
    }


    public function store( $request)
    {
        $comment = $this->commentService->store(CommentData::from($request->validated()));

        return response()->json([
            'data' => CommentResource::make($comment)
        ]);
    }

    public function update(UpdateCommentRequest $request,Comment $comment)
    {
        $comment = $this->commentService->update(CommentData::from($request->validated()),$comment);

        return response()->json([
            'data' => CommentResource::make($comment)
        ]);
    }

    public function delete(Comment $comment)
    {
        $comment->delete();

        return response()->json([
            'data' => 'true'
        ]);
    }
}
