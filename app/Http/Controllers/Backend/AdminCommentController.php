<?php

namespace StartupsCampfire\Http\Controllers\Backend;

use Illuminate\Support\Facades\Redirect;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Helpers\ViewHelper;
use StartupsCampfire\Repositories\CommentRepository;

class AdminCommentController extends AdminCommonController
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        parent::__construct();

        $this->commentRepository = $commentRepository;
    }

    public function index()
    {
        $comments = $this->commentRepository->getPaginatedModels(15);

        $comments_count = $this->commentRepository->all()->count();

        return ViewHelper::backView('comments.index', compact('comments', 'comments_count'));
    }

    public function destroy($comment_id)
    {
        $this->commentRepository->delete($comment_id);

        return Redirect::route('backend::admin.comments.index');
    }

}