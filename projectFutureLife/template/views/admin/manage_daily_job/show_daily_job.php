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
    $daily_job = new daily_job();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $daily_job_name = $_POST['daily_job_name'];
        $time_start = $_POST['time_start'];
    $show_daily_job = $daily_job->show_daily_job($begin, $limit, $daily_job_name, $time_start);
    }
    // get count daily job
    $row_count = $daily_job->get_count_daily_job()->num_rows;

    // Delete daily job
    if (isset($_GET['id_daily_job'])) {
        $id = $_GET['id_daily_job'];
        $delete_daily_job = $daily_job->delete_daily_job($id);
    }
?>
<table class="form-search">
    <tr>
        <td>Id <input type="text" name="daily_job_name" value=""></td>
        <td>Tên công việc hàng ngày  <input type="text" name="daily_job_name" value=""></td>
    </tr>
    <tr>
        <td>Ngày bắt đầu <input type="text" name="daily_job_name" value=""></td>
        <td>Chức năng <input type="text" name="daily_job_name" value=""></td>
    </tr>
    <tr>
        <td></td>
        <td>
        <button type="submit">Xóa</button>    
        <button type="submit">Tìm kiếm</button></td>
        <td></td>
        <td></td>
    </tr>
</table>
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

    <!-- Page daily job -->
    <?php
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
                        } ?>
                        href="admin_cp.php?action=manage_daily_job&query=show&page=<?php echo $i ?>"><?php echo $i ?></a>
                </li>
            <?php
                }
            ?>
        </ul>
    </div>
</div>