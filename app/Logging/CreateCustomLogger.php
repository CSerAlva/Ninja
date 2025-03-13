<?php

namespace App\Logging;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class CreateCustomLogger
{
    /**
     * 创建一个自定义 Monolog 实例。
     */
    public function __invoke(array $config)
    {
        return new Logger('ZyBlog', [new StreamHandler($config['path'])]);
    }
}
