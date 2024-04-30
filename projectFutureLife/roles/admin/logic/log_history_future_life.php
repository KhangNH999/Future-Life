<?php
include_once 'config/connect_db/database.php';
include 'roles/admin/const/screen_log.php';
?>

<?php 
ob_start();
class log_history_future_life {
    // database
    private $database;
    public function __construct() {
        $this->database = new Database();
    }

    /**
     * insert log history future life
     * @params $name [string]
     * @params $user_id [int]
     * @params $screen_id [int]
     * return [boolean]
     */
    public function insert_log_history_future_life($name, $user_id, $screen_id) {
        $title = "";
        $content_history = "";
        if ($screen_id == SCREEN_LOG['MANAGE_DAILY_JOB']) {
            $title = 'Thêm dữ liệu công việc hàng ngày';
            $content_history = 'Công việc "' . $name . '" đã được thêm vào.';
        }
        if ($screen_id == SCREEN_LOG['MANAGE_COST']) {
            $title = 'Thêm dữ liệu chi tiêu';
            $content_history = 'Chi tiêu "' . $name . '" đã được thêm vào.';
        }
        if ($screen_id == SCREEN_LOG['MANAGE_FUTURE_PLAN']) {
            $title = 'Thêm dữ liệu dự định tương lai';
            $content_history = 'Dự định "' . $name . '" đã được thêm vào.';
        }
        $query = "INSERT INTO history_future_life(title, content_history, user_id, time_history, screen_id) VALUES ('$title', '$content_history', '$user_id', NOW(), '$screen_id')";
        $result = $this->database->insert($query);
        return $result;
    }
}
?>