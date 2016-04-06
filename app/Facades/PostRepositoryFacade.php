<?php
namespace StartupsCampfire\Facades;

use Illuminate\Support\Facades\Facade;
use StartupsCampfire\Repositories\PostRepositoryInterface;

class PostRepositoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PostRepositoryInterface::class;
    }
}