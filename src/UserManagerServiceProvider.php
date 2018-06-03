<?php

namespace EduardoArandaH\UserManager;

use Config;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class UserManagerServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Where the route file lives, both inside the package and in the app (if overwritten).
     *
     * @var string
     */
    public $routeFilePath = '/routes/eduardoarandah/usermanager.php';

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // define the routes for the application
        $this->setupRoutes($this->app->router);

         $this->mergeConfigFrom(
            __DIR__.'/config/eduardoarandah/usermanager.php', 'eduardoarandah.usermanager'
        );

        // publish config file
        $this->publishes([__DIR__.'/config' => config_path()], 'config');

        //load translations
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'eduardoarandah');

        // publish translation files
        $this->publishes([__DIR__.'/resources/lang' => resource_path('lang/vendor/eduardoarandah')], 'lang');
    }

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        // by default, use the routes file provided in vendor
        $routeFilePathInUse = __DIR__.$this->routeFilePath;

        // but if there's a file with the same name in routes/eduardoarandah, use that one
        if (file_exists(base_path().$this->routeFilePath)) {
            $routeFilePathInUse = base_path().$this->routeFilePath;
        }

        $this->loadRoutesFrom($routeFilePathInUse);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
