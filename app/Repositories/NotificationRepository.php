<?php
namespace StartupsCampfire\Repositories;

use StartupsCampfire\Models\Comment;

class NotificationRepository extends AbstractRepository
{

    public function model()
    {
        return \StartupsCampfire\Models\Notification::class;
    }

    public function getPaginatedUserNotifications($user_id, $page_size)
    {
        $model = $this->model;

        $notifications = $model::where('user_id', $user_id)
            ->orderBy('is_readed', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate($page_size);

        // 设置消息为已读
        $notifications_array = $notifications->all();
        foreach ($notifications_array as $notification) {
            $notification->update(['is_readed' => 1]);
        }

        return $notifications;
    }

    public function getUnreadedNotifications($user_id)
    {
        $model = $this->model;
        return $model::where('user_id', $user_id)
            ->where('is_readed', 0)
            ->get();
    }

    public function createCommentNotification($event)
    {
        $comment = $event->comment;
        $input = [];
        $input['user_id'] = $comment->commentable->user->id;
        $input['from_user_id'] = $comment->user->id;
        $input['notifiable_id'] = $comment->commentable->id;
        $input['notifiable_type'] = get_class($comment->commentable);
        $input['body'] = $comment->body_parsed;
        $input['type'] = 'new comment';
        $input['comment_id'] = $comment->id;

        $this->model->create($input);
    }

    public function createMentionNotification($event)
    {
        foreach ($event->mentioned_users as $user) {
            $input = [];
            $input['user_id'] = $user->id;
            $input['from_user_id'] = $event->related_model->user->id;
            $input['notifiable_id'] = $event->related_model->id;
            $input['notifiable_type'] = get_class($event->related_model);
            $input['body'] = $event->related_model->body_parsed;
            $input['type'] = 'new at';

            if($event->related_model instanceof Comment) {
                $input['comment_id'] = $event->related_model->id;
            }

            $this->model->create($input);
        }
    }

    public function createFollowNotification($event)
    {
        $input = [];
        $input['user_id'] = $event->follow_id;
        $input['from_user_id'] = $event->user_id;
        $input['type'] = 'new follow';
        $this->model->create($input);
    }

    public function deleteFollowNotification($event)
    {
        $this->model->where('user_id', $event->follow_id)
            ->where('from_user_id', $event->user_id)
            ->delete();
    }

    public function removeFollowerNotification($event)
    {
        $this->model->where('user_id', $event->user_id)
            ->where('from_user_id', $event->from_user_id)
            ->delete();
    }
}