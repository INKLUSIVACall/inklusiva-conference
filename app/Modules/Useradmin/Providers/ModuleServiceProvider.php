<?php

namespace App\Modules\Useradmin\Providers;

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
        $this->loadTranslationsFrom(module_path('useradmin', 'Resources/Lang', 'app'), 'useradmin');
        $this->loadViewsFrom(module_path('useradmin', 'Resources/Views', 'app'), 'useradmin');
        $this->loadMigrationsFrom(module_path('useradmin', 'Database/Migrations', 'app'));
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('useradmin', 'Config', 'app'));
        }
        //$this->loadFactoriesFrom(module_path('useradmin', 'Database/Factories', 'app'));
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
