<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Mailgun\Mailgun;

class MailgunServiceProvider extends ServiceProvider
{
    /**
     * Register the Mailgun client with the service container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Mailgun::class, function ($app) {
            return Mailgun::create(env('MAILGUN_SECRET', ''));
        });
    }
}