<?php

namespace StartupsCampfire\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Auth;
use StartupsCampfire\Models\Relations\FollowersTrait;
use StartupsCampfire\Models\Relations\HasFavoritePostsTrait;
use StartupsCampfire\Models\Relations\HasManyCommentsTrait;
use StartupsCampfire\Models\Relations\HasManyEventsTrait;
use StartupsCampfire\Models\Relations\HasManyNotificationsTrait;
use StartupsCampfire\Models\Relations\HasManyPostsTrait;
use StartupsCampfire\Models\Relations\HasOneProfileTrait;

class User extends AbstractModel implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    use SoftDeletes;

    use HasOneProfileTrait,
        HasManyEventsTrait,
        HasManyPostsTrait,
        HasManyCommentsTrait,
        HasManyNotificationsTrait,
        FollowersTrait,
        HasFavoritePostsTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The Model name
     *
     * @var string
     */
    public static $name = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'followers_count', 'followings_count'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $appends = ['is_auth', 'following_user'];

    /**
     * 判断当前认证用户是否与该用户模型一致
     *
     * @return bool
     */
    public function getIsAuthAttribute()
    {
        if ($this->id == Auth::id('user')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 判断当前认证用户是否对该用户模型添加关注
     *
     * @return bool
     */
    public function getFollowingUserAttribute()
    {
        $all_followers = $this->followers;

        if ($all_followers->contains(Auth::user('user'))) {
            return true;
        } else {
            return false;
        }
    }
}
