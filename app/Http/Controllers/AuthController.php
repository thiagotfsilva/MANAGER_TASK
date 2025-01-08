<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Domain\User\Service\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRegisterRequest;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService) {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function register(UserRegisterRequest $request)
    {
        $validated = $request->validated();
        $user = $this->authService->register($validated);

        $token = auth()->attempt(['email' => $validated['email'], 'password' => $validated['password']]);

        return response()->json([
            'data' => $user,
            'token' => $token,
        ], 201);

    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        if (! $token = auth()->attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
