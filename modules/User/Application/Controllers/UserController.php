<?php

namespace Modules\User\Application\Controllers;

use Modules\User\Application\Services\UserService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class UserController
{
    public function index(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $response->getBody()->write('User index');
        return $response;
    }

    public function register(): void
    {
    }
}
