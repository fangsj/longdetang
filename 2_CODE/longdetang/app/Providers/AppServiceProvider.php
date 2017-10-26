<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        Blade::directive('dicts', function ($code) {
/*            return "<?php echo dicts($code) ?>";*/
//        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->loadHelpers();
        $this->loadRepository(dirname(__DIR__) . '/Repositorys');
    }

    /**
     * Load helpers.
     */
    protected function loadHelpers()
    {
        foreach (glob(dirname(__DIR__) . '/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }


    /**
     * load repository
     * 支持装载2级装载
     */
    protected function loadRepository($path, $pdir = '')
    {
        foreach (scandir($path) as $file) {
            if ($file == '.' || $file == '..') continue;
            if (is_dir($path . '/' . $file)) {
                self::loadRepository($path . '/' . $file, $file . '\/');
            } else if (starts_with($file, "I")) {
                $interface = basename($file, '.php');
                $clazz = substr($interface, 1);
                $this->app->bind("App\Repositorys\/$pdir$interface", "App\Repositorys\/$pdir$clazz");
            }
        }
    }
}
