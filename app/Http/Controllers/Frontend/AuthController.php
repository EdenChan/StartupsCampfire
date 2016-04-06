<?php

namespace StartupsCampfire\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Auth;
use StartupsCampfire\Components\AuthComponent;
use StartupsCampfire\Repositories\UserRepositoryInterface;

class AuthController extends CommonController
{
    use AuthComponent;

    /**
     * 认证相关配置
     *
     * @var string
     */
    protected $redirectPath; //登录后跳转路径
    protected $redirectAfterLogout; //登出后跳转路径
    protected $redirectPathAfterRegister; //注册后跳转路径
    protected $loginPath; //登录验证失败路径
    protected $username; //登录表单字段
    protected $authTable; //认证数据表
    protected $viewMethod; //视图渲染方式
    protected $authRepository; //认证repo

    /**
     * 构造方法
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        // 中间件设置
        $this->middleware('guest', ['except' => ['getLogout']]);

        // multiauth配置
        $this->user = "user";

        $this->redirectPath = 'frontend::user.authprofile';
        $this->redirectAfterLogout = 'frontend::index';
        $this->redirectPathAfterRegister = 'frontend::user.authprofile';
        $this->loginPath = 'frontend::login';
        $this->username = 'login_condition';
        $this->authTable = 'users';
        $this->viewMethod = 'frontView';
        $this->authRepository = $userRepository;
    }

    /**
     * 注册后续操作
     */
    protected function afterRegister()
    {
        $user =  Auth::user('user');
        $user->profile()->create($input = []);
    }
}
