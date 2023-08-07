<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TelegramBot;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //create a singleton
        $this->app->singleton('telegram_bot', function(){
            return new TelegramBot();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
