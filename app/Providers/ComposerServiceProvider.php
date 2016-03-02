<?php

namespace StartupsCampfire\Providers;

use Illuminate\Support\ServiceProvider;
use StartupsCampfire\Composers\CategoryComposer;
use StartupsCampfire\Composers\DisplayCategoryComposer;
use StartupsCampfire\Composers\NavigationComposer;
use StartupsCampfire\Composers\NoticesComposer;
use StartupsCampfire\Composers\NotificationsComposer;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'front.partials.category_tree_display',
            DisplayCategoryComposer::class
        );
        view()->composer([
                'front.partials.category_tree_select',
                'back.partials.category_tree_select',
            ],
            CategoryComposer::class
        );
        view()->composer([
            'back.partials.navigation_tree_select',
        ],
            NavigationComposer::class
        );
        view()->composer([
                'front.partials.navbar',
            ],
            NotificationsComposer::class
        );
        view()->composer([
            'front.partials.sidebar_notices',
        ],
            NoticesComposer::class
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
