<?php
namespace StartupsCampfire\Providers;

use Illuminate\Support\ServiceProvider;
use StartupsCampfire\Repositories\AdminRepositoryInterface;
use StartupsCampfire\Repositories\CarouselRepositoryInterface;
use StartupsCampfire\Repositories\CategoryRepositoryInterface;
use StartupsCampfire\Repositories\CommentRepositoryInterface;
use StartupsCampfire\Repositories\Eloquent\AdminRepository;
use StartupsCampfire\Repositories\Eloquent\CarouselRepository;
use StartupsCampfire\Repositories\Eloquent\CategoryRepository;
use StartupsCampfire\Repositories\Eloquent\CommentRepository;
use StartupsCampfire\Repositories\Eloquent\EventRepository;
use StartupsCampfire\Repositories\Eloquent\FavoriteRepository;
use StartupsCampfire\Repositories\Eloquent\FollowerRepository;
use StartupsCampfire\Repositories\Eloquent\NavigationRepository;
use StartupsCampfire\Repositories\Eloquent\NoticeRepository;
use StartupsCampfire\Repositories\Eloquent\NotificationRepository;
use StartupsCampfire\Repositories\Eloquent\PostRepository;
use StartupsCampfire\Repositories\Eloquent\ProfileRepository;
use StartupsCampfire\Repositories\Eloquent\UserRepository;
use StartupsCampfire\Repositories\EventRepositoryInterface;
use StartupsCampfire\Repositories\FavoriteRepositoryInterface;
use StartupsCampfire\Repositories\FollowerRepositoryInterface;
use StartupsCampfire\Repositories\NavigationRepositoryInterface;
use StartupsCampfire\Repositories\NoticeRepositoryInterface;
use StartupsCampfire\Repositories\NotificationRepositoryInterface;
use StartupsCampfire\Repositories\PostRepositoryInterface;
use StartupsCampfire\Repositories\ProfileRepositoryInterface;
use StartupsCampfire\Repositories\UserRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
    }
    /**
     * Register the application services.
     */
    public function register()
    {
        app()->singleton(AdminRepositoryInterface::class, AdminRepository::class);
        app()->singleton(CarouselRepositoryInterface::class, CarouselRepository::class);
        app()->singleton(CategoryRepositoryInterface::class, CategoryRepository::class);
        app()->singleton(CommentRepositoryInterface::class, CommentRepository::class);
        app()->singleton(EventRepositoryInterface::class, EventRepository::class);
        app()->singleton(FavoriteRepositoryInterface::class, FavoriteRepository::class);
        app()->singleton(FollowerRepositoryInterface::class, FollowerRepository::class);
        app()->singleton(NavigationRepositoryInterface::class, NavigationRepository::class);
        app()->singleton(NoticeRepositoryInterface::class, NoticeRepository::class);
        app()->singleton(NotificationRepositoryInterface::class, NotificationRepository::class);
        app()->singleton(PostRepositoryInterface::class, PostRepository::class);
        app()->singleton(ProfileRepositoryInterface::class, ProfileRepository::class);
        app()->singleton(UserRepositoryInterface::class, UserRepository::class);
    }
}