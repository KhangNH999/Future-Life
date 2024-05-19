<?php
// convert to json data
header('Content-Type: application/json');
// db api
include '../../../../config/connect_db/database_api.php';

// Year chart
$year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

// SQL
$sql = "SELECT MONTH(date_used) as month, SUM(cost) as total_cost FROM cost_life WHERE YEAR(date_used) = ? GROUP BY MONTH(date_used )";
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
            "label" => "Tổng tiền chi tiêu trong tháng",
            "data" => array_fill(0, 12, 0),
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
        $data["datasets"][0]["data"][$month] = $row["total_cost"];
    }
}

// Close connection
$excute_sql->close();
$connect_db->close();

// Convert to data json
echo json_encode($data);
?>