<?php
namespace StartupsCampfire\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Http\Requests\CreateCommentRequest;

class CommentController extends CommonController
{
    /**
     * CommentController constructor.
     *
     * @param PostRepository $postRepository
     */
    public function __construct()
    {
        // 中间件设置
        $this->middleware('auth');
    }

    public function store(CreateCommentRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id('user');

        \CommentRepository::createComment($input);

        return Redirect::back();
    }

    /**
     * 删除评论操作
     *
     * @param $comment_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($comment_id)
    {
        \CommentRepository::deleteComment($comment_id);

        return Redirect::back();
    }

    /**
     * 评论点赞
     *
     * @param $comment_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getUpvoteComment($comment_id)
    {
        \CommentRepository::upvoteModel($comment_id);

        return Redirect::back();
    }

    /**
     * 评论点踩
     *
     * @param $comment_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDownvoteComment($comment_id)
    {
        \CommentRepository::downvoteModel($comment_id);

        return Redirect::back();
    }
}