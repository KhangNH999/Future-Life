<?php
session_start();
include_once '../../../../config/connect_db/database.php'
?>

<?php 
ob_start();
class login_admin {
    private $database;
    // database
    public function __construct() {
        $this->database = new Database();
    }
    // login admin
    public function login_user_admin($user_name, $password) {
        $query = "SELECT * FROM admin_account WHERE user_name = '$user_name' AND password = '$password'";
        $result = $this->database->insert($query)->fetch_assoc();
        if ($result > 0) {
            $_SESSION['login_admin'] = 1;
            header('Location: ../../../../admin_cp.php?action=manage_daily_job&query=show');
        } else {
            echo '<script type="text/javascript">
            window.onload = function () { alert("Nhập sai tên đăng nhập hoặc mật khẩu!"); }
            </script>';
        }
    }
}