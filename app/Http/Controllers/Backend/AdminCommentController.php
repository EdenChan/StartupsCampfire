<?php

namespace StartupsCampfire\Http\Controllers\Backend;

use Illuminate\Support\Facades\Redirect;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Helpers\ViewHelper;

class AdminCommentController extends AdminCommonController
{
    public function index()
    {
        $comments = \CommentRepository::getPaginatedModels(15);

        $comments_count = $this->commentRepository->all()->count();

        return ViewHelper::backView('comments.index', compact('comments', 'comments_count'));
    }

    public function destroy($comment_id)
    {
        \CommentRepository::delete($comment_id);

        return Redirect::route('backend::admin.comments.index');
    }

}