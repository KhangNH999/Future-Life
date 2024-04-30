<?php
include_once 'roles/admin/base/database.php';
require 'roles/admin/logic/log_history_future_life.php';
require 'roles/admin/const/delete.php';
?>
<?php
ob_start();
class cost_life {
    // database
    use base_database;
    // data cost life
    public function show_cost($begin, $limit, $id, $cost_name, $cost, $date_used) {
        $query = "SELECT * FROM cost_life WHERE search_flg = " . FLG_OFF . " ";
        if (!Empty($id)) {
            $query .= "AND id LIKE '%$id%' ";
        }
        if (!Empty($cost_name)) {
            $query .= "AND cost_name LIKE '%$cost_name%' ";
        } 
        if (!Empty($cost)) {
            $query .= "AND cost LIKE '%$cost%' ";
        }
        if (!Empty($date_used)) {
            $formatted_date = date('Y-m-d H:i:s', strtotime($date_used));
            $query .= "AND date_used = '$formatted_date' ";
        }
        $query .= " ORDER BY id DESC LIMIT $begin, $limit";
        $result = $this->database->select($query);
        return $result; 
    }
    // get count daily job
    public function get_count_cost($id, $cost_name, $cost, $date_used) {
        $query = "SELECT * FROM cost_life WHERE search_flg =" . FLG_OFF . " ";
        if (!Empty($id)) {
            $query .= " AND id LIKE '%$id%'";
        }
        if (!Empty($cost_name)) {
            $query .= " AND cost_name LIKE '%$cost_name%'";
        } 
        if (!Empty($cost)) {
            $query .= " AND cost LIKE '%$cost%'";
        }
        if (!Empty($date_used)) {
            $formatted_date = date('Y-m-d H:i:s', strtotime($date_used));
            $query .= " AND date_used = '$formatted_date' ";
        }
        $result = $this->database->select($query);
        return $result;
    }
    // get data cost
    public function get_data_cost($id) {
        $query = "SELECT * FROM cost_life WHERE id = '$id'";
        $result = $this->database->select($query);
        return $result;
    }
    // insert cost
    public function insert_cost($cost_name, $cost, $date_used) {
        $log_history_future_life = new log_history_future_life();
        $query = "INSERT INTO cost_life(cost_name, cost, date_used) VALUES ('$cost_name', '$cost', '$date_used')";
        $log_history_future_life->insert_log_history_future_life($cost_name, 1, SCREEN_LOG['MANAGE_COST']);
        $result = $this->database->insert($query);
        header('Location: admin_cp.php?action=manage_cost&query=show');
    }
    // update cost
    public function update_cost($cost_name, $cost, $date_used, $id) {
        $query = "UPDATE cost_life SET cost_name = '$cost_name', cost = '$cost', date_used = '$date_used' WHERE id = '$id'";
        $result = $this->database->update($query);
        header('Location: admin_cp.php?action=manage_cost&query=show');
    }
    // delete cost
    public function delete_cost($id) {
        $query = "DELETE FROM cost_life WHERE id = '$id'";
        $result = $this->database->delete($query);
        header('Location: admin_cp.php?action=manage_cost&query=show');
    }
}
?>