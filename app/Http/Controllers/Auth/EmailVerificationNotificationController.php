<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['status' => 'Tài khoản đã xác thực'], Response::HTTP_FORBIDDEN);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json(['status' => 'Email đã được gửi lại']);
    }
}
