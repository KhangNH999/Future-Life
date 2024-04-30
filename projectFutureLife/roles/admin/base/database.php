<?php
include_once 'config/connect_db/database.php';
?>
<?php
trait base_database {
    public $database;
    // database
    public function __construct() {
        $this->database = new Database();
    }
}
?>