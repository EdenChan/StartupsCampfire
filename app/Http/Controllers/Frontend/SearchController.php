<?php

namespace StartupsCampfire\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Input;
use StartupsCampfire\Helpers\ViewHelper;
use StartupsCampfire\Repositories\EventRepository;
use StartupsCampfire\Repositories\PostRepository;
use StartupsCampfire\Repositories\UserRepository;

class SearchController extends CommonController
{
    protected $postRepository;
    protected $eventRepository;
    protected $userRepository;

    public function __construct(
        PostRepository $postRepository,
        EventRepository $eventRepository,
        UserRepository $userRepository
    )
    {
        $this->postRepository = $postRepository;
        $this->eventRepository = $eventRepository;
        $this->userRepository = $userRepository;
    }

    public function getSearch()
    {
        $filter = Input::get('q');

        $posts = $this->postRepository->getPaginatedModels($page_size = 10, $filter);
        $hot_posts = $this->postRepository->getHotPosts(10);

        return ViewHelper::frontView('search.posts_index', compact('posts', 'hot_posts'));
    }

    public function getUsersResult()
    {
        $filter = Input::get('q');

        $users = $this->userRepository->getPaginatedModels($page_size = 20, $filter);
        $hot_posts = $this->postRepository->getHotPosts(10);

        return ViewHelper::frontView('search.users_index', compact('users', 'hot_posts'));
    }

    public function getEventsResult()
    {
        $filter = Input::get('q');

        $events = $this->eventRepository->getPaginatedEvents($page_size = 10, $filter);
        $hot_events = $this->eventRepository->getHotEvents(10);

        return ViewHelper::frontView('search.events_index', compact('events', 'hot_events'));
    }
}