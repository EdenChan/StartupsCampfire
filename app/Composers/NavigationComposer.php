<?php

namespace StartupsCampfire\Composers;

use Illuminate\Contracts\View\View;

/**
 * 站点导航视图组件
 *
 * Class NavigationComposer
 * @package StartupsCampfire\Composers
 */
class NavigationComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $navigation_tree = \NavigationRepository::getNodesTree('navigation_tree');
        $view->with('navigation_tree', $navigation_tree);
    }
}