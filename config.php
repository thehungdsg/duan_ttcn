<?php
$host = "localhost"; // 127.0.0.1
$dbname = "dbweb";
$username = "root";
$password = "";


try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Báo lỗi bằng exception
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // fetch dạng mảng
            PDO::ATTR_EMULATE_PREPARES => false, // Dùng prepare thật
        ]
    );

} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}
