<?php
// 引入 install.php 文件
require_once __DIR__ . '/install.php';
// 引入 user - handler.php 文件
require_once __DIR__ . '/user-handler.php';

// 处理祈愿提交
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $wish = $_POST['wish'];
    $user = checkAndSetUser();
    $userId = $user['user_id'];
    $nickname = $user['nickname'];

    $conn = getDatabaseConnection();

    // 将祈愿插入数据库
    $sql = "INSERT INTO wishes (user_id, nickname, wish) VALUES ('$userId', '$nickname', '$wish')";
    if ($conn->query($sql) !== TRUE) {
        error_log("Error inserting wish: " . $sql . "<br>" . $conn->error);
        echo json_encode([
            'status' => 'error',
            'message' => '祈愿提交失败'
        ]);
    } else {
        // 随机祝福列表
        $blessings = [
            '祝您蛇年行大运，福气满满！',
            '愿您在蛇年里阖家欢乐，幸福安康！',
            '蛇年到，好运到，祝您事事顺心！'
        ];
        $randomBlessing = $blessings[array_rand($blessings)];

        $conn->close();
        echo json_encode([
            'status' => 'success',
            'blessing' => $randomBlessing
        ]);
    }
}
?>