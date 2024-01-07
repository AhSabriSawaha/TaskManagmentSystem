<?php

namespace Modules\TaskManagmentSystem\app\Services;

use Modules\TaskManagmentSystem\app\Models\Comment;
use Modules\TaskManagmentSystem\app\Data\CommentData;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CommentService
{
    public function get()
    {
        // dd('helllo');
        return QueryBuilder::for(Comment::query())
            ->allowedFilters([
                AllowedFilter::exact('id')
            ])
            ->paginate();
    }

    public function store(CommentData $data)
    {
        return Comment::create($data->toArray());
    }

    public function update(CommentData $data,Comment $comment)
    {
        $comment->update($data->toArray());

        return $comment;
    }
}

