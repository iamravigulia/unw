<?php

namespace edgewizz\unw;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class UnwServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Edgewizz\Unw\Controllers\UnwController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // dd($this);
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadViewsFrom(__DIR__ . '/components', 'unw');
        Blade::component('unw::unw.open', 'unw.open');
        Blade::component('unw::unw.index', 'unw.index');
        Blade::component('unw::unw.edit', 'unw.edit');
    }
}
