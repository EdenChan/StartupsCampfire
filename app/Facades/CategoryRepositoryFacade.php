<?php
namespace StartupsCampfire\Facades;

use Illuminate\Support\Facades\Facade;
use StartupsCampfire\Repositories\CategoryRepositoryInterface;

class CategoryRepositoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CategoryRepositoryInterface::class;
    }
}