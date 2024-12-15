<?php

// 创建 Web 应用
$app = (require __DIR__ . '/../bootstrap/app.php')('web');

// 启动应用
$app->run();
