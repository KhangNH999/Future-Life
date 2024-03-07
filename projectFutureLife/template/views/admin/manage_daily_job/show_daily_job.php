<?php include 'actor/admin/module/manage_daily_job/manage_daily_job.php' ?>
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
    $time_start = "";
    $daily_job = new daily_job();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $daily_job_name = $_POST['daily_job_name'];
        $time_start = $_POST['time_start'];
    } else if (isset($_GET['id']) && $_GET['id'] != "") {
        $id = $_GET['id'];
    } else if (isset($_GET['name']) && $_GET['name'] != "")  {
        $daily_job_name = $_GET['name'];
    } else if (isset($_GET['time']) && $_GET['time'] != "")  {
        $time_start = $_GET['time'];
    } else {
        $id = "";
        $daily_job_name = "";
        $time_start = "";
    }

    // show daily job
    $show_daily_job = $daily_job->show_daily_job($begin, $limit, $id, $daily_job_name, $time_start);

    // get count daily job
    $row_daily_job = $daily_job->get_count_daily_job($id, $daily_job_name, $time_start);
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

    // Value daily job name
    if (isset($_POST['time_start'])) {
        $value_time_start = $_POST['time_start'];
    } else if (isset($_GET['time'])) {
        $value_time_start = $_GET['time'];
    } else {
        $value_time_start = '';
    }
?>
<form action="" method="post">
    <table class="form-search">
        <tr class="input">
            <td>Id&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="id_daily_job" name="id" value="<?php echo $value_id ?>"></td>
            <td>Tên công việc&nbsp;&nbsp;<input type="text" id="daily_job_name" name="daily_job_name" value="<?php echo $value_daily_job_name ?>"></td>
        </tr>
        <tr class="input">
            <td>Ngày bắt đầu&nbsp;&nbsp;<input type="datetime-local" id="time_start" name="time_start" value="<?php echo $value_time_start ?>"></td>
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
<?php
if ($row_count > 0) {
?>
<div class="count_records">Có <?php echo $row_count ?> kết quả tìm kiếm</div>
<div class="button-add"><a href="admin_cp.php?action=manage_daily_job&query=add" class="button-add-form"><i class="fa fa-plus"></i> Thêm</a></div>
<br>
<br>
<div class="manage_table">
    <table>
        <tr>
            <th>Id</th>
            <th>Tên công việc hàng ngày</th>
            <th>Ngày bắt đầu</th>
            <th>Chức năng</th>
        </tr>
        <?php
    if ($show_daily_job) {
        while($result = $show_daily_job->fetch_assoc()){
        ?>
        <tr>
            <td><?php echo $result['id'] ?></td>
            <td><?php echo $result['name_daily_job'] ?></td>
            <td><?php echo $result['date_start'] ?></td>
            <td><a href="admin_cp.php?action=manage_daily_job&query=edit&id_daily_job=<?php echo $result['id'] ?>"><i
                        id="pencil" class="fa fa-pencil"></i></a> <a
                    href="admin_cp.php?action=manage_daily_job&query=show&id_daily_job=<?php echo $result['id'] ?>"
                    onclick="return confirm_delete(event);"><i id="trash" class="fa fa-trash-o"></i></a></td>
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
                    if (isset($_POST['daily_job_name']) && $_POST['daily_job_name'] != "") {
                        $request_name = "&name=".$_POST['daily_job_name'];
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
                        href="admin_cp.php?action=manage_daily_job&query=search_page&page=<?php echo $i ?><?php echo $request_id ?><?php echo $request_name ?><?php echo $request_time ?>"><?php echo $i ?></a>
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
