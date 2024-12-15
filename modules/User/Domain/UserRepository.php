<?php

namespace Modules\User\Domain;

interface UserRepository
{
    public function create(User $user): int;

    public function findByEmail(string $email): ?User;
}
