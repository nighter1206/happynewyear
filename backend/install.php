<?php
// 数据库连接配置
$servername = "localhost";
$username = "";
$password = "";
$dbname = "snake_year_website";

// 创建数据库连接
$conn = new mysqli($servername, $username, $password);

// 检查连接是否成功
if ($conn->connect_error) {
    die("数据库连接失败: " . $conn->connect_error);
}

// 创建数据库（如果不存在）
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) !== TRUE) {
    die("创建数据库失败: " . $conn->error);
}

// 选择数据库
$conn->select_db($dbname);

// 创建 users 表
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(255) NOT NULL,
    nickname VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) !== TRUE) {
    die("创建 users 表失败: " . $conn->error);
}

// 创建 wishes 表
$sql = "CREATE TABLE IF NOT EXISTS wishes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(255) NOT NULL,
    nickname VARCHAR(255) NOT NULL,
    wish TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql) !== TRUE) {
    die("创建 wishes 表失败: " . $conn->error);
}

// 创建 fireworks 表
$sql = "CREATE TABLE IF NOT EXISTS fireworks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(255) NOT NULL,
    nickname VARCHAR(255) NOT NULL,
    x INT NOT NULL,
    y INT NOT NULL,
    color VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql) !== TRUE) {
    die("创建 fireworks 表失败: " . $conn->error);
}

// 关闭数据库连接
$conn->close();

// 定义一个函数用于获取数据库连接
function getDatabaseConnection() {
    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("数据库连接失败: " . $conn->connect_error);
    }
    return $conn;
}
?>
