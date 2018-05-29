<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 25/05/18
 * Time: 12:11
 */

namespace Imm\Providers;

use Illuminate\Support\ServiceProvider;
use Imm\Commands\SwaggerGeneratorCommand;
use Imm\Controllers\SwaggerController;

class SwaggerGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/swagger.php' => config_path('swagger.php'),
        ],'swagger');

        $this->app->router->group(['namespace' => 'swagger'], function ($route) {
            $route->get(config('swagger.route'), [
                'as' => 'swagger.docs',
                'middleware' => config('swagger.middleware', []),
                'uses' => SwaggerController::class,
            ]);
        });

        if ($this->app->runningInConsole()) {

            $this->app->singleton('swagger.generator', function () {
                return new SwaggerGeneratorCommand();
            });

            $this->commands([
                'swagger.generator',
            ]);
        }
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/swagger.php', 'swagger'
        );
    }
}