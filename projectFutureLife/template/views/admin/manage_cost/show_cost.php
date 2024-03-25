<?php include 'actor/admin/module/manage_cost/manage_cost.php' ?>
<?php include 'actor/admin/export_file/manage_cost.php' ?>
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
    $cost_name = "";
    $cost = "";
    $date_used = "";
    $cost_life = new cost_life();
    if (isset($_POST['button-search'])) {
        $id = $_POST['id'];
        $cost_name = $_POST['cost_name'];
        $cost = $_POST['cost'];
        $date_used = $_POST['date_used'];
    } else if (isset($_GET['id']) && $_GET['id'] != "") {
        $id = $_GET['id'];
    } else if (isset($_GET['name']) && $_GET['name'] != "")  {
        $cost_name = $_GET['name'];
    } else if (isset($_GET['cost']) && $_GET['cost'] != "")  {
        $cost = $_GET['cost'];
    } else if (isset($_GET['time']) && $_GET['time'] != "")  {
        $date_used = $_GET['time'];
    } else {
        $id = "";
        $cost_name = "";
        $cost = "";
        $date_used = "";
    }

    // show cost life
    $show_cost = $cost_life->show_cost($begin, $limit, $id, $cost_name, $cost, $date_used);

    // get count cost
    $row_cost = $cost_life->get_count_cost($id, $cost_name, $cost, $date_used);
    $row_count = 0;
    if ($row_cost != false) {
        $row_count = $row_cost->num_rows;
    }

    // Delete cost
    if (isset($_GET['id_cost'])) {
        $id = $_GET['id_cost'];
        $delete_cost = $cost_life->delete_cost($id);
    }

    // Value id
    if (isset($_POST['id'])) {
        $value_id = $_POST['id'];
    } else if (isset($_GET['id'])) {
        $value_id = $_GET['id'];
    } else {
        $value_id = '';
    }

    // Value cost name
    if (isset($_POST['cost_name'])) {
        $value_cost_name = $_POST['cost_name'];
    } else if (isset($_GET['name'])) {
        $value_cost_name = $_GET['name'];
    } else {
        $value_cost_name = '';
    }

    // Value cost
    if (isset($_POST['cost'])) {
        $value_cost = $_POST['cost'];
    } else if (isset($_GET['cost'])) {
        $value_cost = $_GET['cost'];
    } else {
        $value_cost = '';
    }

    // Value date used
    if (isset($_POST['date_used'])) {
        $value_date_used = $_POST['date_used'];
    } else if (isset($_GET['time'])) {
        $value_date_used = $_GET['time'];
    } else {
        $value_date_used = '';
    }

    // export file cost
    $export_file = new export_file_cost();
    if (isset($_POST['button-export-excel-cost'])) {
        // Value id export
        if (isset($_POST['id'])) {
            $value_id_export = $_POST['id'];
        } else if (isset($_GET['id'])) {
            $value_id_export = $_GET['id'];
        } else {
            $value_id_export = '';
        }

        // Value cost name export
        if (isset($_POST['cost_name'])) {
            $value_cost_name_export = $_POST['cost_name'];
        } else if (isset($_GET['name'])) {
            $value_cost_name_export = $_GET['name'];
        } else {
            $value_cost_name_export = '';
        }

        // Value cost export
        if (isset($_POST['cost'])) {
            $value_cost_export = $_POST['cost'];
        } else if (isset($_GET['cost'])) {
            $value_cost_export = $_GET['cost'];
        } else {
            $value_cost_export = '';
        }

        // Value date used export
        if (isset($_POST['date_used'])) {
            $value_date_used_export = $_POST['date_used'];
        } else if (isset($_GET['time'])) {
            $value_date_used_export = $_GET['time'];
        } else {
            $value_date_used_export = '';
        }
        $export = $export_file->export_file($value_id_export, $value_cost_name_export, $value_cost_export, $value_date_used_export);
    }

