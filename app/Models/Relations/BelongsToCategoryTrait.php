<?php
namespace StartupsCampfire\Models\Relations;

use StartupsCampfire\Models\Category;

trait BelongsToCategoryTrait
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}