<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema; //this will use the declared value of Schema on function boot

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191); 

        //this will provide stringlength on your table.
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
