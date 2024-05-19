<?php
include_once 'roles/admin/base/database.php';
include 'roles/admin/logic/log_history_future_life.php';
require 'roles/admin/const/delete.php';
?>
<?php
ob_start();
class daily_job {
    // database
    use base_database;
    // data daily job
    public function show_daily_job($begin, $limit, $id, $daily_job_name, $time_start_from, $time_start_to) {
        $query = "SELECT * FROM daily_job WHERE search_flg = " . FLG_OFF . " ";
        if (!Empty($id)) {
            $query .= "AND id LIKE '%$id%' ";
        }
        if (!Empty($daily_job_name)) {
            $query .= "AND daily_job_name LIKE '%$daily_job_name%' ";
        } 
        if (!Empty($time_start_from)) {
            $formatted_date_from = date('Y-m-d H:i:s', strtotime($time_start_from));
            $query .= "AND time_start >= '$formatted_date_from' ";
        }
        if (!Empty($time_start_to)) {
            $formatted_date_to = date('Y-m-d H:i:s', strtotime($time_start_to));
            $query .= "AND time_start <= '$formatted_date_to' ";
        }
        $query .= " ORDER BY id DESC LIMIT $begin, $limit";
        $result = $this->database->select($query);
        return $result; 
    }
    // get count daily job
    public function get_count_daily_job($id, $daily_job_name, $time_start_from, $time_start_to) {
        $query = "SELECT * FROM daily_job WHERE search_flg = " . FLG_OFF . " ";
        if (!Empty($id)) {
            $query .= " AND id LIKE '%$id%'";
        }
        if (!Empty($daily_job_name)) {
            $query .= " AND daily_job_name LIKE '%$daily_job_name%'";
        } 
        if (!Empty($time_start_from)) {
            $formatted_date_from = date('Y-m-d H:i:s', strtotime($time_start_from));
            $query .= " AND time_start >= '$formatted_date_from'";
        }
        if (!Empty($time_start_to)) {
            $formatted_date_to = date('Y-m-d H:i:s', strtotime($time_start_to));
            $query .= " AND time_start <= '$formatted_date_to'";
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
    // insert daily job
    public function insert_daily_job($daily_job_name, $time_start) {
        $log_history_future_life = new log_history_future_life();
        $query = "INSERT INTO daily_job(daily_job_name, time_start) VALUES ('$daily_job_name', '$time_start')";
        $result = $this->database->insert($query);
        $log_history_future_life->insert_log_history_future_life($daily_job_name, 1, SCREEN_LOG['MANAGE_DAILY_JOB']);
        header('Location: admin_cp.php?action=manage_daily_job&query=show');
    }
    // update daily job
    public function update_daily_job($daily_job_name, $time_start, $id) {
        $query = "UPDATE daily_job SET daily_job_name = '$daily_job_name', time_start = '$time_start' WHERE id = '$id'";
        $result = $this->database->update($query);
        header('Location: admin_cp.php?action=manage_daily_job&query=show');
    }
    // delete daily job
    public function delete_daily_job($id) {
        $query = "DELETE FROM daily_job WHERE id = '$id'";
        $result = $this->database->delete($query);
        header('Location: admin_cp.php?action=manage_daily_job&query=show');
    }
    //update status
    public function update_status($id) {
        $query = "UPDATE daily_job SET status = '1' WHERE id = '$id'";
        $result = $this->database->update($query);
        header('Location: admin_cp.php?action=manage_daily_job&query=show');
    }
}
?>