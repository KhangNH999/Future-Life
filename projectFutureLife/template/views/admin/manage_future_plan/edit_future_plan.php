<?php include 'actor/admin/module/manage_future_plan/manage_future_plan.php' ?>
<?php
  // get data future plan
  if (isset($_GET['id_future_plan'])) {
    $id = $_GET['id_future_plan'];
    $future_plan = new future_plan();
    $get_data_future_plan = $future_plan->get_data_future_plan($id); 
    $result = $get_data_future_plan->fetch_assoc();

  // edit future plan
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $future_plan_name = $_POST['future_plan_name'];
    $time_start = $_POST['time_start'];
    $update_future_plan = $future_plan->update_future_plan($future_plan_name, $time_start, $id);
  } 
?>
<div class="form-input">
    <div class="form-header">
      <h2><i class="fa fa-edit"></i> Chỉnh sửa dự định tương lai</h2>
    </div>
    <div class="form-body">
      <form action="" method="post"> 
        <div class="input-group">
            <label for="future_plan">Tên dự định</label>
            <input type="text" name="future_plan_name" value="<?php echo $result['future_plan_name'] ?>">
            <label for="date_time">Ngày bắt đầu</label>
            <input type="datetime-local" name="time_start" value="<?php echo $result['time_start'] ?>">
        </div>
        <button type="submit">Lưu thông tin</button>
      </form> 
    </div>
</div>
<?php } ?>