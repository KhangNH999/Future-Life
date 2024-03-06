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
    if (isset($_GET['id']) && $_GET['id'] != "") {
        $id = $_GET['id'];
    } else if (isset($_GET['name']) && $_GET['name'] != "")  {
        $daily_job_name = $_GET['name'];
    } else {
        $id = "";
        $daily_job_name = "";
        $time_start = "";
    }

    // show daily job
    $show_daily_job = $daily_job->show_daily_job($begin, $limit, $id, $daily_job_name, $time_start);

    // get count daily job
    $row_count = $daily_job->get_count_daily_job($id, $daily_job_name, $time_start)->num_rows;

    // Delete daily job
    if (isset($_GET['id_daily_job'])) {
        $id = $_GET['id_daily_job'];
        $delete_daily_job = $daily_job->delete_daily_job($id);
    }

    // Value id
    if (isset($_GET['id'])) {
        $value_id = $_GET['id'];
    } else {
        $value_id = '';
    }

    // Value daily job name
    if (isset($_GET['name'])) {
        $value_daily_job_name = $_GET['name'];
    } else {
        $value_daily_job_name = '';
    }
?>
<form action="admin_cp.php?action=manage_daily_job&query=show" method="post">
    <table class="form-search">
        <tr class="input">
            <td>Id&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="id" value="<?php echo $value_id?>"></td>
            <td>Tên công việc&nbsp;&nbsp;<input type="text" name="daily_job_name" value="<?php echo $value_daily_job_name?>"></td>
        </tr>
        <tr class="input">
            <td>Ngày bắt đầu&nbsp;&nbsp;<input type="text" name="time_start" value=""></td>
        </tr>
        <tr class="submit">
            <td colspan="2">
            <div class="set-ml-306px">
                    <button class="clear-data" type="submit">Xóa</button>    
                    <button class="search-data" name="button-search" type="submit">Tìm kiếm</button>
                </div>  
            </td>
        </tr>
    </table>
</form>
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
                        }

                    // Request id
                    if (isset($_GET['id']) && $_GET['id'] != "") {
                        $request_id = "&id=".$_GET['id'];
                    } else {
                        $request_id = '';
                    }

                    // Request name
                    if (isset($_GET['name']) && $_GET['name'] != "") {
                        $request_name = "&name=".$_GET['name'];
                    } 
                     else {
                        $request_name = '';
                    }
                    ?>
                        href="admin_cp.php?action=manage_daily_job&query=search_page&page=<?php echo $i ?><?php echo $request_id ?><?php echo $request_name ?>"><?php echo $i ?></a>
                </li>
            <?php
                }
            ?>
        </ul>
    </div>
</div>