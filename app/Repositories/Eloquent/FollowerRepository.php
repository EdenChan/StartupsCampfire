<?php
namespace StartupsCampfire\Repositories\Eloquent;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use StartupsCampfire\Events\FollowUser;
use StartupsCampfire\Events\RemoveFollower;
use StartupsCampfire\Events\UnfollowUser;
use StartupsCampfire\Models\User;
use StartupsCampfire\Repositories\FollowerRepositoryInterface;

class FollowerRepository extends AbstractRepository implements FollowerRepositoryInterface
{
    public function model()
    {
        return \StartupsCampfire\Models\Follower::class;
    }

    public function followUser($user_id)
    {
        $input['user_id'] = Auth::id('user');
        $input['follow_id'] = $user_id;
        $this->model->create($input);
        $user_model = User::find($user_id);
        $user_model->increment('followers_count', 1);
        Auth::user('user')->increment('followings_count', 1);

        $follow_id = $user_id;
        $user_id = Auth::id('user');

        Event::fire(new FollowUser($user_id, $follow_id));
    }

    public function unfollowUser($user_id)
    {
        $follow_record = $this->model->where('user_id', Auth::id('user'))
            ->where('follow_id', $user_id)
            ->first();
        $follow_record->delete();
        $user_model = User::find($user_id);
        $user_model->decrement('followers_count', 1);
        Auth::user('user')->decrement('followings_count', 1);

        $follow_id = $user_id;
        $user_id = Auth::id('user');

        Event::fire(new UnfollowUser($user_id, $follow_id));
    }

    public function removeFollower($user_id)
    {
        $follow_record = $this->model->where('user_id', $user_id)
            ->where('follow_id', Auth::id('user'))
            ->first();
        $follow_record->delete();
        $user_model = User::find($user_id);
        $user_model->decrement('followings_count', 1);
        Auth::user('user')->decrement('followers_count', 1);

        $from_user_id = $user_id;
        $user_id = Auth::id('user');

        Event::fire(new RemoveFollower($user_id, $from_user_id));
    }

    public function getPaginatedUserFollowers($user_id, $page_size)
    {
        $user_model = User::find($user_id);

        return $user_model->followers()->orderBy('created_at', 'desc')->paginate($page_size);
    }

    public function getPaginatedUserFollowings($user_id, $page_size)
    {
        $user_model = User::find($user_id);

        return $user_model->followings()->orderBy('created_at', 'desc')->paginate($page_size);
    }
}