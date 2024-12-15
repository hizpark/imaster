<?php

namespace Modules\User\Infrastructure;

use Modules\User\Domain\User;
use Modules\User\Domain\UserRepository;

class UserRepositoryImplementation implements UserRepository
{
    // 假设使用 PDO 进行数据库操作
    private \PDO $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function create(User $user): int
    {
        // 保存用户到数据库
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$user->getUsername(), $user->getEmail(), $user->getPassword()]);
        return (int)$this->db->lastInsertId();
    }

    public function findByEmail(string $email): ?User
    {
        // 从数据库中查找用户
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $data = $stmt->fetch();

        return $data ? new User($data['username'], $data['email'], $data['password']) : null;
    }
}
