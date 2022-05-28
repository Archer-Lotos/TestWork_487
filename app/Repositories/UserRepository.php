<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers(): object
    {
        return User::with('books')->get();
    }

    public function getUserById(string $userId): object
    {
        return User::with('books')->findOrFail($userId);
    }

    public function deleteUser(string $userId): void
    {
        User::destroy($userId);
    }

    public function createUser(array $userDetails): object
    {
        $userDetails['password'] = Hash::make($userDetails['password']);

        return User::create($userDetails);
    }

    public function updateUser(string $userId, array $newDetails)
    {
        $newDetails['password'] = Hash::make($newDetails['password']);

        User::whereId($userId)->update($newDetails);

        return User::with('books')->findOrFail($userId);
    }
}
