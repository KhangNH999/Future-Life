<?php include 'roles/admin/module/manage_daily_job/manage_daily_job.php' ?>
<?php include 'roles/admin/export_file/manage_daily_job.php' ?>
<?php
  // page daily job
  $limit = 10;
  if (isset($_GET['page'])) {
    $page_get = $_GET['page'];
  } else {
    $page_get = 1;
  }
  if ($page_get == '' || $page_get == 1) {
    $begin = 0;
  } else {
    $begin = ($page_get * $limit) - $limit;
  }

  // show daily job
  $id = "";
  $daily_job_name = "";
  $time_start_from = "";
  $time_start_to = "";
  $daily_job = new daily_job();
  if (isset($_POST['button-search'])) {
    $id = $_POST['id'];
    $daily_job_name = $_POST['daily_job_name'];
    $time_start_from = $_POST['time_start_from'];
    $time_start_to = $_POST['time_start_to'];
  } else if (isset($_GET['id']) && $_GET['id'] != "") {
    $id = $_GET['id'];
  } else if (isset($_GET['name']) && $_GET['name'] != "")  {
    $daily_job_name = $_GET['name'];
  } else if (isset($_GET['time_from']) && $_GET['time_from'] != "")  {
    $time_start_from = $_GET['time_from'];
  } else if (isset($_GET['time_to']) && $_GET['time_to'] != "")  {
    $time_start_to = $_GET['time_to'];
  } else {
    $id = "";
    $daily_job_name = "";
    $time_start_from = "";
    $time_start_to = "";
  }

  // show daily job
  $show_daily_job = $daily_job->show_daily_job($begin, $limit, $id, $daily_job_name, $time_start_from, $time_start_to);

  // get count daily job
  $row_daily_job = $daily_job->get_count_daily_job($id, $daily_job_name, $time_start_from, $time_start_to);
  $row_count = 0;
  if ($row_daily_job != false) {
    $row_count = $row_daily_job->num_rows;
  }

  // Delete daily job
  if (isset($_GET['id_daily_job'])) {
    $id = $_GET['id_daily_job'];
    $delete_daily_job = $daily_job->delete_daily_job($id);
  }

  // Value id
  if (isset($_POST['id'])) {
    $value_id = $_POST['id'];
  } else if (isset($_GET['id'])) {
    $value_id = $_GET['id'];
  } else {
    $value_id = '';
  }

  // Value daily job name
  if (isset($_POST['daily_job_name'])) {
    $value_daily_job_name = $_POST['daily_job_name'];
  } else if (isset($_GET['name'])) {
    $value_daily_job_name = $_GET['name'];
  } else {
    $value_daily_job_name = '';
  }

  // Value time start from
  if (isset($_POST['time_start_from'])) {
    $value_time_start_from = $_POST['time_start_from'];
  } else if (isset($_GET['time_from'])) {
    $value_time_start_from = $_GET['time_from'];
  } else {
    $value_time_start_from = '';
  }

  // Value time start to
  if (isset($_POST['time_start_to'])) {
    $value_time_start_to = $_POST['time_start_to'];
  } else if (isset($_GET['time_to'])) {
    $value_time_start_to = $_GET['time_to'];
  } else {
    $value_time_start_to = '';
  }

  // export file cost
  $export_file = new export_file_daily_job();
  if (isset($_POST['button-export-excel-daily-job'])) {
    // Value id export
    if (isset($_POST['id'])) {
      $value_id_export = $_POST['id'];
    } else if (isset($_GET['id'])) {
      $value_id_export = $_GET['id'];
    } else {
      $value_id_export = '';
    }
    // Value daily job name export
    if (isset($_POST['daily_job_name'])) {
      $value_daily_job_name_export = $_POST['daily_job_name'];
    } else if (isset($_GET['name'])) {
      $value_daily_job_name_export = $_GET['name'];
    } else {
      $value_daily_job_name_export = '';
    }
    // Value time from export
    if (isset($_POST['time_start_from'])) {
      $value_time_from_export = $_POST['time_start_from'];
    } else if (isset($_GET['time_from'])) {
      $value_time_from_export = $_GET['time_from'];
    } else {
      $value_time_from_export = '';
    }
    // Value time to export
    if (isset($_POST['time_start_to'])) {
      $value_time_to_export = $_POST['time_start_to'];
    } else if (isset($_GET['time_to'])) {
      $value_time_to_export = $_GET['time_to'];
    } else {
      $value_time_to_export = '';
    }
    $export = $export_file->export_file($value_id_export, $value_daily_job_name_export, $value_time_from_export, $value_time_to_export);
  }

  // Update status daily job
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn-update-status-daily-job'])) {
    $daily_job = new daily_job();
    if (!empty($_POST['daily_job_ids'])) {
      $selected_ids = $_POST['daily_job_ids'];
      foreach ($selected_ids as $id_daily_job) {
        $daily_job->update_status($id_daily_job);
      }
    }
  }
