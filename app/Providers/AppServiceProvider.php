<?php

namespace App\Providers;

use App\Models\Student;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ResetPassword::createUrlUsing(function (Student $student, string $token) {
        //     $url = 'http://localhost:8080/api/v1/reset-password?token='.$token.'&email='.$student->email;
        //     return (new MailMessage)
        //     ->subject(config('app.name') . ': ' . __('Reset Password Request'))
        //     ->greeting(__('Hello!'))
        //     ->line(__('You are receiving this email because we received a password reset request for your account.'))
        //     ->action(__('Reset Password'), $url)
        //     ->line(__('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]))
        //     ->line(__('If you did not request a password reset, no further action is required.'))
        //     ->salutation(__('Regards,') . "\n" . config('app.name') . " Team");
        // });
    }
}
