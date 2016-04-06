<?php
namespace StartupsCampfire\Facades;

use Illuminate\Support\Facades\Facade;
use StartupsCampfire\Repositories\CarouselRepositoryInterface;

class CarouselRepositoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CarouselRepositoryInterface::class;
    }
}