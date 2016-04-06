<?php
namespace StartupsCampfire\Repositories\Eloquent;

use Illuminate\Support\Facades\Config;
use StartupsCampfire\Repositories\ProfileRepositoryInterface;
use StartupsCampfire\Helpers\FileHelper;

class ProfileRepository extends AbstractRepository implements ProfileRepositoryInterface
{
    public function model()
    {
        return \StartupsCampfire\Models\Profile::class;
    }

    /**
     * 获取用户信息
     *
     * @param $user_id
     * @return mixed
     */
    public function getUserProfile($user_id)
    {
        $model = $this->model;
        $profile = $model::where('user_id', $user_id)
            ->firstOrFail();

        return $profile;
    }

    /**
     * 更新用户信息
     *
     * @param $user_id
     * @param $data
     */
    public function updateUserProfile($user_id, $data)
    {
        $input = $data;
        $profile = $this->getUserProfile($user_id);

        //更新头像图片
        $avatar_path = public_path(Config::get('filepath.avatar_path'));
        $new_files_info = ['avatar' => $avatar_path];
        $old_files_info = [$profile->avatar => $avatar_path];
        $input = FileHelper::replaceFiles($new_files_info, $old_files_info, $input);

        $profile->update($input);
    }
}