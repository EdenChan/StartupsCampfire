<?php
namespace StartupsCampfire\Repositories;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use StartupsCampfire\Events\CreateComment;
use StartupsCampfire\Events\DeleteComment;
use StartupsCampfire\Events\MentionUsers;
use StartupsCampfire\Helpers\MentionHelper;
use StartupsCampfire\Repositories\RepoTraits\ApplyFilterTrait;
use StartupsCampfire\Repositories\RepoTraits\GetPaginatedModelsTrait;
use StartupsCampfire\Repositories\RepoTraits\GetPaginatedUserModelsTrait;
use StartupsCampfire\Repositories\RepoTraits\VotableRepositoryTrait;

class CommentRepository extends AbstractRepository
{
    use AuthorizesRequests;
    use GetPaginatedModelsTrait;
    use GetPaginatedUserModelsTrait;
    use VotableRepositoryTrait;
    use ApplyFilterTrait;

    public function model()
    {
        return \StartupsCampfire\Models\Comment::class;
    }

    /**
     * 创建评论
     *
     * @param $input
     */
    public function createComment($input)
    {
        // parsed_result中包含解析后的文本和接收@提醒的相关用户
        $parsed_result = MentionHelper::parse($input['body']);
        $input['body_parsed'] = $parsed_result['body_parsed'];
        $users_mentioned = $parsed_result['users_mentioned'];

        $comment = $this->model->create($input);

        // 评论数+1
        $comment->commentable->increment('comment_count', 1);

        // 检查用户是否对自己的动态进行评论
        if ($comment->commentable->user_id != Auth::id('user') &&
            $comment->commentable->user_id != 0
        ) {
            Event::fire(new CreateComment($comment));
        }

        if (count($users_mentioned) > 0) {
            Event::fire(new MentionUsers($users_mentioned, $comment));
        }
    }

    /**
     * 删除评论 返回评论所属文章的ID
     *
     * @param $comment_id
     * @return mixed
     */
    public function deleteComment($comment_id)
    {
        $comment = $this->model->find($comment_id);

        $this->authorize('destroyComment', $comment);

        $comment->delete($comment_id);

        // 评论数-1
        $comment->commentable->decrement('comment_count', 1);

        $commentable_id = $comment->commentable->id;

        return $commentable_id;
    }

}