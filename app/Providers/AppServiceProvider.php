<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

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
        //
        Passport::tokensCan([
            'manage-members' => 'Manage Members',
            'manage-borrowings' => 'Manage Borrowings',
            'manage-books' => 'Manage Books',
            'read-books' => 'Only read books',
        ]);
    }
}
