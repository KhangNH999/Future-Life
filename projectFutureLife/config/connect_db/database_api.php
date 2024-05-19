<?php
// config db
include 'config.php';

// Create connect db
$connect_db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Test connection
if ($connect_db->connect_error) {
    die(json_encode([
        'status' => 'error',
        'message' => 'Kết nối đến cơ sở dữ liệu thất bại: ' . $connect_db->connect_error
    ]));
}
?>