<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthenticatedSessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['store']]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        try {
            if (! $token = Auth::attempt(request(['email', 'password']))) {
                return response()->json(['errors' => 'Email hoặc mật khẩu không chính xác'], 401);
            }

            if (!$request->user()->hasVerifiedEmail()) {
                $request->user()->sendEmailVerificationNotification();
            }

            return response()->json([
                'access_token' => $token,
                'expries_in' => auth()->factory()->getTTL() * 60 * 24 * 7,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 402);
        }
    }

    public function getUser(): JsonResponse
    {
        return response()->json([
            'data' => request()->user(),
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse
    {
        Auth::logout();

        return response()->json([]);
    }
}
