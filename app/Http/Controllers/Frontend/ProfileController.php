<?php

namespace StartupsCampfire\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;
use StartupsCampfire\Repositories\ProfileRepository;
use StartupsCampfire\Helpers\ViewHelper;

class ProfileController extends CommonController
{
    protected $profileRepository;

    public function __construct(ProfileRepository $profileRepository)
    {
        // 中间件设置
        $this->middleware('auth', ['only' => ['edit', 'update', 'show']]);

        $this->profileRepository = $profileRepository;
    }

    public function show($user_id = null)
    {
        if (empty($user_id)) {
            $user_id = Auth::id('user');
        }
        $profile = $this->profileRepository->getUserProfile($user_id);
        $user = $profile->user;
        $record_limit = 20; //显示记录条数上限 达到上限显示“更多”按钮
        $posts = $user->posts()->orderBy('created_at', 'desc')->take($record_limit)->get();
        $comments = $user->comments()->orderBy('created_at', 'desc')->take($record_limit)->get();
        $favorites = $user->favoritePosts()->orderBy('created_at', 'desc')->take($record_limit)->get();
        $events = $user->events()->orderBy('created_at', 'desc')->take($record_limit)->get();

        $followings = $user->followings()->orderBy('created_at', 'desc')->take(30)->get();
        $followers = $user->followers()->orderBy('created_at', 'desc')->take(30)->get();

        return ViewHelper::frontView(
            'profiles.show',
            compact('profile', 'user', 'posts',
                'comments', 'events', 'favorites',
                'followings', 'followers', 'record_limit'
            )
        );
    }

    public function edit()
    {
        $user_id = Auth::id('user');
        $profile = $this->profileRepository->getUserProfile($user_id);
        $user = $profile->user;

        return ViewHelper::frontView('profiles.edit', compact('profile', 'user'));
    }

    public function update(Request $request)
    {
        $user_id = Auth::id('user');
        $this->profileRepository->updateUserProfile($user_id, $request);

        return Redirect::route('frontend::user.authprofile');;
    }

}
