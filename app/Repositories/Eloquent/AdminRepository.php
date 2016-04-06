<?php
namespace StartupsCampfire\Repositories\Eloquent;

use StartupsCampfire\Repositories\AdminRepositoryInterface;

class AdminRepository extends AbstractRepository implements AdminRepositoryInterface
{
    public function model()
    {
        return \StartupsCampfire\Models\Admin::class;
    }

}