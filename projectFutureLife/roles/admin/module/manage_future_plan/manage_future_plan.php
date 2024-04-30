<?php
include_once 'roles/admin/base/database.php';
include 'roles/admin/logic/log_history_future_life.php';
require 'roles/admin/const/delete.php';
?>
<?php
ob_start();
class future_plan {
    // database
    use base_database;
    // data daily job
    public function show_future_plan($begin, $limit, $id, $future_plan_name, $time_start) {
        $query = "SELECT * FROM future_plan WHERE search_flg = " . FLG_OFF . " ";
        if (!Empty($id)) {
            $query .= "AND id LIKE '%$id%' ";
        }
        if (!Empty($future_plan_name)) {
            $query .= "AND future_plan_name LIKE '%$future_plan_name%' ";
        } 
        if (!Empty($time_start)) {
            $formatted_date = date('Y-m-d H:i:s', strtotime($time_start));
            $query .= "AND time_start = '$formatted_date' ";
        }
        $query .= " ORDER BY id DESC LIMIT $begin, $limit";
        $result = $this->database->select($query);
        return $result; 
    }
    // get count future plan
    public function get_count_future_plan($id, $future_plan_name, $time_start) {
        $query = "SELECT * FROM future_plan WHERE search_flg = " . FLG_OFF . " ";
        if (!Empty($id)) {
            $query .= " AND id LIKE '%$id%'";
        }
        if (!Empty($future_plan_name)) {
            $query .= " AND future_plan_name LIKE '%$future_plan_name%'";
        } 
        if (!Empty($time_start)) {
            $formatted_date = date('Y-m-d H:i:s', strtotime($time_start));
            $query .= " AND time_start = '$formatted_date' ";
        }
        $result = $this->database->select($query);
        return $result;
    }
    // get data future plan
    public function get_data_future_plan($id) {
        $query = "SELECT * FROM future_plan WHERE id = '$id'";
        $result = $this->database->select($query);
        return $result;
    }
    // insert future plan
    public function insert_future_plan($future_plan_name, $time_start) {
        $log_history_future_life = new log_history_future_life();
        $query = "INSERT INTO future_plan(future_plan_name, time_start) VALUES ('$future_plan_name', '$time_start')";
        $log_history_future_life->insert_log_history_future_life($future_plan_name, 1, SCREEN_LOG['MANAGE_FUTURE_PLAN']);
        $result = $this->database->insert($query);
        header('Location: admin_cp.php?action=manage_future_plan&query=show');
    }
    // update daily job
    public function update_future_plan($future_plan_name, $time_start, $id) {
        $query = "UPDATE future_plan SET future_plan_name = '$future_plan_name', time_start = '$time_start' WHERE id = '$id'";
        $result = $this->database->update($query);
        header('Location: admin_cp.php?action=manage_future_plan&query=show');
    }
    // delete future plan
    public function delete_future_plan($id) {
        $query = "DELETE FROM future_plan WHERE id = '$id'";
        $result = $this->database->delete($query);
        header('Location: admin_cp.php?action=manage_future_plan&query=show');
    }
}
?>