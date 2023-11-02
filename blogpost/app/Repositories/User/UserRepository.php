<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    // Lấy ra model tương ứng
    public function getModel()
    {
        return \App\Models\User::class;
    }
    // Get tất cả user trừ user hiện tại
    public function getAllUser($id)
    {
        return $this->model->select('id', 'full_name', 'username', 'role_id', 'email')
                ->orderByDesc('id')->where('id', '!=', $id);
    }
    public function searchUsers($username, $email)
    {
        $query = $this->model->query()->select('id', 'full_name', 'username', 'role_id', 'email')->orderByDesc('id');
        if($username) {
            $query->where('username', 'like', "%$username%");
        }
        if($email) {
            $query->where('email', 'like', "%$email%");
        }
        return $query;
    }
    public function countUser()
    {
        return $this->model->count();
    }
}
