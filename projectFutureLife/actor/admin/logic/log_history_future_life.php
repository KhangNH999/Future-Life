<?php
include_once 'config/connect_db/database.php'
?>

<?php 
ob_start();
class log_history_future_life {
    private $database;
    // database
    public function __construct() {
        $this->database = new Database();
    }
    // insert log history future life
    public function insert_log_history_future_life($content_history, $user_id) {
        $query = "INSERT INTO history_future_life(content_history, user_id, time_history) VALUES ('$content_history', '$user_id', NOW())";
        $result = $this->database->insert($query);
        return $result;
    }
}
?>