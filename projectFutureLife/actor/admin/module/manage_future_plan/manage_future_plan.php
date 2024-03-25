<?php
include_once 'config/connect_db/database.php'
?>

<?php 
ob_start();
class future_plan {
    private $database;
    // database
    public function __construct() {
        $this->database = new Database();
    }
    // data daily job
    public function show_future_plan($begin, $limit, $id, $future_plan_name, $time_start) {
        $query = "SELECT * FROM future_plan WHERE search_flg = 0 ";
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
        $query = "SELECT * FROM future_plan WHERE search_flg = 0";
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
        $query = "INSERT INTO future_plan(future_plan_name, time_start) VALUES ('$future_plan_name', '$time_start')";
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