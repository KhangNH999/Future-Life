<?php include 'roles/admin/module/manage_daily_job/manage_daily_job.php' ?>
<!-- check check_daily_job -->
<script src="roles\admin\validate\check_daily_job.js"></script>
<!-- add daily job -->
<?php 
  $daily_job = new daily_job();
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $daily_job_name = $_POST['daily_job_name'];
    $time_start = $_POST['time_start'];
    $add_daily_job = $daily_job->insert_daily_job($daily_job_name, $time_start);
  }
?>
<div class="form-input">
  <div class="form-header">
    <h2><i class="fa fa-flag-checkered"></i> Thêm công việc hàng ngày</h2>
  </div>
  <div class="form-body">
    <form action="" name="form_daily_job" onsubmit = "return(check_daily_job());" method="post"> 
      <div class="input-group">
          <label for="daily_job">Tên công việc</label>
          <input type="text" name="daily_job_name" value="">
          <label for="date_time">Ngày bắt đầu</label>
          <input type="datetime-local" name="time_start" value="">
      </div>
      <button type="submit">Thêm thông tin</button>
      <a class="button-back-screen" href="admin_cp.php?action=manage_daily_job&query=show">Trở về</a>
      <p id="error-text" style="margin-top:5px; color: red; font-weight:bold"></p>
    </form> 
  </div>
</div>
