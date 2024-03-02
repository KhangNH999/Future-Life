<?php
include_once 'config/connect_db/database.php'
?>

<?php 
ob_start();
class account_admin {
    private $database;
    // database
    public function __construct() {
        $this->database = new Database();
    }
    // logout admin
    public function logout_admin() {
        unset($_SESSION['login_admin']);
    }
}
?>