<?php

namespace App\Providers;

use Inertia\Inertia;
use Faker\Factory as FakerFactory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

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
        $this->app->singleton(\Faker\Generator::class, function () {
            return FakerFactory::create('zh_TW');
        });

        // 監看有無登入，header 登入註冊/會員中心
        Inertia::share([
            'auth.user' => function () {
                return Auth::user();
            },
        ]);
    }
}