?>
<form action="" method="post">
    <table class="form-search">
        <tr class="input">
            <td>Id&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;<input type="text" id="id_cost" name="id" value="<?php echo $value_id ?>"></td>
            <td>Tên chi phí&emsp;&nbsp;&nbsp;<input type="text" id="cost_name" name="cost_name" value="<?php echo $value_cost_name ?>"></td>
        </tr>
        <tr class="input">
            <td>Số tiền bỏ ra&nbsp;&nbsp;<input type="text" id="cost" name="cost" value="<?php echo $value_cost ?>"></td>
            <td>Ngày sử dụng&nbsp;&nbsp;<input type="datetime-local" id="date_used" name="date_used" value="<?php echo $value_date_used ?>"></td>
        </tr>
        <tr class="submit">
            <td colspan="2">
            <div class="set-ml-37">
                    <button class="clear-data" onclick="clear_input_cost()" type="submit">Xóa</button>    
                    <button class="search-data" name="button-search" type="submit">Tìm kiếm</button>
                </div>  
            </td>
        </tr>
    </table>
</form>

<!-- message success download file excel -->
<?php 
if (isset($_POST['button-export-excel-cost'])) {
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
<div class="button-add"><a href="admin_cp.php?action=manage_cost&query=add" class="button-add-form">Thêm</a></div>
<form action="" method="post">
    <input type="hidden" id="id_cost" name="id" value="<?php echo $value_id ?>">
    <input type="hidden" id="cost_name" name="cost_name" value="<?php echo $value_cost_name ?>">
    <input type="hidden" id="cost" name="cost" value="<?php echo $value_cost ?>">
    <input type="hidden" id="date_used" name="date_used" value="<?php echo $value_date_used ?>">
    <div><button class="button-export-excel" type="submit" name="button-export-excel-cost">Xuất Excel</a></div>
</form>
<br>
<div class="manage_table">
    <table>
        <tr>
            <th>Id</th>
            <th>Tên chi phí</th>
            <th>Số tiền bỏ ra</th>
            <th>Ngày sử dụng</th>
            <th>Chức năng</th>
        </tr>
        <?php
    if ($show_cost) {
        while($result = $show_cost->fetch_assoc()){
        ?>
        <tr>
            <td><?php echo $result['id'] ?></td>
            <td><?php echo $result['cost_name'] ?></td>
            <td><?php echo number_format($result['cost'], 0, '.', ',') . ' ₫'; ?></td>
            <td><?php echo $result['date_used'] ?></td>
            <td><a href="admin_cp.php?action=manage_cost&query=edit&id_cost=<?php echo $result['id'] ?>"><i id ="pencil" class="fa fa-pencil"></i> Chỉnh sửa</a> <a href="admin_cp.php?action=manage_cost&query=show&id_cost=<?php echo $result['id'] ?>" onclick="return confirm_delete(event);" class="trash"><i
            id ="trash" class="fa fa-trash-o"></i> Xóa</a></td>
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
                    if (isset($_POST['cost_name']) && $_POST['cost_name'] != "") {
                        $request_name = "&name=".$_POST['cost_name'];
                    } else if (isset($_GET['name']) && $_GET['name'] != "") {
                        $request_name = "&name=".$_GET['name'];
                    } else {
                        $request_name = '';
                    }

                    // Request cost
                    if (isset($_POST['cost']) && $_POST['cost'] != "") {
                        $request_cost = "&cost=".$_POST['cost'];
                    } else if (isset($_GET['cost']) && $_GET['cost'] != "") {
                        $request_cost = "&cost=".$_GET['cost'];
                    } else {
                        $request_cost = '';
                    }

                    // Request time
                    if (isset($_POST['date_used']) && $_POST['date_used'] != "") {
                        $request_time = "&time=".$_POST['date_used'];
                    } else if (isset($_GET['time']) && $_GET['time'] != "") {
                        $request_time = "&time=".$_GET['time'];
                    } else {
                        $request_time = '';
                    }

                    ?>
                        href="admin_cp.php?action=manage_cost&query=search_page&page=<?php echo $i ?><?php echo $request_id ?><?php echo $request_name ?><?php echo $request_cost ?><?php echo $request_time ?>"><?php echo $i ?></a>
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