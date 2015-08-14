<?php

namespace WilsonCreative\NordicGateway;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class NordicGatewayServiceProvider
 * @package WilsonCreative\NordicGateway
 */
class NordicGatewayServiceProvider extends ServiceProvider
{

    /**
     * @var bool
     */
    protected $defer = false;

    /**
     * Start by loading the views
     * Then we'll set the routes
     * And then publish configs
     */
    public function boot()
    {
        $this->loadViewsFrom(realpath(__DIR__ . '/../views'), 'nordicgateway');

        $this->setupRoutes($this->app->router);

        $this->publishes([
            __DIR__ . '/config/nordicgateway.php' => config_path('nordicgateway.php'),
        ]);
    }

    /**
     * @param Router $router
     */
    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'WilsonCreative\NordicGateway\Http\Controllers'], function($router){
            require __DIR__ . '/Http/routes.php';
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerNewsletter();
        config([
            'config/nordicgateway.php'
        ]);
    }

    /**
     *
     */
    public function registerNewsletter()
    {
        $this->app->bind('nordicgateway', function($app) {
            return new NordicGateway($app);
        });

    }
}