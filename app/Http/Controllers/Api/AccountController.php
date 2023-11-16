<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AccountController extends BaseController
{
    protected $userRepo;
    protected $postRepo;

    public function __construct(UserRepositoryInterface $userRepo, PostRepositoryInterface $postRepo) {
        $this->postRepo = $postRepo;
        $this->userRepo = $userRepo;
    }

    /**
     * Count my post
     * @return \Illuminate\Http\JsonResponse
     */
    public function countMyPost() {
        $id = Auth::id();
        $countPost = $this->postRepo->countPostByAuthorId($id);
        return response()->json($countPost);
    }

    /**
     * Update user info
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUserInfo(Request $request) {
        try {
            $id = auth()->id();
            $data = $request->all();
            $file = $request->file('avatar');
            if ($file != null) {
                $fileName = $file->hashName();
                $file->storeAs('/public/avatar', $fileName);
                $data['avatar'] = $fileName;
            }
            $result = $this->userRepo->updateOrCreate($data, $id);
            return response()->json(['data' => $result]);
        }
        catch (\ErrorException $exception) {
            Log::error($exception->getMessage());
            return response()->json('error-msg', self::ERROR_MSG);
        }
    }
}
