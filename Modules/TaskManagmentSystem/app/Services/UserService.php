<?php

namespace Modules\TaskManagmentSystem\app\Services;

use Modules\TaskManagmentSystem\app\Models\User;
use Modules\TaskManagmentSystem\app\Data\UserData;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserService
{
    public function get()
    {
        return QueryBuilder::for(User::query())
            ->allowedFilters([
                'name',
                AllowedFilter::exact('id')
            ])
            ->paginate();
    }

    public function store(UserData $data)
    {
        return User::create($data->toArray());
    }

    public function update(UserData $data,User $User)
    {
        $User->update($data->toArray());

        return $User;
    }



// filter[name]=ahmad
// filter[id]=1

// localhost:8000/api/admins/categories/index?filter[name]=ahmad&filter[id]=1

    public function getByCredentials($userData)
    {
//        dd($userData->toArray());
        if (auth()->attempt($userData->only('email', 'password')->toArray())) {
            return auth()->user();
        }
        return null;
    }

    public function revokeCurrentToken(User $user)
    {
        $user->token()->revoke();
    }

    public function grantAuthToken(User $user)
    {
        $user['accessToken'] = $user->createToken('Api Token', [$user->role->name])->accessToken;
        return $user;
    }
}
