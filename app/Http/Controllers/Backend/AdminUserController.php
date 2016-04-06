<?php

namespace StartupsCampfire\Http\Controllers\Backend;

use Illuminate\Support\Facades\Redirect;
use StartupsCampfire\Http\Requests\SendEmailToUserRequest;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Helpers\ViewHelper;

class AdminUserController extends AdminCommonController
{
    public function index()
    {
        $users = \UserRepository::getPaginatedModels(15);

        $users_count = \UserRepository::all()->count();

        return ViewHelper::backView('users.index', compact('users', 'users_count'));
    }

    public function destroy($user_id)
    {
        \UserRepository::delete($user_id);

        return Redirect::route('backend::admin.users.index');
    }

    public function sendEmailToUsers(SendEmailToUserRequest $request)
    {
        $data = $request->all();
        \UserRepository::sendEmailToUsers($data);

        return Redirect::back()->withMessages(['成功群发邮件!']);
    }

}