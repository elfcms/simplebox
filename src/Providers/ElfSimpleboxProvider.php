<?php

namespace Elfcms\Simplebox\Providers;

use Elfcms\Simplebox\Models\SimpleboxDataType;
use Elfcms\Basic\Http\Middleware\AccountUser;
use Elfcms\Basic\Http\Middleware\AdminUser;
use Elfcms\Basic\Http\Middleware\CookieCheck;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class ElfSimpleboxProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'simplebox');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'simplebox');

        $this->publishes([
            __DIR__.'/../config/simplebox.php' => config_path('elfcms/simplebox.php'),
        ]);

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/elfcms/simplebox'),
        ]);

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/elfcms/simplebox'),
        ]);

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/elfcms/simplebox'),
        ], 'public');

        $startFile = __DIR__.'/../../start.json';
        $firstStart = false;
        if (file_exists($startFile)) {
            $json = File::get($startFile);
            $fileArray = json_decode($json,true);
            if ($fileArray['first_run']) {
                $firstStart = true;
            }
        }
        if ($firstStart) {
            Artisan::call('vendor:publish',['--provider'=>'Elfcms\Simplebox\Providers\ElfSimpleboxProvider','--force'=>true]);
            Artisan::call('migrate');
            if (Schema::hasTable('simplebox_data_types')) {
                $dataTypes = new SimpleboxDataType();
                $dataTypes->start();
            }
            if (unlink($startFile)) {
                //
            }
            elseif (!empty($fileArray)) {
                file_put_contents($startFile,json_encode($fileArray));
            }
        }

        $router->middlewareGroup('admin', array(
            AdminUser::class
        ));

        $router->middlewareGroup('account', array(
            AccountUser::class
        ));

        $router->middlewareGroup('cookie', array(
            CookieCheck::class
        ));

        $this->loadViewComponentsAs('elfcms-simplebox', [
            'box' => \Elfcms\Simplebox\View\Components\Box::class,
        ]);
    }
}
