<?php
// 引入 install.php 文件
require_once __DIR__ . '/install.php';

// 检查并设置用户 Cookie 和昵称
function checkAndSetUser() {
    $conn = getDatabaseConnection();
    if (!isset($_COOKIE['user_id'])) {
        // 生成唯一的用户 ID
        $userId = uniqid();
        // 从预设的吉祥昵称列表中随机选取一个昵称
        $luckyNicknames = ['瑞祥龙儿', '福运蛇宝', '吉庆虎娃'];
        $nickname = $luckyNicknames[array_rand($luckyNicknames)];

        // 设置 Cookie
        setcookie('user_id', $userId, time() + (86400 * 30), "/");
        setcookie('nickname', $nickname, time() + (86400 * 30), "/");

        // 将用户信息插入数据库
        $sql = "INSERT INTO users (user_id, nickname) VALUES ('$userId', '$nickname')";
        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    // 检查 Cookie 是否存在，避免出现未定义键的警告
    $user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null;
    $nickname = isset($_COOKIE['nickname']) ? $_COOKIE['nickname'] : null;

    $conn->close();
    return [
        'user_id' => $user_id,
        'nickname' => $nickname
    ];
}

// 获取用户信息
function getUserInfo() {
    // 检查 Cookie 是否存在，避免出现未定义键的警告
    $user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null;
    $nickname = isset($_COOKIE['nickname']) ? $_COOKIE['nickname'] : null;

    if ($user_id && $nickname) {
        return [
            'user_id' => $user_id,
            'nickname' => $nickname
        ];
    }
    return null;
}
?>