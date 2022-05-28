<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getAllUsers(): object;
    public function getUserById(string $userId): object;
    public function deleteUser(string $userId): void;
    public function createUser(array $userDetails): object;
    public function updateUser(string $userId, array $newDetails);
}
