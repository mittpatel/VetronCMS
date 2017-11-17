<?php

namespace App\Providers;

use Event;
use App\Events;
use Illuminate\Support\Str;
use App\Services\PluginManager;
use Illuminate\Support\ServiceProvider;

class PluginServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *该方法在所有服务提供者被注册以后才会被调用
     * @return void
     */
    public function boot(PluginManager $plugins)
    {
        // store paths of class files of plugins
        $src_paths = [];

        $loader = $this->app->make('translation.loader');
        // make view instead of view.finder since the finder is defined as not a singleton
        $finder = $this->app->make('view');
		
        foreach ($plugins->getPlugins() as $plugin) {
        	
            if ($plugin->isEnabled()) {            	
            	//是否启用，启用将加载核心类库
                $src_paths[$plugin->getNameSpace()] = $plugin->getPath()."/src";
                // add paths of views
                $finder->addNamespace($plugin->getNameSpace(), $plugin->getPath()."/views");
            }

            // always add paths of translation files for namespace hints
            $loader->addNamespace($plugin->getNameSpace(), $plugin->getPath()."/lang");
        }

        $this->registerPluginCallbackListener();
        $this->registerClassAutoloader($src_paths);

        $bootstrappers = $plugins->getEnabledBootstrappers();

        foreach ($bootstrappers as $file) {
            $bootstrapper = require $file;
            // call closure using service container
            $this->app->call($bootstrapper);
        }
    }

    protected function registerPluginCallbackListener()
    {
        Event::listen([
            Events\PluginWasInstall::class,
            Events\PluginWasEnabled::class,
            Events\PluginWasDeleted::class,
            Events\PluginWasDisabled::class,
        ], function ($event) {
            // call callback functions of plugin
            if (file_exists($filename = $event->plugin->getPath()."/callbacks.php")) {
                $callbacks = require $filename;

                $callback = array_get($callbacks, get_class($event));

                return $callback ? app()->call($callback, [$event->plugin]) : null;
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    	//绑定事物，必须的，一个服务容器，用于后面代码的依赖注入
        $this->app->singleton('plugins', PluginManager::class);
    }

    /**
     * Register class autoloader for plugins.
     *
     * @return void
     */
    protected function registerClassAutoloader($paths)
    {
        spl_autoload_register(function ($class) use ($paths) {
            // traverse in registered plugin paths
            foreach ((array) array_keys($paths) as $namespace) {
                if ($namespace != '' && mb_strpos($class, $namespace) === 0) {
                    // parse real file path
                    $path = $paths[$namespace].Str::replaceFirst($namespace, '', $class).".php";
                    $path = str_replace('\\', '/', $path);
					
                    if (file_exists($path)) {
                        // include class file if it exists
                        include $path;
                    }
                }
            }
        });
    }
}
