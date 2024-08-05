<?php

namespace App\Providers\Custom;

use Illuminate\Support\ServiceProvider;
use App\Repositories\TimesheetRepository;
use App\Repositories\TaskRepository;
use App\Repositories\Interface\TaskRepositoryInterface;
use App\Repositories\Interface\TimesheetRepositoryInterface;
use Illuminate\Auth\Notifications\ResetPassword;

class CustomServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(
            TimesheetRepositoryInterface::class,
            TimesheetRepository::class
        );
        $this->app->bind(
            TaskRepositoryInterface::class,
            TaskRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });
    }
}
