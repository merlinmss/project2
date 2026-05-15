<?php
namespace App\Repositories\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{
    public function fetchUserList();
    public function find($id);
    public function save(array $data): User;
    public function saveUserRoleIds(array $data);
}
