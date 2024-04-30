<?php include 'roles/admin/module/manage_daily_job/manage_daily_job.php' ?>
<?php
  // get data daily job
  if (isset($_GET['id_daily_job'])) {
    $id = $_GET['id_daily_job'];
    $daily_job = new daily_job();
    $get_data_daily_job = $daily_job->get_data_daily_job($id); 
    $result = $get_data_daily_job->fetch_assoc();

  // edit daily job
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $daily_job_name = $_POST['daily_job_name'];
    $time_start = $_POST['time_start'];
    $update_daily_job = $daily_job->update_daily_job($daily_job_name, $time_start, $id);
  } 
?>
<div class="form-input">
    <div class="form-header">
      <h2><i class="fa fa-edit"></i> Chỉnh sửa công việc hàng ngày</h2>
    </div>
    <div class="form-body">
      <form action="" method="post"> 
        <div class="input-group">
            <label for="daily_job">Tên công việc</label>
            <input type="text" name="daily_job_name" value="<?php echo $result['daily_job_name'] ?>">
            <label for="date_time">Ngày bắt đầu</label>
            <input type="datetime-local" name="time_start" value="<?php echo $result['time_start'] ?>">
        </div>
        <button type="submit">Lưu thông tin</button>
        <a class="button-back-screen" href="admin_cp.php?action=manage_daily_job&query=show">Trở về</a>
      </form> 
    </div>
</div>
<?php } ?>