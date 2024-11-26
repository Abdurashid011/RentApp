<?php

namespace App\Http\Controllers\Api;

use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $users = User::all();

        $userDTO = $users->map(fn($user) => new UserDTO($user->toArray()));

        return response()->json($userDTO);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        $validate = $request->validated();

        $user = User::create($validate);

        $userDTO = new UserDTO($user->toArray());

        return response()->json([
            'message' => 'User created successfully',
            'date'    => $userDTO,
            'token'   => $user->createToken('API Token')->plainTextToken,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $user = $this->findOrFail($id);

        $userDTO = new UserDTO($user->toArray());

        return response()->json($userDTO);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        $user = $this->findOrFail($id);

        $validate = $request->validated();

        $user->update($validate);

        $userDTO = new UserDTO($user->toArray());

        return response()->json([
            'message' => 'User updated successfully',
            'date'    => $userDTO,
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $user = $this->findOrFail($id);

        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully',
        ], 202);
    }

    private function findOrFail(string $id)
    {
        $user = User::query()->find($id);

        if (!$user) {
            abort(response()->json([
                'message' => 'User not found'
            ], 404));
        }

        return $user;
    }
}
