<?php

namespace App\Middlewares;

use PDO;
use PDOException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use RuntimeException;

class FrontendLocaleMiddleware implements MiddlewareInterface
{
    protected PDO $pdo;
    private string $defaultLocale;

    public function __construct(PDO $pdo, string $defaultLocale)
    {
        $this->pdo = $pdo;
        $this->defaultLocale = $defaultLocale;
    }

    public function process(Request $request, RequestHandler $handler): Response
    {
        // 提取请求路径并分割为片段
        $requestPath = trim($request->getUri()->getPath(), '/');
        $segments = explode('/', $requestPath);

        // 获取第一个片段
        $first = $segments[0] ?? '';

        // 如果路径为空，添加默认语言代码
        if (empty($first)) {
            $request = $this->prependLocaleParam($request, $segments);
            return $handler->handle($request);
        }

        // 查询数据库中的有效语言代码
        $validLocales = $this->getValidLocalesFromDatabase();
        // 如果第一个片段不是有效的语言代码，添加默认语言代码
        if (!in_array($first, $validLocales)) {
            $request = $this->prependLocaleParam($request, $segments);
        }

        // 继续处理请求
        return $handler->handle($request);
    }

    private function prependLocaleParam(Request $request, array $segments): Request
    {
        // 在路径前添加默认语言代码
        array_unshift($segments, $this->defaultLocale);
        $localePath = '/' . implode('/', $segments);

        // 更新请求的 URI
        $uri = $request->getUri()->withPath($localePath);
        return $request->withUri($uri);
    }


    protected function getValidLocalesFromDatabase(): array
    {
        try {
            $statement = $this->pdo->query('SELECT code FROM locales');
            return $statement->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            throw new RuntimeException($e->getMessage());
        }
    }
}
