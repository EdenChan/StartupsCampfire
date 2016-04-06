<?php
namespace StartupsCampfire\Repositories;


interface FollowerRepositoryInterface extends BaseRepositoryInterface
{
    public function followUser($user_id);

    public function unfollowUser($user_id);

    public function removeFollower($user_id);

    public function getPaginatedUserFollowers($user_id, $page_size);

    public function getPaginatedUserFollowings($user_id, $page_size);
}