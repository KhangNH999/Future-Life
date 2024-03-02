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
    } else if($function =='manage_daily_job' && $query == 'add' && $menu_number == 1) {
      echo "active";
    } else if($function =='manage_daily_job' && $query == 'edit' && $menu_number == 1) {
      echo "active";
    } else if($function =='manage_cost' && $query == 'show' && $menu_number == 2) {             // cost life
      echo "active";
    } else if($function =='manage_cost' && $query == 'add' && $menu_number == 2) {
      echo "active";
    } else if($function =='manage_cost' && $query == 'edit' && $menu_number == 2) {
      echo "active";
    }
}
?>