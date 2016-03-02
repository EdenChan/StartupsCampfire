<?php
namespace StartupsCampfire\Models;


use Illuminate\Database\Eloquent\SoftDeletes;
use StartupsCampfire\Models\Relations\BelongsToPostTrait;
use StartupsCampfire\Models\Relations\BelongsToUserTrait;

class Favorite extends AbstractModel
{
    protected $table = 'favorites';

    public static $name = 'favorite';

    use BelongsToPostTrait, BelongsToUserTrait;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id', 'post_id'];

}
