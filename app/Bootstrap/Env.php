<?php

namespace App\Bootstrap;

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;

class Env
{
    /**
     * Initialize the environment variables.
     *
     * @param string $envDir Directory where the .env file is located.
     * @return void
     */
    public static function initialize(string $envDir): void
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
        ini_set('display_startup_errors', 'On');

        $dotenv = Dotenv::createImmutable($envDir);

        try {
            $dotenv->load();
        } catch (InvalidPathException $e) {
            trigger_error('.env loading failed: ' . $e->getMessage(), E_USER_ERROR);
        }

        $debug = self::get('APP_DEBUG', false);

        if (!$debug) {
            error_reporting(0);
            ini_set('display_errors', 'Off');
            ini_set('display_startup_errors', 'Off');
        }

        $timezone = self::get('APP_TIMEZONE', 'UTC');
        date_default_timezone_set($timezone);
    }

    /**
     * @param string $key
     * @param bool|int|float|string $default
     * @return bool|int|float|string
     */
    public static function get(string $key, bool|int|float|string $default): bool|int|float|string
    {
        // 获取环境变量
        $value = getenv($key);
        $value = ($value !== false) ? $value : null;
        $value = $value ?? $_ENV[$key] ?? $_SERVER[$key] ?? null;

        // 根据默认值的类型进行转换
        return match (gettype($default)) {
            'boolean' => filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? $default,
            'integer' => (int)($value ?? $default),
            'double' => (float)($value ?? $default),
            'string' => $value ?? $default,
        };
    }
}
