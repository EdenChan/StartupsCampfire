<?php
namespace StartupsCampfire\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

/**
 * 处理投票逻辑
 * Many Thanks To https://github.com/summerblue/phphub :)
 *
 * Class VoteHelper
 * @package StartupsCampfire\Helpers
 */
class VoteHelper
{
    public static function upvoteModel(Model $model)
    {
        if ($model->votes()->ByWhom(Auth::id())->WithType('upvote')->count()) {
            // click twice for remove upvote
            $model->votes()->ByWhom(Auth::id())->WithType('upvote')->delete();
            $model->decrement('vote_count', 1);
        } elseif ($model->votes()->ByWhom(Auth::id())->WithType('downvote')->count()) {
            // user already clicked downvote once
            $model->votes()->ByWhom(Auth::id())->WithType('downvote')->delete();
            $model->votes()->create(['user_id' => Auth::id(), 'is' => 'upvote']);
            $model->increment('vote_count', 2);
        } else {
            // first time click
            $model->votes()->create(['user_id' => Auth::id(), 'is' => 'upvote']);
            $model->increment('vote_count', 1);
        }
    }

    public static function downvoteModel(Model $model)
    {
        if ($model->votes()->ByWhom(Auth::id())->WithType('downvote')->count()) {
            // click second time for remove downvote
            $model->votes()->ByWhom(Auth::id())->WithType('downvote')->delete();
            $model->increment('vote_count', 1);
        } elseif ($model->votes()->ByWhom(Auth::id())->WithType('upvote')->count()) {
            // user already clicked upvote once
            $model->votes()->ByWhom(Auth::id())->WithType('upvote')->delete();
            $model->votes()->create(['user_id' => Auth::id(), 'is' => 'downvote']);
            $model->decrement('vote_count', 2);
        } else {
            // click first time
            $model->votes()->create(['user_id' => Auth::id(), 'is' => 'downvote']);
            $model->decrement('vote_count', 1);
        }
    }
}