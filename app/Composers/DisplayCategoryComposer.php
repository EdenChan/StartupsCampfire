<?php

namespace StartupsCampfire\Composers;

use Illuminate\Contracts\View\View;

/**
 * 用于展示整理后的分类树数据(去除内容为空的节点)
 *
 * Class DisplayCategoryComposer
 * @package StartupsCampfire\Composers
 */
class DisplayCategoryComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $post_model = \PostRepository::makeModel();
        $display_category_tree = \CategoryRepository::getDisplayNodesTree('category_tree', $post_model, 'category_id');

        $view->with('display_category_tree', $display_category_tree);
    }
}