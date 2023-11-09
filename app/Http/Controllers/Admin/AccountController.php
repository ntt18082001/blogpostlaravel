<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AccountController extends BaseController
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Login page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function login()
    {
        if (Auth::check()) {
            return view('Admin.index');
        }
        return view("Admin.account.login");
    }

    /**
     * Logout user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('account.login');
    }

    /**
     * Confirm login user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function auth(Request $request)
    {
        try {
            $user = User::where('username', '=', $request->username)->first();
            $loginFail = redirect()
                ->back()
                ->with("login-err-msg", "Tài khoản không hợp lệ!");
            if ($user == null) {
                return $loginFail;
            }
            $userData = [
                'username' => $request->username,
                'password' => $request->password
            ];
            if (Auth::attempt($userData)) {
                $request->session()->regenerate();
                return redirect()->route('index');
            } else {
                return $loginFail;
            }
        }
        catch (\ErrorException $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('account.login')->with('error-msg', self::ERROR_MSG);
        }
    }

    /**
     * Register page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    function register()
    {
        if (!Auth::check()) {
            return view('register');
        }
        if (Auth::user() && Auth::user()->role_id == 1) {
            return redirect()->route('admin.home.index');
        }
        return redirect()->route('index');
    }

    /**
     * Submit register user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function register_post(Request $request)
    {
        $data = $request->all();
        $this->customValidate($data);
        try {
            $data['role_id'] = 2;
            $this->userRepo->create($data);
            return redirect()->route('account.login');
        } catch (\ErrorException $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('account.register')->with('error-msg', self::ERROR_MSG);
        }
    }

    /**
     * Validation data
     * @param $data
     * @return void
     */
    private function customValidate($data)
    {
        $rules = [
            "full_name" => ['required'],
            "username" => ['required', 'unique:users'],
            "email" => ['required', 'email', 'unique:users'],
            "phone_number" => ["required", "numeric", "min:10"],
            'password' => ['required', 'min:4'],
            'confirmPassword' => ['same:password'],
        ];
        $fields = [
            'full_name' => 'Họ và tên',
            'username' => "Tên đăng nhập",
            'email' => "Email",
            "phone_number" => "Số điện thoại",
            'password' => "Mật khẩu",
            "confirmPassword" => "Xác nhận mật khẩu",
        ];
        unset($data["_token"]);
        $validator = Validator::make($data, $rules, [], $fields);
        $validator->validate();
    }
}