?>
<form action="" method="post">
  <table class="form-search">
    <tr class="input">
      <td>Id&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="id_daily_job" name="id" value="<?php echo $value_id ?>"></td>
      <td>Tên công việc&nbsp;&nbsp;<input type="text" id="daily_job_name" name="daily_job_name" value="<?php echo $value_daily_job_name ?>"></td>
    </tr>
    <tr class="input">
      <td>Ngày bắt đầu từ&nbsp;&nbsp;<input type="datetime-local" id="time_start_from" name="time_start_from" value="<?php echo $value_time_start_from ?>"></td>
      <td>Đến ngày bắt đầu&nbsp;&nbsp;<input type="datetime-local" id="time_start_to" name="time_start_to" value="<?php echo $value_time_start_to ?>"></td>
    </tr>
    <tr class="submit">
      <td colspan="2">
        <div class="set-ml-37">
          <button class="clear-data" onclick="clear_input_daily_job()" type="submit">Xóa</button>    
          <button class="search-data" name="button-search" type="submit">Tìm kiếm</button>
        </div>  
      </td>
    </tr>
  </table>
</form>

<!-- message success download file excel -->
<?php 
if (isset($_POST['button-export-excel-daily-job'])) {
?>
  <div class="message_success"> Xuất dữ liệu excel thành công. <a href="admin_cp.php?action=download_file&query=show">Vui lòng nhấn vào đây để tải file</a></div>
  <br>
<?php
}
?>

