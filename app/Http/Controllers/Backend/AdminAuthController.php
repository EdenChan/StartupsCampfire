<?php

namespace StartupsCampfire\Http\Controllers\Backend;

use StartupsCampfire\Components\AuthComponent;
use StartupsCampfire\Repositories\AdminRepository;

class AdminAuthController extends AdminCommonController
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
    protected $authRepository; //认证Repo

    /**
     * 构造方法
     *
     * @return void
     */
    public function __construct(AdminRepository $adminRepository)
    {
        // 中间件设置
        $this->middleware('admin.guest', ['except' => ['getLogout']]);

        $this->user = "admin"; //multiauth角色配置

        $this->redirectPath = 'backend::admin.index';
        $this->redirectAfterLogout = 'backend::admin.login';
        $this->redirectPathAfterRegister = 'backend::admin.index';
        $this->loginPath = 'backend::admin.login';
        $this->username = 'login_condition';
        $this->authTable = "admins";
        $this->viewMethod = 'backView';
        $this->authRepository = $adminRepository;

    }
}
