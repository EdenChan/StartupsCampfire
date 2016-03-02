<?php

namespace StartupsCampfire\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Sarav\Multiauth\Foundation\ResetsPasswords;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use StartupsCampfire\Helpers\ViewHelper;


class PasswordController extends CommonController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected $redirectPath;

    protected $subject;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectPath = '/';
        $this->subject = '重置StartupsCampfire密码';
        $this->user = "user";
        $this->middleware('guest');
    }

    public function getEmail()
    {
        return ViewHelper::frontView('auth.send_email');
    }

    public function postEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        $app = app();

        $class = str_ireplace('StartupsCampfire\Http\Controllers\\', '', get_called_class());

        view()->composer($app->config['auth.password.email'], function($view) use ($class) {
            $view->with('action', $class.'@getReset');
        });

        $response = Password::sendResetLink($request->only('email'), function (Message $message) {
            $message->subject($this->getEmailSubject());
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return redirect()->back()->with('status', '已成功发送重置密码邮件，请查看您的邮箱进行密码重置');

            case Password::INVALID_USER:
                return redirect()->back()->withErrors(['email' => '发送重置密码邮件失败']);
        }
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function getReset($token = null)
    {
        if (is_null($token)) {
            throw new NotFoundHttpException;
        }

        return ViewHelper::frontView('auth.reset', compact('token'));
    }
}
