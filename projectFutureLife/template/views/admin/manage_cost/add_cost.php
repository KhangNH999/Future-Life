<?php include 'roles/admin/module/manage_cost/manage_cost.php' ?>
<!-- check check_daily_job -->
<script src="roles\admin\validate\check_cost.js"></script>
<!-- add cost -->
<?php 
  $cost_life = new cost_life();
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cost_name = $_POST['cost_name'];
    $cost = $_POST['cost'];
    $date_used = $_POST['date_used'];
    $add_cost = $cost_life->insert_cost($cost_name, $cost, $date_used);
  }
?>
<div class="form-input">
  <div class="form-header">
    <h2><i class="fa fa-flag-checkered"></i> Thêm chi tiêu hàng ngày</h2>
  </div>
  <div class="form-body">
    <form action="" name="form_cost" onsubmit = "return(check_cost());" method="post"> 
      <div class="input-group">
          <label for="cost_name">Tên chi tiêu</label>
          <input type="text" name="cost_name" value="">
          <label for="cost">Phí bỏ ra</label>
          <input type="text" name="cost" value="">
          <label for="date_used">Ngày sử dụng</label>
          <input type="datetime-local" name="date_used" value="">
      </div>
      <button type="submit">Thêm thông tin</button>
      <a class="button-back-screen" href="admin_cp.php?action=manage_cost&query=show">Trở về</a>
      <p id="error-text" style="margin-top:5px; color: red; font-weight:bold"></p>
    </form> 
  </div>
</div>
