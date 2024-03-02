<?php
// if not login, return login admin
if ($_SESSION['login_admin'] == 1) {
  if(isset($_GET['action']) && $_GET['query']) {
    $function = $_GET['action'];
    $query = $_GET['query'];
  } else {
    $function = '';
    $query = '';
  }
  if ($function == 'manage_daily_job' && $query == 'search') {             // daily job
    include("template/views/admin/manage_daily_job/search_daily_job.php");
  } else if($function =='manage_daily_job' && $query == 'add') {
    include("template/views/admin/manage_daily_job/show_daily_job.php");
  } else if($function =='manage_daily_job' && $query == 'add') {
    include("template/views/admin/manage_daily_job/add_daily_job.php");
  } else if($function =='manage_daily_job' && $query == 'edit') {
    include("template/views/admin/manage_daily_job/edit_daily_job.php");
  } else if($function =='manage_cost' && $query == 'show') {             // cost life
    include("template/views/admin/manage_cost/show_cost.php");
  } else if($function =='manage_cost' && $query == 'add') {
    include("template/views/admin/manage_cost/add_cost.php");
  } else if($function =='manage_cost' && $query == 'edit') {
    include("template/views/admin/manage_cost/edit_cost.php");
  } else {
    include("template/views/admin/manage_daily_job/show_daily_job.php");
  }
} else {
  header("location: template/views/admin/login_admin/login_admin.php");
}
?>