<?php
namespace StartupsCampfire\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Repositories\CommentRepository;
use StartupsCampfire\Http\Requests\CreateCommentRequest;

class CommentController extends CommonController
{
    protected $commentRepository;

    /**
     * CommentController constructor.
     *
     * @param PostRepository $postRepository
     */
    public function __construct(CommentRepository $commentRepository)
    {
        // 中间件设置
        $this->middleware('auth');

        $this->commentRepository = $commentRepository;
    }

    public function store(CreateCommentRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id('user');

        $this->commentRepository->createComment($input);

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
        $this->commentRepository->deleteComment($comment_id);

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
        $this->commentRepository->upvoteModel($comment_id);

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
        $this->commentRepository->downvoteModel($comment_id);

        return Redirect::back();
    }
}