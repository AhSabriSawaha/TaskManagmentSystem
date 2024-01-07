<?php

namespace Modules\TaskManagmentSystem\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Project extends Model
{
    use HasApiTokens, HasFactory;

    protected $guarded = [];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function invitations()
    {
        return $this->hasMany(ProjectInvitation::class);
    }
}
