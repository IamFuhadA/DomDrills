<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
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

    public function boot(): void
    {
        if (config('app.env') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Custom Email Verification Notification with Caution Notice & DomDrills Branding
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verify Email Address - DomDrills')
                ->greeting("Hello {$notifiable->name},")
                ->line('Please click the button below to verify your email address.')
                ->action('Verify Email Address', $url)
                ->line('If you did not create an account, no further action is required.')
                ->line('----------------------------------------')
                ->line('CAUTION NOTICE:')
                ->line('Please take note that all the payments are done personally. If someone impersonates us and mails or contacts you at any other time, please avoid it and contact us for verifying if it is genuine or not. For any loss by jumping into it, we are not responsible.')
                ->line('----------------------------------------')
                ->salutation("Regards,\nDomDrills Team");
        });

        // Custom Password Reset Notification with Caution Notice & DomDrills Branding
        ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));

            return (new MailMessage)
                ->subject('Reset Password Notification - DomDrills')
                ->greeting("Hello {$notifiable->name},")
                ->line('You are receiving this email because we received a password reset request for your account.')
                ->action('Reset Password', $url)
                ->line('This password reset link will expire in 60 minutes.')
                ->line('If you did not request a password reset, no further action is required.')
                ->line('----------------------------------------')
                ->line('CAUTION NOTICE:')
                ->line('Please take note that all the payments are done personally. If someone impersonates us and mails or contacts you at any other time, please avoid it and contact us for verifying if it is genuine or not. For any loss by jumping into it, we are not responsible.')
                ->line('----------------------------------------')
                ->salutation("Regards,\nDomDrills Team");
        });
    }
}
