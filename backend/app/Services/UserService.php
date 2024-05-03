<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

readonly class UserService
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function findUserByEmail(string $email): ?User
    {
        return $this->userRepository->findByEmail($email);
    }

    public function createUser(string $email, string $name): User
    {
        return User::create([
            'email' => $email,
            'name' => $name,
            'password' => md5(time()),
        ]);
    }
}
