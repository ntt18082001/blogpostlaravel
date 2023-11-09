<?php

namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getAllUser($id);
    public function searchUsers($username, $email);
    public function countUser();
}
