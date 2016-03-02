<?php

namespace StartupsCampfire\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Navigation extends AbstractNodeModel
{
    protected $table = 'navigations';

    public static $name = 'navigation';

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['order', 'name', 'url', 'parent_id', '_lft', '_rgt'];

    protected $appends = ['nav_depth'];

    public function getNavDepthAttribute()
    {
        $self_model = Navigation::withDepth()->find($this->id);
        return $self_model->depth;
    }

}
