<?php
namespace StartupsCampfire\Components;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Sarav\Multiauth\Foundation\AuthenticatesAndRegistersUsers;

trait AuthComponent
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        $authRepository = $this->authRepository;
        return $authRepository->create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }


    public function getRegister()
    {
        return $this->viewMethod('auth.register');
    }

    /**
     * Override postRegister
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'name'                  => 'required|max:255|unique:' . $this->authTable,
            'email'                 => 'required|email|max:255|unique:' . $this->authTable,
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);

        Auth::login($this->user(), $this->create($request->all()));

        $this->afterRegister();

        return Redirect::route($this->redirectPathAfterRegister);
    }

    public function getLogin()
    {
        return $this->viewMethod('auth.login');
    }

    /**
     * Override postLogin
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required',
            'password'             => 'required',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        // 使用邮箱或用户名均可登录
        $credentials = $this->getCredentials($request);

        if (Auth::attempt($this->user(), $credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        $this->afterLogin();

        return Redirect::route($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::user($this->user()));
        }

        return Redirect::route($this->redirectPath());
    }

    public function getLogout()
    {
        Auth::logout($this->user());

        return Redirect::route(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    protected function getCredentials(Request $request)
    {
        //扩展登录条件
        $field = filter_var($request->input($this->loginUsername()), FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $credentials = [
            $field     => $request->input($this->loginUsername()),
            'password' => $request->input('password'),
        ];
        return $credentials;
    }

    protected function viewMethod($view)
    {
        return call_user_func_array([\StartupsCampfire\Helpers\ViewHelper::class, $this->viewMethod], [$view, $data = [], $mergeData = []]);
    }

    protected function afterRegister()
    {
        return true;
    }

    protected function afterLogin()
    {
        return true;
    }
}