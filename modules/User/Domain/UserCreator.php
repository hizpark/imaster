<?php

namespace Modules\User\Domain;

class UserCreator
{
    private UserRepository $repository;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    public function create(User $user): int
    {
        return $this->repository->create($user);
    }
}
