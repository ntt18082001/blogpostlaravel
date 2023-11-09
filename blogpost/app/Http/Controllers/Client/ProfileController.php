<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileController extends BaseController
{
    protected $userRepo;
    protected $postRepo;
    public function __construct(UserRepositoryInterface $userRepo, PostRepositoryInterface $postRepo)
    {
        $this->userRepo = $userRepo;
        $this->postRepo = $postRepo;
    }

    function index() {
        $id = Auth::id();
        $user = $this->userRepo->find($id);
        if($user == null) {
            return redirect()->route('index')->with('error-msg', 'User not found!');
        }
        $countPost = $this->postRepo->countPostByAuthorId($id);
        return view('client.profile.index')
            ->with('data', $user)->with('countPost', $countPost);
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
                $msg = "Profile created!";
            } else {
                $msg = "Profile updated!";
            }
            return redirect()->route('profile.index')->with('success-msg', $msg);
        } catch (\ErrorException $exception) {
            return redirect()->route('profile.index')->with('error-msg', self::ERROR_MSG);
        }
    }
    private function customValidate($data, $id = null) {
        $rules = [
            "full_name" => ['required'],
            "address" => ["required"],
            "phone_number" => ["required", "numeric", "min:10"],
            'birth_day' => ['required'],
            'gender' => ['required']
        ];
        $fields = [
            'full_name' => 'Fullname',
            'address' => "Address",
            "phone_number" => "Phone number",
            'birth_day' => "Day of birth",
            "gender" => "Gender"
        ];
        unset($data["_token"]);
        $validator = Validator::make($data, $rules, [], $fields);
        $validator->validate();
    }
}
