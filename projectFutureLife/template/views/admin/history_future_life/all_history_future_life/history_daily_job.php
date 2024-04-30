<?php 
include 'roles/admin/module/history_future_life/history_future_life.php';
$history_future_life = new history_future_life();
$show_history_daily_job = $history_future_life->show_history_daily_job();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];
    $delete_history_daily_job = $history_future_life->delete_history($id, $action);
}
?>
<a class="link_back" href='admin_cp.php?action=history_future_life&query=show'><div class="btn-back"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Trở về màn hình lịch sử Future Life</div></a>
<div class="title-log"><i class="fa fa-folder-open"></i> Lịch sử công việc hàng ngày</div>
<?php
if ($show_history_daily_job) {
    while($result = $show_history_daily_job->fetch_assoc()){
?>
<div class="log_file">
    <div class="sub_log">
        <div class="log_info">
            <div class="log_name">Tiêu đề: <?php echo $result['title'] ?></div>
            <div class="content"><i class="fa fa-comment" aria-hidden="true"></i> Nội dung: <?php echo $result['content_history'] ?></div>
            <div class="time_log"><i class="fa fa-clock-o" aria-hidden="true"></i> Ngày thao tác: <?php echo $result['time_history'] ?></div>
            <div class="user_log"><i class="fa fa-user" aria-hidden="true"></i> Tên người dùng: Admin1</div>
        </div>
        <div class="delete_log"><a href="admin_cp.php?action=history_daily_job&query=show&id=<?php echo $result['id'] ?>" onclick="return confirm_delete(event);"><i class="fa fa-remove"></i></a></div>
    </div>
</div>
<?php
    }
}
?>