<?php

namespace StartupsCampfire\Composers;

use Illuminate\Contracts\View\View;
use StartupsCampfire\Repositories\CategoryRepository;

/**
 * 用于展示完整的分类树数据(包含内容为空的节点)
 *
 * Class CategoryComposer
 * @package StartupsCampfire\Composers
 */
class CategoryComposer
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $category_tree = $this->categoryRepository->getNodesTree('category_tree');
        $view->with('category_tree', $category_tree);
    }
}