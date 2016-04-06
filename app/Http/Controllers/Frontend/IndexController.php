<?php

namespace StartupsCampfire\Http\Controllers\Frontend;

use StartupsCampfire\Http\Requests;
use StartupsCampfire\Helpers\ViewHelper;

class IndexController extends CommonController
{
    public function index()
    {
        $hot_events = \EventRepository::getHotEvents(6);
        $hot_posts = \PostRepository::getHotPosts(10);
        $index_carousels = \CarouselRepository::getCarouselsList();

        return ViewHelper::frontView('welcome', compact('hot_events', 'hot_posts', 'index_carousels'));
    }
}