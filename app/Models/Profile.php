<?php

namespace StartupsCampfire\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use StartupsCampfire\Models\Relations\BelongsToUserTrait;

class Profile extends AbstractModel
{
    protected $table = 'profiles';

    public static $name = 'profile';

    use SoftDeletes;

    use BelongsToUserTrait;

    protected $dates = ['deleted_at'];

    protected $fillable = ['gender', 'occupation', 'avatar', 'education', 'description', 'experience', 'address', 'phone', 'qq', 'weibo', 'wechat'];

    protected $appends = ['gender_text', 'avatar_full_path']; //追加模型字段


    /**
     * 性别前台显示格式
     *
     * @param $value
     * @return mixed
     */
    public function getGenderTextAttribute()
    {
        $gender = $this->attributes['gender'];
        if (is_null($gender)) {
            $gender_text = '未定义';
        } else {
            $gender_list = ['男', '女', '保密'];
            $gender_text = $gender_list[$gender];
        }

        return $gender_text;
    }

    /**
     * 头像前台显示格式
     *
     * @param $value
     * @return string
     */
    public function getAvatarFullPathAttribute()
    {
        $avatar = $this->attributes['avatar'];
        $avatar_path = Config::get('filepath.avatar_path');
        $avatar_file_path = public_path($avatar_path . $avatar);
        $avatar_full_path = asset($avatar_path . $avatar);
        if (!File::exists($avatar_file_path) || empty($avatar)) {
            $avatar_full_path = asset($avatar_path . 'default_avatar.png');
        }

        return $avatar_full_path;
    }

}
