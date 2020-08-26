<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $query_count = 0;
        \DB::listen(function ($query) use (&$query_count) {
            $query_count++;
            \Log::debug("[$query_count] ".$query->sql." ".json_encode($query->bindings));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
