<?php

namespace StartupsCampfire\Http\Controllers\Backend;

use Illuminate\Support\Facades\Redirect;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Helpers\ViewHelper;
use StartupsCampfire\Repositories\UserRepository;

class AdminUserController extends AdminCommonController
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();

        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->getPaginatedModels(15);

        $users_count = $this->userRepository->all()->count();

        return ViewHelper::backView('users.index', compact('users', 'users_count'));
    }

    public function destroy($user_id)
    {
        $this->userRepository->delete($user_id);

        return Redirect::route('backend::admin.users.index');
    }

}