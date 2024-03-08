<?php
include_once 'config/connect_db/database.php'
?>

<?php 
ob_start();
class cost_life {
    private $database;
    // database
    public function __construct() {
        $this->database = new Database();
    }
    // data cost life
    public function show_cost($begin, $limit, $id, $cost_name, $cost, $date_used) {
        $query = "SELECT * FROM cost_life WHERE search_flg = 0 ";
        if (!Empty($id)) {
            $query .= "AND id LIKE '%$id%' ";
        }
        if (!Empty($cost_name)) {
            $query .= "AND name LIKE '%$cost_name%' ";
        } 
        if (!Empty($cost)) {
            $query .= "AND cost LIKE '%$cost%' ";
        }
        if (!Empty($date_used)) {
            $query .= "AND date_used LIKE '%$date_used%' ";
        }
        $query .= " ORDER BY id DESC LIMIT $begin, $limit";
        $result = $this->database->select($query);
        return $result; 
    }
    // get count daily job
    public function get_count_cost($id, $cost_name, $cost, $date_used) {
        $query = "SELECT * FROM cost_life WHERE search_flg = 0";
        if (!Empty($id)) {
            $query .= " AND id LIKE '%$id%'";
        }
        if (!Empty($cost_name)) {
            $query .= " AND name LIKE '%$cost_name%'";
        } 
        if (!Empty($cost)) {
            $query .= " AND cost LIKE '%$cost%'";
        }
        if (!Empty($date_used)) {
            $query .= " AND date_used LIKE '%$date_used%'";
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
    //insert cost
    public function insert_cost($cost_name, $cost, $date_used) {
        $query = "INSERT INTO cost_life(name, cost, date_used) VALUES ('$cost_name', '$cost', '$date_used')";
        $result = $this->database->insert($query);
        header('Location: admin_cp.php?action=manage_cost&query=show');
    }
    //update cost
    public function update_cost($cost_name, $cost, $date_used, $id) {
        $query = "UPDATE cost_life SET name = '$cost_name', cost = '$cost', date_used = '$date_used' WHERE id = '$id'";
        $result = $this->database->delete($query);
        header('Location: admin_cp.php?action=manage_cost&query=show');
    }
    //delete cost
    public function delete_cost($id) {
        $query = "DELETE FROM cost_life WHERE id = '$id'";
        $result = $this->database->delete($query);
        header('Location: admin_cp.php?action=manage_cost&query=show');
    }
}
?>