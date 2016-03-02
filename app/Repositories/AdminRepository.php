<?php
namespace StartupsCampfire\Repositories;

class AdminRepository extends AbstractRepository
{
    public function model()
    {
        return \StartupsCampfire\Models\Admin::class;
    }

}