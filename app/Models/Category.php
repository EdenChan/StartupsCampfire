<?php

namespace StartupsCampfire\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use StartupsCampfire\Models\Relations\HasManyPostsTrait;

class Category extends AbstractNodeModel
{
    protected $table = 'categories';

    public static $name = 'category';

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['content', 'url_tag', 'seo_desc', 'parent_id', '_lft', '_rgt'];

    use HasManyPostsTrait;

    protected $appends = ['cat_depth'];

    public function getCatDepthAttribute()
    {
        $self_model = Category::withDepth()->find($this->id);
        return $self_model->depth;
    }

}
