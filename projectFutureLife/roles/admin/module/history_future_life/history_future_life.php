<!-- Import library -->
<?php
include_once 'roles/admin/base/database.php';
require 'roles/admin/const/delete.php';
include 'roles/admin/const/screen_log.php';
?>
<!-- Funtion download file -->
<?php
ob_start();
class history_future_life {
    // database
    use base_database;

    /**
     * Show history daily job
     * return [boolean]
     */
    public function show_history_daily_job() {
        $query = "SELECT * FROM history_future_life WHERE search_flg = " . FLG_OFF . " AND screen_id = " . SCREEN_LOG['MANAGE_DAILY_JOB'] . " ORDER BY id DESC"; 
        $result = $this->database->select($query);
        return $result; 
    }

    /**
     * Show history cost
     * return [boolean]
     */
    public function show_history_cost() {
        $query = "SELECT * FROM history_future_life WHERE search_flg = " . FLG_OFF . " AND screen_id = " . SCREEN_LOG['MANAGE_COST'] . " ORDER BY id DESC"; 
        $result = $this->database->select($query);
        return $result; 
    }

    /**
     * Show history future plan
     * return [boolean]
     */
    public function show_history_future_plan() {
        $query = "SELECT * FROM history_future_life WHERE search_flg = " . FLG_OFF . " AND screen_id = " . SCREEN_LOG['MANAGE_FUTURE_PLAN'] . " ORDER BY id DESC"; 
        $result = $this->database->select($query);
        return $result; 
    }

    /**
     * Get count history future life
     * @params from_time [date_time]
     * @params to_time [date_time]
     * return [boolean]
     */
    public function get_count_history_future_life($from_time, $to_time) {
        $query = "SELECT * FROM history_future_life WHERE search_flg = " . FLG_OFF . " ";
        if (!Empty($from_time)) {
            $formatted_from_time = date('Y-m-d H:i:s', strtotime($from_time));
            $query .= " AND time_history >= '$formatted_from_time'";
        }
        if (!Empty($to_time)) {
            $formatted_to_time = date('Y-m-d H:i:s', strtotime($to_time));
            $query .= " AND time_history <= '$formatted_to_time'";
        }
        $result = $this->database->select($query);
        return $result;
    }

    /**
     * Delete history
     * @params id [int]
     */
    public function delete_history($id, $action) {
        $query = "DELETE FROM history_future_life WHERE id = '$id'";
        $result = $this->database->delete($query);
        if ($action == 'history_daily_job') header('Location: admin_cp.php?action=history_daily_job&query=show');
        if ($action == 'history_cost') header('Location: admin_cp.php?action=history_cost&query=show');
        if ($action == 'history_future_plan') header('Location: admin_cp.php?action=history_future_plan&query=show');
    }
}
?>