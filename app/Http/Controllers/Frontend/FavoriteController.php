<?php

namespace StartupsCampfire\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Redirect;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Repositories\FavoriteRepository;

class FavoriteController extends CommonController
{
    protected $favoriteRepository;

    public function __construct(FavoriteRepository $favoriteRepository)
    {
        $this->middleware('auth');

        $this->favoriteRepository = $favoriteRepository;
    }


    /**
     * 收藏用户动态
     *
     * @param $post_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getAddFavoritePost($post_id)
    {
        $this->favoriteRepository->addFavoritePost($post_id);

        return Redirect::back();
    }
}
