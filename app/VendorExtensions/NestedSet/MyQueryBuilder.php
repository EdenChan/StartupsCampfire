<?php
namespace StartupsCampfire\VendorExtensions\NestedSet;

use Kalnoy\Nestedset\QueryBuilder;
use Illuminate\Database\Query\Builder as BaseQueryBuilder;

class MyQueryBuilder extends QueryBuilder
{
    public function withDepth($as = 'depth')
    {
        if ($this->query->columns === null) $this->query->columns = [ '*' ];

        $this->query->selectSub(function (BaseQueryBuilder $q) {
            $table = $this->wrappedTable();
            $db_prefix = env('DB_PREFIX', '');

            list($lft, $rgt) = $this->wrappedColumns();

            $q
                ->selectRaw('count(1) - 1')
                ->from($this->model->getTable().' as _d')
                ->whereRaw("{$table}.{$lft} between {$db_prefix}_d.{$lft} and {$db_prefix}_d.{$rgt}");
        }, $as);

        return $this;
    }
}