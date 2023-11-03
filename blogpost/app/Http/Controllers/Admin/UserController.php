<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends BaseController
{
    protected $userRepo;
    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    function index(Request $request) {
        if(isset($request->username) || isset($request->email)) {
            $username = isset($request->username) ? $request->username : false;
            $email = isset($request->email) ? $request->email : false;

            $result = $this->userRepo->searchUsers($username, $email)->paginate();
            return view('Admin.user.index')->with('data', $result);
        }
        $result = $this->userRepo->getAllUser(Auth::id())->paginate();
        return view('Admin.user.index')->with('data', $result);
    }
    function create() {
        return view('Admin.user.create');
    }

    function save(Request $request, $id = null) {
        $data = $request->all();
        $this->customValidate($data, $id);

        $file = $request->file('avatar');
        if($file != null) {
            $file_name = $file->hashName();
            $file->storeAs('/public/avatar', $file_name);
            $data['avatar'] = $file_name;
        }

        try {
            $this->userRepo->updateOrCreate($data, $id);
            if($id == null) {
                $msg = "Account created!";
            } else {
                $msg = "Account updated!";
            }
            return redirect()->route('admin.user.index')->with('success-msg', $msg);
        } catch (\ErrorException $exception) {
            return redirect()->route('admin.user.index')->with('error-msg', self::ERROR_MSG);
        }
    }
    private function customValidate($data, $id = null) {
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
            'full_name' => 'Fullname',
            'username' => "Username",
            'email' => "Email",
            'address' => "Address",
            "role_id" => "Role",
            "phone_number" => "Phone number",
            'password' => "Password",
            "confirmPassword" => "Confirm password",
            'birth_day' => "Day of birth",
            "gender" => "Gender"
        ];
        if($id == null) {
            $rules["avatar"] = ["required"];
            $fields["avatar"] = "Avatar";
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
    function delete($id) {
        $result = $this->userRepo->delete($id);
        $redirect = redirect()->back();
        if($result) {
            return $redirect->with('success-msg', 'Account deleted!');
        }
        return $redirect->with('error-msg', self::ERROR_MSG);
    }
    function edit($id)
    {
        $user = $this->userRepo->find($id);
        if($user == null) {
            return redirect()->back()->with('error-msg', 'Account not found!');
        }
        return view('Admin.user.edit')->with('data', $user);
    }
}
