<?php
namespace StartupsCampfire\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use StartupsCampfire\Models\Relations\MorphToVoteTrait;

class Vote extends AbstractModel
{
    protected $table = 'votes';

    public static $name = 'vote';

    use MorphToVoteTrait;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id', 'votable_id', 'votable_type', 'is'];

    public function scopeByWhom($query, $user_id)
    {
        return $query->where('user_id', '=', $user_id);
    }

    public function scopeWithType($query, $type)
    {
        return $query->where('is', '=', $type);
    }
}
