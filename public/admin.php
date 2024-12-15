<?php

// 创建 Admin 应用
$app = (require __DIR__ . '/../bootstrap/app.php')('admin');

// 启动应用
$app->run();
