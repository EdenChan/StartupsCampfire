<?php
namespace StartupsCampfire\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use StartupsCampfire\Models\Relations\BelongsToUserTrait;
use StartupsCampfire\Models\Relations\MorphToNotificationTrait;

class Notification extends AbstractModel
{
    protected $table = 'notifications';

    public static $name = 'notification';

    use SoftDeletes;

    use BelongsToUserTrait, MorphToNotificationTrait;

    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id', 'from_user_id', 'body', 'type', 'is_readed', 'notifiable_type', 'notifiable_id', 'comment_id'];

    protected $appends = ['notification_desc', 'comment_anchor'];

    /**
     * 坏方法
     *
     * @TODO 待改进
     * @return string
     */
    public function getNotificationDescAttribute()
    {
        $notification_type = $this->attributes['type'];
        $notification_body = $this->attributes['body'];
        $notification_from_user = User::find($this->attributes['from_user_id']);
        if(!$notification_from_user) {
            return "该用户已被删除";
        }
        if(!empty($this->notifiable_type)) {
            $notification_model = $this->notifiable;
        }
        $notification_desc = $this->attributes['created_at']
            . ':用户<a href=' . url('/users/' . $this->attributes['from_user_id']) . '>'
            . $notification_from_user->name . '</a>';
        switch ($notification_type) {
            case 'new comment':
                switch ($this->notifiable_type) {
                    case Post::class:
                        $notification_desc .= '评论了您的动态:'
                            . '<strong>' . str_limit($notification_body, 100) . '</strong>'
                            . '<a href="' . url('/posts/' . $this->notifiable_id . $this->comment_anchor)
                            . '">查看</a>';
                        break;
                    case Event::class:
                        $notification_desc .= '评论了您发布的活动:'
                            . '<strong>' . str_limit($notification_body, 100) . '</strong>'
                            . '<a href="' . url('/events/' . $this->notifiable_id . $this->comment_anchor)
                            . '">查看</a>';
                        break;
                }
                break;
            case 'new at':
                switch ($this->notifiable_type) {
                    case Post::class:
                        $notification_desc .= '在动态<a href="' . url('/posts/' . $this->notifiable_id) . '">'
                            . $notification_model->title
                            . '</a>中@了您:'
                            . '<a href="' . url('/posts/' . $this->notifiable_id) . '">查看</a>';
                        break;
                    case Comment::class:
                        if (get_class($this->notifiable->commentable) == Post::class) {
                            $notification_desc .= '在评论<strong>' . $notification_model->body . '</strong>中@了您:'
                                . '<a href="' . url('/posts/' . $this->notifiable->commentable->id . $this->comment_anchor)
                                . '">查看</a>';
                        } else if (get_class($this->notifiable->commentable) == Event::class){
                            $notification_desc .= '在评论<strong>' . $notification_model->body . '</strong>中@了您:'
                                . '<a href="' . url('/events/' . $this->notifiable->commentable->id . $this->comment_anchor)
                                . '">查看</a>';
                        }
                        break;
                    case Event::class:
                        $notification_desc .= '在活动<strong>' . $notification_model->body . '</strong>中@了您:'
                            . '<a href="' . url('/events/' . $this->notifiable->commentable->id . $this->comment_anchor)
                            . '">查看</a>';
                        break;
                }
                break;
            case 'new follow':
                $notification_desc .= '关注了您';
                break;
        }
        return $notification_desc;
    }

    public function getCommentAnchorAttribute()
    {
        $comment_id = $this->comment_id;
        return !empty($comment_id) ? '#scamp_comment_' . $comment_id : '';
    }
}
