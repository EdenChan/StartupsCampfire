<?php

namespace StartupsCampfire\Models;

use StartupsCampfire\VendorExtensions\NestedSet\MyNode;

abstract class AbstractNodeModel extends MyNode
{
    protected $guarded = ['_token', '_method'];
}