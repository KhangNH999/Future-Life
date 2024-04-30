<?php
include_once 'roles/admin/base/database.php';
?>
<?php 
ob_start();
class account_admin {
    // database
    use base_database;
    // logout admin
    public function logout_admin() {
        unset($_SESSION['login_admin']);
    }
}
?>