<?php
// Set title admin
$titles = array(
  'manage_daily_job' => array(
    'show' => "Quản lý công việc hàng ngày",
    'search' => "Quản lý công việc hàng ngày",
    'edit' => "Quản lý công việc hàng ngày",
    'add' => "Quản lý công việc hàng ngày",
    'search_page' => "Quản lý công việc hàng ngày"
  ),
  'manage_cost' => array(
    'show' => "Quản lý chi tiêu",
    'add' => "Quản lý chi tiêu",
    'edit' => "Quản lý chi tiêu",
    'search_page' => "Quản lý chi tiêu"
  ),
  'download_file' => array(
    'show' => "Nhật ký tải xuống gần đây"
  ),
  'manage_future_plan' => array(
    'show' => "Quản lý dự định tương lai",
    'add' => "Quản lý dự định tương lai",
    'edit' => "Quản lý dự định tương lai",
    'search_page' => "Quản lý dự định tương lai"
  ),
  'history_future_life' => array(
    'show' => "Lịch sử Future Life",
    'search_page' => "Lịch sử Future Life"
  )
);

if (isset($_GET['action']) && isset($_GET['query'])) {
  $function = $_GET['action'];
  $query = $_GET['query'];

  if (isset($titles[$function][$query])) {
    echo $titles[$function][$query];
  }
}
?>