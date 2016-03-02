<?php

namespace StartupsCampfire\Http\Controllers\Frontend;

use StartupsCampfire\Http\Requests;
use StartupsCampfire\Helpers\ViewHelper;
use StartupsCampfire\Jobs\SendReminderEmail;
use StartupsCampfire\Models\User;
use StartupsCampfire\Repositories\CarouselRepository;
use StartupsCampfire\Repositories\EventRepository;
use StartupsCampfire\Repositories\PostRepository;

class IndexController extends CommonController
{
    protected $postRepository;
    protected $eventRepository;
    protected $carouselRepository;

    public function __construct(PostRepository $postRepository, EventRepository $eventRepository, CarouselRepository $carouselRepository)
    {
        $this->postRepository = $postRepository;
        $this->eventRepository = $eventRepository;
        $this->carouselRepository = $carouselRepository;
    }

    public function index()
    {
        $hot_events = $this->eventRepository->getHotEvents(6);
        $hot_posts = $this->postRepository->getHotPosts(10);
        $index_carousels = $this->carouselRepository->getCarouselsList();

        return ViewHelper::frontView('welcome', compact('hot_events', 'hot_posts', 'index_carousels'));
    }

    public function sendEmail()
    {
        $user = User::find(1);
        for ($i = 0; $i < 3; $i++) {
            $this->dispatch(new SendReminderEmail($user));
        }
        dd('success');
    }
}