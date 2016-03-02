<?php

namespace StartupsCampfire\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use StartupsCampfire\Models\Relations\BelongsToUserTrait;
use StartupsCampfire\Models\Relations\MorphManyCommentsTrait;
use StartupsCampfire\Models\Relations\MorphManyVotesTrait;

class Event extends AbstractModel
{
    protected $table = 'events';

    public static $name = 'event';

    use SoftDeletes;

    use BelongsToUserTrait, MorphManyVotesTrait, MorphManyCommentsTrait;

    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'content', 'body_parsed', 'cover', 'brief', 'location', 'user_id', 'start_date', 'end_date', 'is_passed'];

    protected $appends = ['is_passed_text', 'cover_full_path', 'event_user_name'];

    public function getIsPassedTextAttribute()
    {
        $is_passed = $this->attributes['is_passed'];
        $event_state = ['等待审核', '审核通过', '审核不通过'];

        return $event_state[$is_passed];
    }

    public function getCoverFullPathAttribute()
    {
        $cover = $this->attributes['cover'];
        $cover_path = Config::get('filepath.event_cover_path');
        $cover_file_path = public_path($cover_path . $cover);
        $cover_full_path = asset($cover_path . $cover);
        if (!File::exists($cover_file_path)) {
            $cover_full_path = 'http://placehold.it/700x450';
        }

        return $cover_full_path;
    }

    public function getEventUserNameAttribute()
    {
        if ($this->attributes['user_id'] == 0) {
            return '平台发布';
        } else {
            return $this->user->name;
        }
    }

    public function scopeOnline($query)
    {
        return $query->where('start_date', '<', Carbon::now())
            ->where('end_date', '>', Carbon::now())
            ->where('is_passed', 1);
    }

    public function beforeDelete()
    {
        $this->deleteVotes();
    }
}
