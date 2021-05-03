<?php

namespace App\Modules\Web\Providers;

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
        $this->loadTranslationsFrom(module_path('web', 'Resources/Lang', 'app'), 'web');
        $this->loadViewsFrom(module_path('web', 'Resources/Views', 'app'), 'web');
        $this->loadMigrationsFrom(module_path('web', 'Database/Migrations', 'app'));
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('web', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('web', 'Database/Factories', 'app'));
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
