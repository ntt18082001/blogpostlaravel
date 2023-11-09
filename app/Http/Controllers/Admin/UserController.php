<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends BaseController
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Admin user index page
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    function index(Request $request)
    {
        if (isset($request->username) || isset($request->email)) {
            $username = isset($request->username) ? $request->username : false;
            $email = isset($request->email) ? $request->email : false;

            $result = $this->userRepo->searchUsers($username, $email)->paginate();
            return view('Admin.user.index')->with('data', $result);
        }
        $result = $this->userRepo->getAllUser(Auth::id())->paginate();
        return view('Admin.user.index')->with('data', $result);
    }

    /**
     * Admin create user page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    function create()
    {
        return view('Admin.user.create');
    }

    /**
     * Submit create/edit user
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    function save(Request $request, $id = null)
    {
        $data = $request->all();
        $this->customValidate($data, $id);

        $file = $request->file('avatar');
        if ($file != null) {
            $fileName = $file->hashName();
            $file->storeAs('/public/avatar', $fileName);
            $data['avatar'] = $fileName;
        }

        try {
            $this->userRepo->updateOrCreate($data, $id);
            if ($id == null) {
                $msg = "Thêm tài khoản thành công!";
            } else {
                $msg = "Sửa tài khoản thành công!";
            }
            return redirect()->route('admin.user.index')->with('success-msg', $msg);
        } catch (\ErrorException $exception) {
            return redirect()->route('admin.user.index')->with('error-msg', self::ERROR_MSG);
        }
    }

    /**
     * Validation user data
     * @param $data
     * @param $id
     * @return void
     */
    private function customValidate($data, $id = null)
    {
        $rules = [
            "full_name" => ['required'],
            "username" => ['required', 'unique:users'],
            "email" => ['required', 'email', 'unique:users'],
            "address" => ["required"],
            "role_id" => ["required"],
            "phone_number" => ["required", "numeric", "min:10"],
            'password' => ['required', 'min:4'],
            'confirmPassword' => ['same:password'],
            'birth_day' => ['required'],
            'gender' => ['required']
        ];
        $fields = [
            'full_name' => 'Họ và tên',
            'username' => "Tên đăng nhập",
            'email' => "Email",
            'address' => "Địa chỉ",
            "role_id" => "Vai trò",
            "phone_number" => "Số điện thoại",
            'password' => "Mật khẩu",
            "confirmPassword" => "Xác nhận mật khẩu",
            'birth_day' => "Ngày sinh",
            "gender" => "Giới tính"
        ];
        if ($id == null) {
            $rules["avatar"] = ["required"];
            $fields["avatar"] = "Ảnh đại diện";
        }
        if ($id != null) {
            // Bỏ qua check unique khi update
            $rules["username"] = ['required', Rule::unique('users')->ignore($id)];
            $rules["email"] = ['required', 'email', Rule::unique('users')->ignore($id)];
            // bỏ qua check password khi update
            unset($rules['password']);
            unset($rules['confirmPassword']);
        }
        unset($data["_token"]);
        $validator = Validator::make($data, $rules, [], $fields);
        $validator->validate();
    }

    /**
     * Find user by $id to delete
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    function delete($id)
    {
        $user = $this->userRepo->find($id);
        if ($user != null) {
            if (Storage::disk('public')->exists('avatar/' . $user->avatar)) {
                Storage::disk('public')->delete('avatar/' . $user->avatar);
            }
        }
        $result = $this->userRepo->delete($id);
        $redirect = redirect()->back();
        if ($result) {
            return $redirect->with('success-msg', 'Xóa tài khoản thành công!');
        }
        return $redirect->with('error-msg', self::ERROR_MSG);
    }

    /**
     * Find user by $id to edit
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    function edit($id)
    {
        $user = $this->userRepo->find($id);
        if ($user == null) {
            return redirect()->back()->with('error-msg', 'Không tìm thấy tài khoản!');
        }
        return view('Admin.user.edit')->with('data', $user);
    }
}
