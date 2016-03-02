<?php

namespace StartupsCampfire\Composers;

use Illuminate\Contracts\View\View;
use StartupsCampfire\Repositories\NavigationRepository;

/**
 * 站点导航视图组件
 *
 * Class NavigationComposer
 * @package StartupsCampfire\Composers
 */
class NavigationComposer
{
    protected $navigationRepository;

    public function __construct(NavigationRepository $navigationRepository)
    {
        $this->navigationRepository = $navigationRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $navigation_tree = $this->navigationRepository->getNodesTree('navigation_tree');
        $view->with('navigation_tree', $navigation_tree);
    }
}