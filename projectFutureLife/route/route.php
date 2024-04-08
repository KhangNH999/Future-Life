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
  if($function =='manage_daily_job' && $query == 'show') {                        // daily job
    include("template/views/admin/manage_daily_job/show_daily_job.php");
  } else if($function =='manage_daily_job' && $query == 'add') {
    include("template/views/admin/manage_daily_job/add_daily_job.php");
  } else if($function =='manage_daily_job' && $query == 'edit') {
    include("template/views/admin/manage_daily_job/edit_daily_job.php");
  } else if($function =='manage_daily_job' && $query == 'search_page') {
    include("template/views/admin/manage_daily_job/search_page_daily_job.php");
  } else if($function =='manage_cost' && $query == 'show') {                      // cost life
    include("template/views/admin/manage_cost/show_cost.php");
  } else if($function =='manage_cost' && $query == 'add') {
    include("template/views/admin/manage_cost/add_cost.php");
  } else if($function =='manage_cost' && $query == 'edit') {
    include("template/views/admin/manage_cost/edit_cost.php");
  } else if($function =='manage_cost' && $query == 'search_page') {
    include("template/views/admin/manage_cost/search_page_cost.php");
  } else if($function =='manage_future_plan' && $query == 'show') {               // future plan
    include("template/views/admin/manage_future_plan/show_future_plan.php");
  } else if($function =='manage_future_plan' && $query == 'add') {
    include("template/views/admin/manage_future_plan/add_future_plan.php");
  } else if($function =='manage_future_plan' && $query == 'edit') {
    include("template/views/admin/manage_future_plan/edit_future_plan.php");
  } else if($function =='manage_future_plan' && $query == 'search_page') {
    include("template/views/admin/manage_future_plan/search_page_future_plan.php");
  } else if($function =='download_file' && $query == 'show') {                       // download file
    include("template/views/admin/download_file/download_file.php");
  } else if($function =='history_future_life' && $query == 'show') {                 // history future life
    include("template/views/admin/history_future_life/show_history_future_life.php");
  } else if($function =='history_future_life' && $query == 'search_page') {
    include("template/views/admin/history_future_life/search_page_history_future_life.php");
  } else {
    include("template/views/admin/manage_daily_job/show_daily_job.php");
  }
} else {
  header("location: template/views/admin/login_admin/login_admin.php");
}
?>