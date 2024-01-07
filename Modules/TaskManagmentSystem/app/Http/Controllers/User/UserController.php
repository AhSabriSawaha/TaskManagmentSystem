<?php

namespace Modules\TaskManagmentSystem\app\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\TaskManagmentSystem\app\Data\UserData;
use Modules\TaskManagmentSystem\app\Enums\RoleEnum;
use Modules\TaskManagmentSystem\app\Resources\UserResource;
use Modules\TaskManagmentSystem\app\Services\UserService;
use Modules\TaskManagmentSystem\app\Models\User;
use Modules\TaskManagmentSystem\app\Requests\Admin\User\UpdateUserRequest;
use Modules\TaskManagmentSystem\app\Requests\Admin\User\UserLoginRequest;
use Modules\TaskManagmentSystem\app\Requests\User\User\UserRegisterRequest;
use Modules\TaskManagmentSystem\app\Services\ImageService;

class UserController extends Controller
{
    public function __construct(
        public UserService $userService
    ){}

    public function index(Request $request)
    {
        $users = $this->userService->getByCredentials($request->all());

        return response()->json([
            'success' => true,
            'message' => 'all users',
            'data' => UserResource::collection($users)
        ]);

    }
    public function login(UserLoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            // If authentication was successful, retrieve the user.
            $user = Auth::user();
            $user = $this->userService->grantAuthToken($user);

            // Return a success response with the user data and a new token.
            return response()->json([
                'success' => true,
                'message' => 'Logged in successfully',
                'data' => UserResource::make($user)
            ]);
        }

        // If authentication fails, send a response indicating the failure.
        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials'
        ]);
    }

    public function logout(Request $request)
    {
        // Assuming token-based authentication (like JWT or Passport)
        $token = $request->user()->token();
        $token->revoke(); // Revoke the token to effectively log the user out.

        // Return a success response indicating the user was logged out.
        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
    }


    public function show(User $user)
    {
        return response()->json([
            'success' => true,
            'message' => 'one user success',
            'data' => UserResource::make($user)
        ]);
    }


    public function register(UserRegisterRequest $request)
    {
        $data = $request->validated();
        $data['role_id'] = RoleEnum::USER;

        $img = $data['image'];

        ImageService::uploadImage($img, $data, 'files');

        $user = $this->userService->store(
            UserData::from($data)
        );
        $user = $this->userService->grantAuthToken($user);
        return response()->json([
            'success' => true,
            'message' => 'registered successfully',
            'data' => UserResource::make($user)
        ]);
    }
    // public function store(StoreUserRequest $request)
    // {
    //     $user = $this->userService->store(UserData::from($request->validated()));

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Logged out successfully',
    //         'data' => UserResource::make($user),
    //     ]);
    // }

    // public function update(UpdateUserRequest $request,User $user)
    // {
    //     $user = $this->userService->update(UserData::from($request->validated()),$user);

    //     return response()->json([
    //         'data' => UserResource::make($user)
    //     ]);
    // }

    public function update(UpdateUserRequest $request, User $user)
    {
        // Check if the old password is provided and is correct
        if ($request->filled('old_password') && !Hash::check($request->input('old_password'), $user->password)) {
            return response()->json(['message' => __('auth_messages.old_password_incorrect')]);
        }

        // If a new password is provided, hash it and set it
        if ($request->filled('new_password')) {
            $validatedData = $request->validated();
            $validatedData['password'] = Hash::make($request->input('new_password'));
            $user = $this->userService->update(UserData::from($validatedData), $user);
        } else {
            $user = $this->userService->update(UserData::from($request->validated()), $user);
        }

        return response()->json([
            'data' => UserResource::make($user)
        ]);
    }


    public function delete(User $user)
    {
        $user->delete();

        return response()->json([
            'data' => 'true'
        ]);
    }



}
