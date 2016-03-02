<?php

namespace StartupsCampfire\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Follower extends AbstractModel
{
    protected $table = 'followers';

    public static $name = 'follower';

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id', 'follow_id'];

}
