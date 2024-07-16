<?php

namespace App\Modules\Lag\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(module_path('lag', 'Resources/Lang', 'app'), 'lag');
        $this->loadViewsFrom(module_path('lag', 'Resources/Views', 'app'), 'lag');
        $this->loadMigrationsFrom(module_path('lag', 'Database/Migrations', 'app'));
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('lag', 'Config', 'app'));
        }
        //$this->loadFactoriesFrom(module_path('lag', 'Database/Factories', 'app'));
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
