<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke($id, $hash): JsonResponse
    {
        try {
            $user = User::findOrFail($id);
            if (!hash_equals(sha1($user->email), (string)$hash)) {
                return response()->json([
                    'error' => "Đường link không tồn tại",
                ], 404);
            }

            if (empty($user->email_verified_at) && $user->markEmailAsVerified()) {
                event(new Verified($user));
            } else {
                return response()->json([
                    'error' => "Đường link không tồn tại",
                ], 404);
            }

            return response()->json([
                'message' => 'Xác thực thành công',
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Đường link không tồn tại',
            ], 404);
        }
    }
}
