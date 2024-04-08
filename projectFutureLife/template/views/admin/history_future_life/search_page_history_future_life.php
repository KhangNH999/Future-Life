<?php include 'actor/admin/module/history_future_life/history_future_life.php' ?>
<?php
    // page history future life
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

    // show history future life
    $from_time = "";
    $to_time = "";
    $history_future_life = new history_future_life();
    if (isset($_GET['from_time']) && $_GET['from_time'] != "") {
        $from_time = $_GET['from_time'];
    } else if (isset($_GET['to_time']) && $_GET['to_time'] != "")  {
        $to_time = $_GET['to_time'];
    } else {
        $from_time = "";
        $to_time = "";
    }

    // show history future life
    $show_history_future_life = $history_future_life->show_history_future_life($begin, $limit, $from_time, $to_time);

    // get count history future life
    $row_history_future_life = $history_future_life->get_count_history_future_life($from_time, $to_time);
    $row_count = 0;
    if ($row_history_future_life != false) {
        $row_count = $row_history_future_life->num_rows;
    }

    // Value from time
    if (isset($_GET['from_time'])) {
        $value_from_time = $_GET['from_time'];
    } else {
        $value_from_time = '';
    }

    // Value to time
    if (isset($_GET['to_time'])) {
        $value_to_time = $_GET['to_time'];
    } else {
        $value_to_time = '';
    }
?>
<form action="admin_cp.php?action=history_future_life&query=show" method="post">
    <table class="form-search">
        <tr class="input">
            <td>Từ ngày&nbsp;&nbsp;<input type="datetime-local" id="from_time" name="from_time" value="<?php echo $value_from_time ?>"></td>
            <td>Đến ngày&nbsp;&nbsp;<input type="datetime-local" id="to_time" name="to_time" value="<?php echo $value_to_time ?>"></td>
        </tr>
        <tr class="submit">
            <td colspan="2">
            <div class="set-ml-37">
                    <button class="clear-data" onclick="clear_input_history_future_life()" type="submit">Xóa</button>    
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
<br>
<br>
<div class="manage_table">
    <table>
        <tr>
            <th>Id</th>
            <th>Nội dung</th>
            <th>Người dùng</th>
            <th>Ngày</th>
        </tr>
        <?php
    if ($show_history_future_life) {
        while($result = $show_history_future_life->fetch_assoc()){
        ?>
        <tr>
            <td><?php echo $result['id'] ?></td>
            <td><?php echo $result['content_history'] ?></td>
            <td><?php echo $result['user_id'] ?></td>
            <td><?php echo $result['time_history'] ?></td>
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
    <!-- Page history future life-->
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

                    // Request from time
                    if (isset($_GET['from_time']) && $_GET['from_time'] != "") {
                        $request_from_time = "&from_time=".$_GET['from_time'];
                    } else {
                        $request_from_time = '';
                    }

                    // Request to time
                    if (isset($_GET['to_time']) && $_GET['to_time'] != "") {
                        $request_to_time = "&to_time=".$_GET['to_time'];
                    } else {
                        $request_to_time = '';
                    }

                    ?>
                        href="admin_cp.php?action=history_future_life&query=search_page&page=<?php echo $i ?><?php echo $request_from_time ?><?php echo $request_to_time ?>"><?php echo $i ?></a>
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