<?php
if ($row_count > 0) {
?>
<div class="count_records">Có <?php echo $row_count ?> kết quả tìm kiếm</div>
<div class="button-add"><a href="admin_cp.php?action=manage_daily_job&query=add" class="button-add-form">Thêm</a></div>
<form action="" method="post">
  <input type="hidden" id="id_daily_job" name="id" value="<?php echo $value_id ?>">
  <input type="hidden" id="daily_job_name" name="daily_job_name" value="<?php echo $value_daily_job_name ?>">
  <input type="hidden" id="time_start_from" name="time_start_from" value="<?php echo $value_time_start_from ?>">
  <input type="hidden" id="time_start_to" name="time_start_to" value="<?php echo $value_time_start_to ?>">
  <button class="button-export-excel" type="submit" name="button-export-excel-daily-job">Xuất Excel</button>
</form>

<form action="" method="post">
  <button class="button-update-status" type="submit" name="btn-update-status-daily-job">Cập nhật tình trạng</button>
  <br>
  <br>
  <div class="manage_table">
    <table>
      <tr>
        <th><input type="checkbox"></th>
        <th>Id</th>
        <th>Tên công việc hàng ngày</th>
        <th>Ngày bắt đầu</th>
        <th>Tình trạng</th>
        <th>Chức năng</th>
      </tr>
    <?php
    if ($show_daily_job) {
      while($result = $show_daily_job->fetch_assoc()){
    ?>
      <tr>
        <td style="text-align:center;"><input type="checkbox" name="daily_job_ids[]" value="<?php echo $result['id'] ?>"></td>
        <td><?php echo $result['id'] ?></td>
        <td><?php echo $result['daily_job_name'] ?></td>
        <td><?php echo $result['time_start'] ?></td>
        <td><?php echo ($result['status']==1)?'Đã hoàn thành':'Chưa hoàn thành'; ?></td>
        <td><a href="admin_cp.php?action=manage_daily_job&query=edit&id_daily_job=<?php echo $result['id'] ?>"><i
          id="pencil" class="fa fa-pencil"></i> Chỉnh sửa</a> <a
          href="admin_cp.php?action=manage_daily_job&query=show&id_daily_job=<?php echo $result['id'] ?>"
          onclick="return confirm_delete(event);" class="trash"><i id="trash" class="fa fa-trash-o"></i> Xóa</a>
        </td>
      </tr>
    <?php
      }
    }
    ?>
    </table>
  <?php 
  } else {
  ?>
  <div class="message_warning"> Không có kết quả tìm kiếm, vui lòng tìm kiếm với từ khóa khác ! </div>
  <?php
  }
  ?>
    <!-- Page daily job -->
    <?php
    if ($row_count > 0 && $row_count > $limit) {
        $page = ceil( $row_count/ $limit);
    ?>
    <div class="page">
      <?php if ($page == '0') { ?>
        <p style="display:none;">Trang: <?php echo $page_get . "/" . $page ?></p>
      <?php } else { ?>
        <p>Trang: <?php echo $page_get . "/" . $page ?></p>
      <?php } ?>
      <ul class="list-page">
        <?php
          for ($i = 1; $i <= $page; $i++) {
        ?>
          <li 
            <?php 
              if ($i == $page_get) {
                echo 'style="background: #1C6CC1;"';
              } else {
                echo '';
              } ?>>
              <a <?php if ($i == $page_get) {
                  echo 'style="font-weight: bold; color:#fff;"';
                } else {
                  echo '';
                }

              // Request id
              if (isset($_POST['id']) && $_POST['id'] != "") {
                $request_id = "&id=".$_POST['id'];
              } else if (isset($_GET['id']) && $_GET['id'] != "") {
                $request_id = "&id=".$_GET['id'];
              } else {
                $request_id = '';
              }

              // Request name
              if (isset($_POST['daily_job_name']) && $_POST['daily_job_name'] != "") {
                $request_name = "&name=".$_POST['daily_job_name'];
              } else if (isset($_GET['name']) && $_GET['name'] != "") {
                $request_name = "&name=".$_GET['name'];
              } else {
                $request_name = '';
              }

              // Request time start from
              if (isset($_POST['time_start_from']) && $_POST['time_start_from'] != "") {
                $request_time_from = "&time_from=".$_POST['time_start_from'];
              } else if (isset($_GET['time_from']) && $_GET['time_from'] != "") {
                $request_time_from = "&time_from=".$_GET['time_from'];
              } else {
                $request_time_from = '';
              }

              // Request time start to
              if (isset($_POST['time_start_to']) && $_POST['time_start_to'] != "") {
                $request_time_to = "&time_to=".$_POST['time_start_to'];
              } else if (isset($_GET['time_to']) && $_GET['time_to'] != "") {
                $request_time_to = "&time_to=".$_GET['time_to'];
              } else {
                $request_time_to = '';
              }
            ?>
              href="admin_cp.php?action=manage_daily_job&query=search_page&page=<?php echo $i ?><?php echo $request_id ?><?php echo $request_name ?><?php echo $request_time_from ?><?php echo $request_time_to ?>"><?php echo $i ?></a>
          </li>
        <?php
          }
        ?>
      </ul>
    </div>
    <?php
    }
    ?>
  </div>
</form>