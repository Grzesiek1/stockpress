<?php

namespace App\Repositories;

use App\Models\User;

interface IUserRepository
{
    public function findByEmail(string $email): ?User;
}
