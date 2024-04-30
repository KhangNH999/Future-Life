<?php
require_once 'roles/admin/const/title_screen.php';
// Set title admin
$titles = array(
  'manage_daily_job' => array(
    'show'        => TITLE_SCREEN['MANAGE_DAILY_JOB'],
    'search'      => TITLE_SCREEN['MANAGE_DAILY_JOB'],
    'edit'        => TITLE_SCREEN['MANAGE_DAILY_JOB'],
    'add'         => TITLE_SCREEN['MANAGE_DAILY_JOB'],
    'search_page' => TITLE_SCREEN['MANAGE_DAILY_JOB']
  ),
  'manage_cost' => array(
    'show'        => TITLE_SCREEN['MANAGE_COST'],
    'add'         => TITLE_SCREEN['MANAGE_COST'],
    'edit'        => TITLE_SCREEN['MANAGE_COST'],
    'search_page' => TITLE_SCREEN['MANAGE_COST']
  ),
  'download_file' => array(
    'show' => TITLE_SCREEN['DOWNLOAD_FILE']
  ),
  'manage_future_plan' => array(
    'show'        => TITLE_SCREEN['MANAGE_FUTURE_PLAN'],
    'add'         => TITLE_SCREEN['MANAGE_FUTURE_PLAN'],
    'edit'        => TITLE_SCREEN['MANAGE_FUTURE_PLAN'],
    'search_page' => TITLE_SCREEN['MANAGE_FUTURE_PLAN']
  ),
  'history_future_life' => array(
    'show'        => TITLE_SCREEN['HISTORY_FUTURE_LIFE']
  ),
  'history_daily_job' => array(
    'show'        => TITLE_SCREEN['HISTORY_FUTURE_LIFE']
  ),
  'history_cost' => array(
    'show'        => TITLE_SCREEN['HISTORY_FUTURE_LIFE']
  ),
  'history_future_plan' => array(
    'show'        => TITLE_SCREEN['HISTORY_FUTURE_LIFE']
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