<?php
include_once 'config/connect_db/database.php'
?>

<?php 
ob_start();
class history_future_life {
    private $database;
    // database
    public function __construct() {
        $this->database = new Database();
    }
    // data history future life
    public function show_history_future_life($begin, $limit, $from_time, $to_time) {
        $query = "SELECT * FROM history_future_life WHERE search_flg = 0 "; 
        if (!Empty($from_time)) {
            $formatted_from_time = date('Y-m-d H:i:s', strtotime($from_time));
            $query .= "AND time_history >= '$formatted_from_time' ";
        }
        if (!Empty($to_time)) {
            $formatted_to_time = date('Y-m-d H:i:s', strtotime($to_time));
            $query .= "AND time_history <= '$formatted_to_time' ";
        }
        $query .= " ORDER BY id DESC LIMIT $begin, $limit";
        $result = $this->database->select($query);
        return $result; 
    }
    // get count history future life
    public function get_count_history_future_life($from_time, $to_time) {
        $query = "SELECT * FROM history_future_life WHERE search_flg = 0";
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
}
?>