<?php

namespace Modules\TaskManagmentSystem\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Modules\TaskManagmentSystem\app\Enums\RoleEnum;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->singleFile();
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'comments');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function isAdmin()
    {
        return $this->role === RoleEnum::ADMIN;
    }
}
