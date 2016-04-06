<?php

namespace StartupsCampfire\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Redirect;
use StartupsCampfire\Http\Requests;

class FavoriteController extends CommonController
{
    /**
     * 收藏用户动态
     *
     * @param $post_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getAddFavoritePost($post_id)
    {
        \FavoriteRepository::addFavoritePost($post_id);

        return Redirect::back();
    }
}
