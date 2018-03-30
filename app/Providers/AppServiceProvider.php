<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot ()
    {
        \Carbon\Carbon::setLocale('zh');
        \DB::listen(function ($query) {
            Log::info($query->sql . '，耗时：' . $query->time . 'ms' . "\r\n参数:", $query->bindings);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register ()
    {
        //
    }
}
