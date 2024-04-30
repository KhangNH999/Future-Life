<?php include 'roles/admin/module/manage_future_plan/manage_future_plan.php' ?>
<!-- check manage_future_plan -->
<script src="roles\admin\validate\check_future_plan.js"></script>
<!-- add future plan -->
<?php 
  $future_plan = new future_plan();
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $future_plan_name = $_POST['future_plan_name'];
    $time_start = $_POST['time_start'];
    $add_future_plan = $future_plan->insert_future_plan($future_plan_name, $time_start);
  }
?>
<div class="form-input">
  <div class="form-header">
    <h2><i class="fa fa-flag-checkered"></i> Thêm dự định tương lai</h2>
  </div>
  <div class="form-body">
    <form action="" name="form_future_plan" onsubmit = "return(check_future_plan());" method="post"> 
      <div class="input-group">
          <label for="future_plan">Tên công việc</label>
          <input type="text" name="future_plan_name" value="">
          <label for="date_time">Ngày bắt đầu</label>
          <input type="datetime-local" name="time_start" value="">
      </div>
      <button type="submit">Thêm thông tin</button>
      <a class="button-back-screen" href="admin_cp.php?action=manage_future_plan&query=show">Trở về</a>
      <p id="error-text" style="margin-top:5px; color: red; font-weight:bold"></p>
    </form> 
  </div>
</div>
