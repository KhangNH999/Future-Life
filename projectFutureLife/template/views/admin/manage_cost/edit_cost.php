<?php include 'actor/admin/module/manage_cost/manage_cost.php' ?>
<?php
  // get data cost
  if (isset($_GET['id_cost'])) {
    $id = $_GET['id_cost'];
    $cost_life = new cost_life();
    $get_data_cost = $cost_life->get_data_cost($id); 
    $result = $get_data_cost->fetch_assoc();

  // edit cost
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cost_name = $_POST['cost_name'];
    $cost = $_POST['cost'];
    $date_used = $_POST['date_used'];
    $update_cost = $cost_life->update_cost($cost_name, $cost, $date_used, $id);
  } 
?>
<div class="form-input">
    <div class="form-header">
      <h2><i class="fa fa-edit"></i> Chỉnh sửa chi tiêu hàng ngày</h2>
    </div>
    <div class="form-body">
      <form action="" method="post"> 
        <div class="input-group">
            <label for="cost_name">Tên chi tiêu</label>
            <input type="text" name="cost_name" value="<?php echo $result['cost_name'] ?>">
            <label for="cost">Phí bỏ ra</label>
            <input type="text" name="cost" value="<?php echo $result['cost'] ?>">
            <label for="date_used">Ngày sử dụng</label>
            <input type="datetime-local" name="date_used" value="<?php echo $result['date_used'] ?>">
        </div>
        <button type="submit">Lưu thông tin</button>
      </form> 
    </div>
</div>
<?php } ?>