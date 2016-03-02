<?php

namespace StartupsCampfire\Models;

use Illuminate\Database\Eloquent\Model;
use StartupsCampfire\Models\ModelTraits\BaseModelTrait;

abstract class AbstractModel extends Model
{
    use BaseModelTrait;

    protected $guarded = ['_token', '_method'];
}