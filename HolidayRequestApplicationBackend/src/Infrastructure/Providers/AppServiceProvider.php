<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\HolidayRequestPolicy;
use App\Services\HolidayRequestService;
use App\Services\ValidationService;
use App\Repositories\HolidayRequestRepository;
use App\Repositories\HolidayRequestRepositoryInterface;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register bindings here
        $this->app->bind(HolidayRequestRepositoryInterface::class, HolidayRequestRepository::class);
        $this->app->bind(HolidayRequestService::class, function ($app) {
            return new HolidayRequestService(
                $app->make(HolidayRequestRepositoryInterface::class)
            );
        });

        $this->app->bind(ValidationService::class, function ($app) {
            return new ValidationService(
                $app->make(HolidayRequestRepositoryInterface::class)
            );
        });

        // Optional: You could bind other services or repositories as needed
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // If you are using a custom policy for user roles or any specific functionality
        Gate::define('approve-holiday-request', function (User $user) {
            return $user->hasRole('validator');
        });

        // If you're working with longer column names or specific database engine (e.g., MySQL 8+)
        Schema::defaultStringLength(191);
    }
}
?>