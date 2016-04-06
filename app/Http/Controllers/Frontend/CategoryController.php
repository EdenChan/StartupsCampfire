<?php

namespace StartupsCampfire\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Input;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Helpers\ViewHelper;

class CategoryController extends CommonController
{
    public function show($url_tag)
    {
        $category = \CategoryRepository::findWhere(['url_tag' => $url_tag])->first();
        $child_categories_ids = \CategoryRepository::getChildNodesKeys($category->id);
        $filter = Input::get('filter');
        $posts = \PostRepository::getPaginatedCategoryPosts($child_categories_ids, 10, $filter);
        $hot_posts = \PostRepository::getHotPosts(10);

        return ViewHelper::frontView('categories.show', compact('posts', 'category', 'hot_posts'));
    }
}
