<?php

namespace StartupsCampfire\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use StartupsCampfire\Models\Relations\BelongsToCategoryTrait;
use StartupsCampfire\Models\Relations\BelongsToUserTrait;
use StartupsCampfire\Models\Relations\FavoritedByTrait;
use StartupsCampfire\Models\Relations\MorphManyCommentsTrait;
use StartupsCampfire\Models\Relations\MorphManyNotificationsTrait;
use StartupsCampfire\Models\Relations\MorphManyVotesTrait;

class Post extends AbstractModel
{
    protected $table = 'posts';

    public static $name = 'post';

    use SoftDeletes;

    use BelongsToUserTrait,
        MorphManyCommentsTrait,
        MorphManyVotesTrait,
        FavoritedByTrait,
        MorphManyNotificationsTrait,
        BelongsToCategoryTrait;

    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'content', 'body_parsed', 'user_id', 'category_id'];

    public function beforeDelete()
    {
        $this->deleteFavoritedBy();
        $this->deleteComments();
        $this->deleteVotes();
        $this->deleteNotifications();
    }

}
