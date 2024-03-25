<?php include 'actor/admin/module/manage_future_plan/manage_future_plan.php' ?>
<?php include 'actor/admin/export_file/manage_future_plan.php' ?>
<?php
    // page future plan
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

    // show future plan
    $id = "";
    $future_plan_name = "";
    $time_start = "";
    $future_plan = new future_plan();
    if (isset($_POST['button-search'])) {
        $id = $_POST['id'];
        $daily_job_name = $_POST['future_plan_name'];
        $time_start = $_POST['time_start'];
    } else if (isset($_GET['id']) && $_GET['id'] != "") {
        $id = $_GET['id'];
    } else if (isset($_GET['name']) && $_GET['name'] != "")  {
        $daily_job_name = $_GET['name'];
    } else if (isset($_GET['time']) && $_GET['time'] != "")  {
        $time_start = $_GET['time'];
    } else {
        $id = "";
        $future_plan_name = "";
        $time_start = "";
    }

    // show future plan
    $show_future_plan = $future_plan->show_future_plan($begin, $limit, $id, $future_plan_name, $time_start);

    // get count future plan
    $row_future_plan = $future_plan->get_count_future_plan($id, $future_plan_name, $time_start);
    $row_count = 0;
    if ($row_future_plan != false) {
        $row_count = $row_future_plan->num_rows;
    }

    // Delete future plan
    if (isset($_GET['id_future_plan'])) {
        $id = $_GET['id_future_plan'];
        $delete_future_plan = $future_plan->delete_future_plan($id);
    }

    // Value id
    if (isset($_POST['id'])) {
        $value_id = $_POST['id'];
    } else if (isset($_GET['id'])) {
        $value_id = $_GET['id'];
    } else {
        $value_id = '';
    }

    // Value future plan name
    if (isset($_POST['future_plan_name'])) {
        $value_future_plan_name = $_POST['future_plan_name'];
    } else if (isset($_GET['name'])) {
        $value_future_plan_name = $_GET['name'];
    } else {
        $value_future_plan_name = '';
    }

    // Value time start
    if (isset($_POST['time_start'])) {
        $value_time_start = $_POST['time_start'];
    } else if (isset($_GET['time'])) {
        $value_time_start = $_GET['time'];
    } else {
        $value_time_start = '';
    }

    // export file cost
    $export_file = new export_file_future_plan();
    if (isset($_POST['button-export-excel-future-plan'])) {
        // Value id export
        if (isset($_POST['id'])) {
            $value_id_export = $_POST['id'];
        } else if (isset($_GET['id'])) {
            $value_id_export = $_GET['id'];
        } else {
            $value_id_export = '';
        }

        // Value future plan name export
        if (isset($_POST['future_plan_name'])) {
            $value_future_plan_name_export = $_POST['future_plan_name'];
        } else if (isset($_GET['name'])) {
            $value_future_plan_name_export = $_GET['name'];
        } else {
            $value_future_plan_name_export = '';
        }

        // Value time export
        if (isset($_POST['time_start'])) {
            $value_time_export = $_POST['time_start'];
        } else if (isset($_GET['time'])) {
            $value_time_export = $_GET['time'];
        } else {
            $value_time_export = '';
        }
        $export = $export_file->export_file($value_id_export, $value_future_plan_name_export, $value_time_export);
    }
?>
<form action="" method="post">
    <table class="form-search">
        <tr class="input">
            <td>Id&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="id_future_plan" name="id" value="<?php echo $value_id ?>"></td>
            <td>Tên công việc&nbsp;&nbsp;<input type="text" id="future_plan_name" name="future_plan_name" value="<?php echo $value_future_plan_name ?>"></td>
        </tr>
        <tr class="input">
            <td>Ngày bắt đầu&nbsp;&nbsp;<input type="datetime-local" id="time_start" name="time_start" value="<?php echo $value_time_start ?>"></td>
        </tr>
        <tr class="submit">
            <td colspan="2">
            <div class="set-ml-37">
                    <button class="clear-data" onclick="clear_input_future_plan()" type="submit">Xóa</button>    
                    <button class="search-data" name="button-search" type="submit">Tìm kiếm</button>
                </div>  
            </td>
        </tr>
    </table>
</form>

<!-- message success download file excel -->
<?php 
if (isset($_POST['button-export-excel-future-plan'])) {
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
<div class="button-add"><a href="admin_cp.php?action=manage_future_plan&query=add" class="button-add-form">Thêm</a></div>
<form action="" method="post">
    <input type="hidden" id="id_future_plan" name="id" value="<?php echo $value_id ?>">
    <input type="hidden" id="future_plan_name" name="future_plan_name" value="<?php echo $value_future_plan_name ?>">
    <input type="hidden" id="time_start" name="time_start" value="<?php echo $value_time_start ?>">
    <div><button class="button-export-excel" type="submit" name="button-export-excel-future-plan">Xuất Excel</a></div>
</form>
<br>
<br>
<div class="manage_table">
    <table>
        <tr>
            <th>Id</th>
            <th>Tên dự định tương lai</th>
            <th>Ngày bắt đầu</th>
            <th>Chức năng</th>
        </tr>
        <?php
    if ($show_future_plan) {
        while($result = $show_future_plan->fetch_assoc()){
        ?>
        <tr>
            <td><?php echo $result['id'] ?></td>
            <td><?php echo $result['future_plan_name'] ?></td>
            <td><?php echo $result['time_start'] ?></td>
            <td><a href="admin_cp.php?action=manage_future_plan&query=edit&id_future_plan=<?php echo $result['id'] ?>"><i
                        id="pencil" class="fa fa-pencil"></i> Chỉnh sửa</a> <a
                    href="admin_cp.php?action=manage_future_plan&query=show&id_future_plan=<?php echo $result['id'] ?>"
                    onclick="return confirm_delete(event);" class="trash"><i id="trash" class="fa fa-trash-o"></i> Xóa</a></td>
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

    <!-- Page future plan -->
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
                <li <?php if ($i == $page_get) {
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
                    if (isset($_POST['future_plan_name']) && $_POST['future_plan_name'] != "") {
                        $request_name = "&name=".$_POST['future_plan_name'];
                    } else if (isset($_GET['name']) && $_GET['name'] != "") {
                        $request_name = "&name=".$_GET['name'];
                    } else {
                        $request_name = '';
                    }

                    // Request time start
                    if (isset($_POST['time_start']) && $_POST['time_start'] != "") {
                        $request_time = "&time=".$_POST['time_start'];
                    } else if (isset($_GET['time']) && $_GET['time'] != "") {
                        $request_time = "&time=".$_GET['time'];
                    } else {
                        $request_time = '';
                    }

                    ?>
                        href="admin_cp.php?action=manage_future_plan&query=search_page&page=<?php echo $i ?><?php echo $request_id ?><?php echo $request_name ?><?php echo $request_time ?>"><?php echo $i ?></a>
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
