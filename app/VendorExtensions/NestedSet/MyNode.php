<?php
namespace StartupsCampfire\VendorExtensions\NestedSet;

use Kalnoy\Nestedset\Node;

class MyNode extends Node
{
    public function newEloquentBuilder($query)
    {
        return new MyQueryBuilder($query);
    }
}