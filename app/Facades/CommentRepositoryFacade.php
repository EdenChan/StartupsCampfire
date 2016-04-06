<?php
namespace StartupsCampfire\Facades;

use Illuminate\Support\Facades\Facade;
use StartupsCampfire\Repositories\CommentRepositoryInterface;

class CommentRepositoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CommentRepositoryInterface::class;
    }
}