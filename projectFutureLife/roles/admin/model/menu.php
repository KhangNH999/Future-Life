<?php
function add_color_menu($menu_number) {
  if(isset($_GET['action']) && $_GET['query']) {
    $function = $_GET['action'];
    $query = $_GET['query'];
  } else {
    $function = '';
    $query = '';
  }
  $conditions = array(
    array('manage_daily_job', 'show', array(1, 1.2)),
    array('manage_daily_job', 'add', array(1, 1.1)),
    array('manage_daily_job', 'edit', array(1, 1.2)),
    array('manage_daily_job', 'search_page', array(1, 1.2)),
    array('manage_cost', 'show', array(2, 2.2)),
    array('manage_cost', 'add', array(2, 2.1)),
    array('manage_cost', 'edit', array(2, 2.2)),
    array('manage_cost', 'search_page', array(2, 2.2)),
    array('download_file', 'show', array(5, 5.1)),
    array('manage_future_plan', 'show', array(3, 3.2)),
    array('manage_future_plan', 'add', array(3, 3.1)),
    array('manage_future_plan', 'edit', array(3, 3.2)),
    array('manage_future_plan', 'search_page', array(3, 3.2)),
    array('manage_chart_cost', 'show', array(4, 4.1)),
    array('manage_chart_daily_job', 'show', array(4, 4.2)),
    array('manage_chart_future_plan', 'show', array(4, 4.3)),
    array('history_future_life', 'show', array(6, 6.1)),
    array('history_daily_job', 'show', array(6, 6.1)),
    array('history_cost', 'show', array(6, 6.1)),
    array('history_future_plan', 'show', array(6, 6.1))
  );
  foreach ($conditions as $condition) {
    if ($function == $condition[0] && $query == $condition[1] && in_array($menu_number, $condition[2])) {
      if ($menu_number == end($condition[2])) {
        echo "active";
      } else {
        echo "display:block;";
      }
      return;
    }
  }
}
?>