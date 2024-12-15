<?php

namespace App\Controllers\Backend;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BackendController
{
    public function dashboard(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface {
        $response->getBody()->write('Backend dashboard');
        return $response;
    }
}
