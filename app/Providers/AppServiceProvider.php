<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Repository\UserRepository;
use RecipeRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UserRepository::class, function ($app) {
            return new UserRepository();
        });
        $this->app->singleton(RecipeRepository::class, function ($app) {
            return new RecipeRepository();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       
    }
}
