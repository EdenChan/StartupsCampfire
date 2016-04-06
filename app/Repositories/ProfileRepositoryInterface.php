<?php
namespace StartupsCampfire\Repositories;

interface ProfileRepositoryInterface extends BaseRepositoryInterface
{
    public function getUserProfile($user_id);

    public function updateUserProfile($user_id, $data);
}