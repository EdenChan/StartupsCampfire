<?php

namespace StartupsCampfire\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Input;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Repositories\CategoryRepository;
use StartupsCampfire\Repositories\PostRepository;
use StartupsCampfire\Helpers\ViewHelper;

class CategoryController extends CommonController
{
    protected $categoryRepository;
    protected $postRepository;

    public function __construct(CategoryRepository $categoryRepository, PostRepository $postRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->postRepository = $postRepository;
    }


    public function show($url_tag)
    {
        $category = $this->categoryRepository->findWhere(['url_tag' => $url_tag])->first();
        $child_categories_ids = $this->categoryRepository->getChildNodesKeys($category->id);
        $filter = Input::get('filter');
        $posts = $this->postRepository->getPaginatedCategoryPosts($child_categories_ids, 10, $filter);
        $hot_posts = $this->postRepository->getHotPosts(10);

        return ViewHelper::frontView('categories.show', compact('posts', 'category', 'hot_posts'));
    }

}
