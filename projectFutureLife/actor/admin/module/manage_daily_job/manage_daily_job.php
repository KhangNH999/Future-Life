<?php
include_once 'config/connect_db/database.php'
?>

<?php 
ob_start();
class daily_job {
    private $database;
    // database
    public function __construct() {
        $this->database = new Database();
    }
    // data daily job
    public function show_daily_job($begin, $limit, $id, $daily_job_name, $time_start) {
        $query = "SELECT * FROM daily_job WHERE search_flg = 0 ";
        if (!Empty($id)) {
            $query .= "AND id LIKE '%$id%' ";
        }
        if (!Empty($daily_job_name)) {
            $query .= "AND name_daily_job LIKE '%$daily_job_name%' ";
        } 
        if (!Empty($time_start)) {
            $query .= "AND date_start LIKE '%$time_start%' ";
        }
        $query .= " ORDER BY id DESC LIMIT $begin, $limit";
        $result = $this->database->select($query);
        return $result; 
    }
    // get count daily job
    public function get_count_daily_job($id, $daily_job_name, $time_start) {
        $query = "SELECT * FROM daily_job WHERE search_flg = 0";
        if (!Empty($id)) {
            $query .= " AND id LIKE '%$id%'";
        }
        if (!Empty($daily_job_name)) {
            $query .= " AND name_daily_job LIKE '%$daily_job_name%'";
        } 
        if (!Empty($time_start)) {
            $query .= " AND date_start LIKE '%$time_start%'";
        }
        $result = $this->database->select($query);
        return $result;
    }
    // get data daily job
    public function get_data_daily_job($id) {
        $query = "SELECT * FROM daily_job WHERE id = '$id'";
        $result = $this->database->select($query);
        return $result;
    }
    //insert daily job
    public function insert_daily_job($daily_job_name, $time_start) {
        $query = "INSERT INTO daily_job(name_daily_job, date_start) VALUES ('$daily_job_name', '$time_start')";
        $result = $this->database->insert($query);
        header('Location: admin_cp.php?action=manage_daily_job&query=show');
    }
    //update daily job
    public function update_daily_job($daily_job_name, $time_start, $id) {
        $query = "UPDATE daily_job SET name_daily_job = '$daily_job_name', date_start = '$time_start' WHERE id = '$id'";
        $result = $this->database->delete($query);
        header('Location: admin_cp.php?action=manage_daily_job&query=show');
    }
     //delete daily job
    public function delete_daily_job($id) {
        $query = "DELETE FROM daily_job WHERE id = '$id'";
        $result = $this->database->delete($query);
        header('Location: admin_cp.php?action=manage_daily_job&query=show');
    }
}
?>