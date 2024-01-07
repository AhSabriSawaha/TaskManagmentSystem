<?php

namespace Modules\TaskManagmentSystem\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Modules\TaskManagmentSystem\app\Enums\TaskStatusEnum;

class Task extends Model
{
    use HasApiTokens, HasFactory;

    protected $guarded = [];

    protected $casts = [
        'status' => TaskStatusEnum::class,
    ];


    // Boot function to listen for model events
    protected static function boot()
    {
        parent::boot();

        // Before deleting, check if the task is 'done'
        static::deleting(function ($task) {
            if ($task->status === (int) TaskStatusEnum::DONE) {
                return false; // Prevent the deletion
            }
        });
    }



    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'comments');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public static function searchAndFilter($searchTerm, $projectTitle)
    {
        $query = Task::query();

        // Filter by task name if $searchTerm is provided
        if (!empty($searchTerm)) {
            $query->where('name', 'LIKE', "%{$searchTerm}%");
        }

        // Filter by project title if $projectTitle is provided
        if (!empty($projectTitle)) {
            $query->whereHas('project', function ($query) use ($projectTitle) {
                $query->where('title', 'LIKE', "%{$projectTitle}%");
            });
        }

        return $query->get();
    }

}
