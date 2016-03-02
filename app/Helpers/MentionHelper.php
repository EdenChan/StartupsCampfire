<?php
namespace StartupsCampfire\Helpers;

use Illuminate\Support\Facades\Auth;
use StartupsCampfire\Models\User;

/**
 * 解析内容中的@标记 生成相应的用户简介链接 返回解析后的内容
 *
 * Class MentionHelper
 * @package StartupsCampfire\Helpers
 */
class MentionHelper
{
    public static function getMentionedUsername($body_original)
    {
        preg_match_all("/([^\s\S]*)\@([^\r\n\s]*)/i", $body_original, $atlist);
        $usernames = [];
        foreach ($atlist[2] as $k => $v) {
            if ($atlist[1][$k] || strlen($v) > 25) {
                continue;
            }
            // 避免@自身
            if (Auth::user('user')->name == $v) {
                continue;
            }
            $usernames[] = $v;
        }
        return array_unique($usernames);
    }

    public static function replace($body_original, $users = [])
    {
        $body_parsed = $body_original;

        foreach ($users as $user) {
            $search = '@' . $user->name;
            $place = '<a href="' . url('/users/' . $user->id) . '">' . $search . '</a>';
            $body_parsed = str_replace($search, $place, $body_parsed);
        }
        return $body_parsed;
    }

    /**
     * 解析输入的内容文本 检查是否通过@方式提到相关用户 返回处理后的文本和相关用户的数组
     *
     * @param $body
     * @return array
     */
    public static function parse($body, $escape = true)
    {
        //首先转义 后续根据@生成附加链接后即可原样输出
        if($escape) {
            $body_original = e($body);
        } else {
            $body_original = $body;
        }
        $users = [];

        $usernames = self::getMentionedUsername($body_original);
        if (count($usernames) > 0) {
            $users = User::whereIn('name', $usernames)->get();
        }

        $body_parsed = self::replace($body_original, $users);
        $users_mentioned = $users;
        return compact('body_parsed', 'users_mentioned');
    }

}