<?php
$domain = 'imaster.com';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($domain, ENT_QUOTES, 'UTF-8'); ?> - created successfully</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden; /* 防止滚动条出现 */
        }
        .terminal {
            padding: 10px;
            width: 600px;
            max-width: 80%;
            min-height: 300px; /* 增加终端高度 */
            border-radius: 5px; /* 调小圆角 */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.7);
            overflow: hidden;
            font-family: "Courier New", Courier, monospace; /* 复古等宽字体 */
        }
        @media (min-height: 600px) {
            .terminal {
                transform: translateY(-19%); /* 适当上移 */
            }
        }
        p {
            font-size: 0.875rem; /* 字体大小调整为 14px */
            line-height: 1.4;
            margin: 0;
            display: flex;
            align-items: center;
            text-transform: lowercase;
            word-break: break-all; /* 避免超出终端宽度 */
            white-space: pre-wrap; /* 保证文本在行末自动换行 */
        }
        .prompt {
            margin-right: 8px; /* 确保提示符与内容之间有间距 */
            min-width: 60px;
        }
        .content {
            font-family: inherit; /* 使所有文本使用等宽字体 */
        }
        code {
            font-family: inherit; /* 使 code 标签内文字与普通内容一致 */
        }
        /* 留出3行空白 */
        .terminal:after {
            content: "\a \a \a";
            white-space: pre;
        }
        /* =========== Solarized Dark 主题颜色设置 =========== */
        .solarized-dark {
            background-color: #073642; /* 背景颜色 */
        }
        .solarized-dark .prompt {
            color: #2aa198; /* 提示符颜色 */
        }
        .solarized-dark .content {
            color: #93a1a1; /* 内容文字颜色 */
        }
        .solarized-dark code {
            color: #b58900; /* 代码文字颜色 */
        }
        /* =========== 其他主题可在此添加 =========== */
        /* 示例：可增加一个 light 主题 */
        /*
        .light-theme {
            background-color: #f5f5f5;
        }
        .light-theme .prompt {
            color: #007acc;
        }
        .light-theme .content {
            color: #333;
        }
        .light-theme code {
            color: #d73a49;
        }
        */
    </style>
</head>
<body>
    <div class="terminal solarized-dark">
        <p><span class="prompt">site:~$</span> <span class="content"><?php echo htmlspecialchars($domain, ENT_QUOTES, 'UTF-8'); ?> created successfully</span></p>
        <p><span class="prompt">site:~$</span> <span class="content">php version: <?php echo htmlspecialchars(phpversion(), ENT_QUOTES, 'UTF-8'); ?></span></p>
        <p><span class="prompt">site:~$</span> <span class="content">delete or modify <code>index.php</code> to start building your project</span></p>
    </div>
</body>
</html>
