<?php

namespace StartupsCampfire\Providers;

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
        // 扩展blade 使用@define标签在模板中设置变量
        Blade::extend(function($value) {
            return preg_replace('/\@define(.+)/', '<?php ${1}; ?>', $value);
        });

        $navigation_tree = app('StartupsCampfire\Repositories\NavigationRepository')->getNodesTree('navigation_tree');
        view()->share('navigation_tree', $navigation_tree);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
