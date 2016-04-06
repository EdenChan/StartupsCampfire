<?php

namespace StartupsCampfire\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Input;
use StartupsCampfire\Helpers\ViewHelper;

class SearchController extends CommonController
{
    public function getSearch()
    {
        $filter = Input::get('q');

        $posts = \PostRepository::getPaginatedModels($page_size = 10, $filter);
        $hot_posts = \PostRepository::getHotPosts(10);

        return ViewHelper::frontView('search.posts_index', compact('posts', 'hot_posts'));
    }

    public function getUsersResult()
    {
        $filter = Input::get('q');

        $users = \UserRepository::getPaginatedModels($page_size = 20, $filter);
        $hot_posts = \PostRepository::getHotPosts(10);

        return ViewHelper::frontView('search.users_index', compact('users', 'hot_posts'));
    }

    public function getEventsResult()
    {
        $filter = Input::get('q');

        $events = \EventRepository::getPaginatedEvents($page_size = 10, $filter);
        $hot_events = \EventRepository::getHotEvents(10);

        return ViewHelper::frontView('search.events_index', compact('events', 'hot_events'));
    }
}