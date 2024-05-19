<?php
// convert to json data
header('Content-Type: application/json');
// db api
include '../../../../config/connect_db/database_api.php';
// const delete
include '../../const/delete.php';

// Year chart
$year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

// SQL
$sql = "SELECT MONTH(time_start) as month, COUNT(*) as total_plan FROM future_plan WHERE status = " . FLG_ON . " AND YEAR(time_start) = ? GROUP BY MONTH(time_start )";
$excute_sql = $connect_db->prepare($sql);
if (!$excute_sql) {
    die(json_encode(['error' => 'Prepare failed: ' . $connect_db->error]));
}
$excute_sql->bind_param("i", $year);
$excute_sql->execute();
$result = $excute_sql->get_result();

// Create Array data
$data = [
    "labels" => ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
    "datasets" => [
        [
            "label" => "Số lượng kế hoạch được thực hiện trong tháng",
            "data" => array_fill(0, 12, 0), // Khởi tạo mảng với 12 phần tử có giá trị 0
            "backgroundColor" => 'rgba(54, 162, 235, 0.2)',
            "borderColor" => 'rgba(54, 162, 235, 1)',
            "borderWidth" => 1
        ]
    ]
];

// result from sql
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $month = intval($row['month']) - 1;
        $data["datasets"][0]["data"][$month] = $row["total_plan"];
    }
}

// Close connection
$excute_sql->close();
$connect_db->close();

// Convert to data json
echo json_encode($data);
?>