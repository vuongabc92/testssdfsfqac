<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use App\Helpers\Blade;
use App\Validations\Activated;
use App\Validations\CheckRoute;
use App\Helpers\Validation;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Carbon;
use App\Jobs\SendVerifyEmailJob;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadHelpers();

        new Activated();
        new CheckRoute();
        new Blade();
        new Validation();

        $this->sendVerifyEmailMail();
    }
	
	/**
     * Load helper functions
     */
    protected function loadHelpers()
    {
        require_once __DIR__ . '/../Helpers/functions.php';
    }

    private function sendVerifyEmailMail() {
        VerifyEmail::toMailUsing(function ($notifiable) {
            $emailJob = (new SendVerifyEmailJob($notifiable))->delay(Carbon::now()->addSeconds(3));
            dispatch($emailJob);
        });
    }
}
