<?php
include_once 'config/connect_db/database.php';
?>

<?php 
ob_start();
class download_file {
    private $database;
    // database
    public function __construct() {
        $this->database = new Database();
    }
    // data download file
    public function show_download_file() {
        $query = "SELECT * FROM download_file WHERE id ORDER BY id DESC";
        $result = $this->database->select($query);
        return $result; 
    }    
    // insert file
    public function insert_file($file_name, $file_format, $link) {
        $query = "INSERT INTO download_file(file_name, time_download, file_format, link, account_id) VALUES ('$file_name', NOW(), $file_format, '$link', 1)";
        $result = $this->database->insert($query);
        return $result;
    }
    // delete file
    public function delete_file($id, $link) {
        $query = "DELETE FROM download_file WHERE id = '$id'";
        $result = $this->database->delete($query);
        unlink($link);
        header('Location: admin_cp.php?action=download_file&query=show');
    }
}
?>