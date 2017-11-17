<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use App\Events\ConfigureRoutes;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot(Router $router) {
        //

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map(Router $router) {
        $this->mapAdminWebRoutes();
        $this->mapHomeWebRoutes();
        $this->mapApiRoutes();
        
		//触发插件的路由设置
		event(new ConfigureRoutes($router));
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAdminWebRoutes() {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/webAdmin.php');
        });
    }

    protected function mapHomeWebRoutes() {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/webHome.php');
        });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes() {
        Route::group([
            'middleware' => 'api',
            'namespace' => $this->namespace,
            'prefix' => 'api',
        ], function ($router) {
            require base_path('routes/api.php');
        });
    }
}
