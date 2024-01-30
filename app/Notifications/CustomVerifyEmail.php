<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends VerifyEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        if (static::$createUrlCallback) {
            return call_user_func(static::$createUrlCallback, $notifiable);
        }
        $frontEndUrl = config('app.frontend_url');
        $id = $notifiable->getKey();
        $hash = sha1($notifiable->getEmailForVerification());
        $timeStamps = Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60))->timestamp;
       $url = "{$frontEndUrl}/verify-email/{$id}/{$hash}?expires={$timeStamps}";
//         $url = "localhost:9000/api/verify-email/{$id}/{$hash}?expires={$timeStamps}";

        return $url;
    }
}
