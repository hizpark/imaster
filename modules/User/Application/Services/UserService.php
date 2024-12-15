<?php

namespace Modules\User\Application\Services;

use Modules\User\Domain\User;
use Modules\User\Domain\UserCreator;

class UserService
{
    private UserCreator $creator;

    public function __construct(UserCreator $creator)
    {
        $this->creator = $creator;
    }

    public function registerUser(string $username, string $email, string $password): void
    {
        $user = new User($username, $email, $password);
        $this->creator->create($user);
    }
}
