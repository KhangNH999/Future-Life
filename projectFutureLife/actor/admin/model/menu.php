<?php
function add_color_menu($menu_number) {
    if(isset($_GET['action']) && $_GET['query']) {
      $function = $_GET['action'];
      $query = $_GET['query'];
    } else {
      $function = '';
      $query = '';
    }
    if ($function == 'manage_daily_job' && $query == 'show' && $menu_number == 1) {             // daily job
      echo "active";
    } else if ($function =='manage_daily_job' && $query == 'add' && $menu_number == 1) {
      echo "active";
    } else if ($function =='manage_daily_job' && $query == 'edit' && $menu_number == 1) {
      echo "active";
    } else if ($function =='manage_daily_job' && $query == 'search_page' && $menu_number == 1) {
      echo "active";
    } else if ($function =='manage_cost' && $query == 'show' && $menu_number == 2) {             // cost life
      echo "active";
    } else if ($function =='manage_cost' && $query == 'add' && $menu_number == 2) {
      echo "active";
    } else if ($function =='manage_cost' && $query == 'edit' && $menu_number == 2) {
      echo "active";
    } else if ($function =='manage_cost' && $query == 'search_page' && $menu_number == 2) {
      echo "active";
    } else if ($function =='download_file' && $query == 'show' && $menu_number == 5) {            // download file
      echo "active";
    } else if ($function =='manage_future_plan' && $query == 'show' && $menu_number == 3) {       // manage future plan
      echo "active";
    } else if ($function =='manage_future_plan' && $query == 'add' && $menu_number == 3) {
      echo "active";
    } else if ($function =='manage_future_plan' && $query == 'edit' && $menu_number == 3) {   
      echo "active";
    } else if ($function =='manage_future_plan' && $query == 'search_page' && $menu_number == 3) {
      echo "active";
    }
}
?>