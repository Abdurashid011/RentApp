<?php

namespace App\Http\Controllers\Api;

use App\DTO\BranchDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\BranchStoreRequest;
use App\Http\Requests\BranchUpdateRequest;
use App\Models\Branch;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BranchApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $branches = Branch::all();

        $branchDTO = $branches->map(fn ($branch) => new BranchDTO($branch->toArray()));

        return response()->json($branchDTO);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BranchStoreRequest $request): JsonResponse
    {
        $validate = $request->validated();

        $branch = Branch::create($validate);

        $branchDTO = new BranchDTO($branch->toArray());

        return response()->json([
            'message' => 'Branch created successfully',
            'data' => $branchDTO
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $branch = $this->findOrFail($id);

        $branchDTO = new BranchDTO($branch->toArray());

        return response()->json($branchDTO);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BranchUpdateRequest $request, string $id): JsonResponse
    {
        $branch = $this->findOrFail($id);

        $validate = $request->validated();

        $branch->update($validate);

        $branchDTO = new BranchDTO($branch->toArray());

        return response()->json([
            'message' => 'Branch updated successfully',
            'data' => $branchDTO
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $branch = $this->findOrFail($id);

        $branch->delete();

        return response()->json([
            'message' => 'Branch deleted successfully'
        ], 202);
    }

    private function findOrFail(string $id)
    {
        $branch = Branch::query()->find($id);

        if (!$branch) {
            abort(response()->json([
                'message' => 'User not found'
            ], 404));
        }

        return $branch;
    }
}
