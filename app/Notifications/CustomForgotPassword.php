<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
class CustomForgotPassword extends ResetPasswordNotification implements ShouldQueue
{
    use Queueable;
}
