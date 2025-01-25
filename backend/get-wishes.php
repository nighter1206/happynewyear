<?php
// 引入 install.php 文件
require_once 'install.php';

$conn = getDatabaseConnection();

// 查询所有祈愿
$sql = "SELECT nickname, wish FROM wishes";
$result = $conn->query($sql);

$wishes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $wishes[] = $row;
    }
}

$conn->close();

echo json_encode($wishes);
?>