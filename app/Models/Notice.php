<?php

namespace StartupsCampfire\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use StartupsCampfire\Models\Relations\BelongsToUserTrait;
use StartupsCampfire\Models\Relations\MorphManyCommentsTrait;

class Notice extends AbstractModel
{
    protected $table = 'notices';

    public static $name = 'notice';

    use SoftDeletes;

    use BelongsToUserTrait, MorphManyCommentsTrait;

    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'content', 'body_parsed', 'start_date', 'end_date'];

    protected $appends = ['is_passed_text', 'cover_full_path', 'event_user_name'];

}
