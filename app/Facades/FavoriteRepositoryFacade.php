<?php
namespace StartupsCampfire\Facades;

use Illuminate\Support\Facades\Facade;
use StartupsCampfire\Repositories\FavoriteRepositoryInterface;

class FavoriteRepositoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return FavoriteRepositoryInterface::class;
    }
}