<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use App\Http\Requests\{
    StoreUserRequest,
    UpdateUserRequest,
};
use Illuminate\Http\{JsonResponse, Request, Response};

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->pivot = $userRepository;
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'data' => $this->pivot->getAllUsers()
        ]);
    }

    public function create()
    {
        //
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        return response()->json(
            [
                'data' => $this->pivot->createUser($request->all())
            ],
            Response::HTTP_CREATED
        );
    }

    public function show(Request $request): JsonResponse
    {
        $userId = $request->route('id');

        return response()->json([
            'data' => $this->pivot->getUserById($userId)
        ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(UpdateUserRequest $request): JsonResponse
    {
        $userId = $request->route('id');

        return response()->json([
            'data' => $this->pivot->updateUser($userId, $request->all())
        ]);
    }

    public function destroy(Request $request): JsonResponse
    {
        $userId = $request->route('id');
        $this->pivot->deleteUser($userId);

        return response()->json([
            'message' => 'The User has been successfully'
        ]);
    }
}
