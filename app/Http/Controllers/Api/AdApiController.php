<?php

namespace App\Http\Controllers\Api;

use App\DTO\AdDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdStoreRequest;
use App\Http\Requests\AdUpdateRequest;
use App\Models\Ad;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $ads = Ad::all();

        $adDTO = $ads->map(fn ($ad) => new AdDTO($ad->toArray()));

        return response()->json($adDTO);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdStoreRequest $request): JsonResponse
    {
        $validate = $request->validated();

        $ad = Ad::create($validate);

        $adDTO = new AdDTO($ad->toArray());

        return response()->json([
            'message' => 'Ad created successfully.',
            'data' => $adDTO
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $ad = $this->findOrFail($id);

        $adDTO = new AdDTO($ad->toArray());

        return response()->json($adDTO);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdUpdateRequest $request, string $id): JsonResponse
    {
        $ad = $this->findOrFail($id);

        $validate = $request->validated();

        $ad->update($validate);

        $adDTO = new AdDTO($ad->toArray());

        return response()->json([
            'message' => 'Ad updated successfully.',
            'data' => $adDTO
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ad = $this->findOrFail($id);

        $ad->delete();

        return response()->json([
            'message' => 'Ad deleted successfully.'
        ], 202);
    }

    private function findOrFail(string $id)
    {
        $ad = Ad::query()->find($id);

        if (!$ad) {
            abort(response()->json([
                'message' => 'User not found'
            ], 404));
        }

        return $ad;
    }
}
