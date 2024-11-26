<?php

use App\Http\Controllers\Api\AdApiController;
use App\Http\Controllers\Api\BranchApiController;
use App\Http\Controllers\Api\StatusApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::post('/tokens/create', function (Request $request) {

    $user = User::query()->create([
        'name'     => $request->name,
        'phone'    => $request->phone,
        'password' => Hash::make($request->password)
    ]);

    $token = $user->createToken('user')->plainTextToken;

    return ['token' => $token];
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/users',  UserApiController::class);

//Route::apiResource('/branches', BranchApiController::class);

Route::apiResource('/branches', BranchApiController::class)->names([
    'index' => 'api.branches.index',
    'store' => 'api.branches.store',
    'show' => 'api.branches.show',
    'update' => 'api.branches.update',
    'destroy' => 'api.branches.destroy',
]);

Route::apiResource('/statuses', StatusApiController::class);

//Route::apiResource('/ads', AdApiController::class);

Route::apiResource('/ads', AdApiController::class)->names([
    'index' => 'api.ads.index',
    'store' => 'api.ads.store',
    'show' => 'api.ads.show',
    'update' => 'api.ads.update',
    'destroy' => 'api.ads.destroy',
]);
