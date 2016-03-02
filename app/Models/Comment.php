<?php

namespace StartupsCampfire\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use StartupsCampfire\Models\Relations\BelongsToPostTrait;
use StartupsCampfire\Models\Relations\BelongsToUserTrait;
use StartupsCampfire\Models\Relations\HasManyNotificationsTrait;
use StartupsCampfire\Models\Relations\MorphManyVotesTrait;
use StartupsCampfire\Models\Relations\MorphToCommentTrait;

class Comment extends AbstractModel
{
    protected $table = 'comments';

    public static $name = 'comment';

    use SoftDeletes;

    use BelongsToUserTrait, MorphToCommentTrait, MorphManyVotesTrait, HasManyNotificationsTrait;

    protected $dates = ['deleted_at'];

    protected $fillable = ['body', 'body_parsed', 'user_id', 'post_id', 'is_block', 'vote_count', 'commentable_id', 'commentable_type'];

    public function beforeDelete()
    {
        $this->deleteVotes();
        $this->deleteNotifications();
    }

}
