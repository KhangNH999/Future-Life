<?php
 // set title admin
 if(isset($_GET['action']) && $_GET['query']) {
   $function = $_GET['action'];
   $query = $_GET['query'];
 } else {
   $function = '';
   $query = '';
 }
 if ($function == 'manage_daily_job' && $query == 'show') {      // manage daily job
   echo "Quản lý công việc hàng ngày";
 } else if($function =='manage_daily_job' && $query == 'search') {
   echo "Quản lý công việc hàng ngày";
 } else if($function =='manage_daily_job' && $query == 'edit') {
   echo "Quản lý công việc hàng ngày";
 } else if($function =='manage_daily_job' && $query == 'add') {
    echo "Quản lý công việc hàng ngày";
 } else if($function =='manage_daily_job' && $query == 'search_page') {
  echo "Quản lý công việc hàng ngày";
 } else if($function =='manage_cost' && $query == 'show') {      // manage cost
   echo "Quản lý chi tiêu";
 } else if($function =='manage_cost' && $query == 'add') {
  echo "Quản lý chi tiêu";
 } else if($function =='manage_cost' && $query == 'edit') {
  echo "Quản lý chi tiêu";
 } else if($function =='manage_cost' && $query == 'search_page') {
  echo "Quản lý chi tiêu";
 } else if($function =='download_file' && $query == 'show') {      // download file
  echo "Nhật ký tải xuống gần đây";
 }
?>
