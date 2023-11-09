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

    /**
     * Get all user except current user
     * @param $id
     * @return mixed
     */
    public function getAllUser($id)
    {
        return $this->model->select('id', 'full_name', 'username', 'role_id', 'email', 'avatar')
            ->orderByDesc('id')->where('id', '!=', $id);
    }

    /**
     * Get all user except current user
     * @param $username
     * @param $email
     * @return mixed
     */
    public function searchUsers($username, $email)
    {
        $query = $this->model->query()->select('id', 'full_name', 'username', 'role_id', 'email', 'avatar')->orderByDesc('id');
        if ($username) {
            $query->where('username', 'like', "%$username%");
        }
        if ($email) {
            $query->where('email', 'like', "%$email%");
        }
        return $query;
    }

    /**
     * Count user
     * @return mixed
     */
    public function countUser()
    {
        return $this->model->count();
    }
}
