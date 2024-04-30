<!-- Import library -->
<?php
include_once 'roles/admin/base/database.php';
?>
<!-- Funtion download file -->
<?php 
ob_start();
class download_file {
    // database
    use base_database;

    /**
     * Data download file
     * return [boolean]
     */
    public function show_download_file() {
        $query = "SELECT * FROM download_file WHERE id ORDER BY id DESC";
        $result = $this->database->select($query);
        return $result; 
    }  

    /**
     * Insert file
     * @params file_name [string]
     * @params file_format [string]
     * @params link [string]
     * return [boolean]
     */
    public function insert_file($file_name, $file_format, $link) {
        $query = "INSERT INTO download_file(file_name, time_download, file_format, link, account_id) VALUES ('$file_name', NOW(), $file_format, '$link', 1)";
        $result = $this->database->insert($query);
        return $result;
    }

    /**
     * Delete file
     * @params id [int]
     * @params link [string]
     */
    public function delete_file($id, $link) {
        $query = "DELETE FROM download_file WHERE id = '$id'";
        $result = $this->database->delete($query);
        unlink($link);
        header('Location: admin_cp.php?action=download_file&query=show');
    }
}
?>