<?php include 'actor/admin/module/manage_cost/manage_cost.php' ?>
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

    // show cost life
    $cost_life = new cost_life();
    $show_cost = $cost_life->show_cost($begin, $limit);

    // get count daily job
    $row_count = $cost_life->get_count_cost()->num_rows;

    // Delete daily job
    if (isset($_GET['id_cost'])) {
        $id = $_GET['id_cost'];
        $delete_cost = $cost_life->delete_cost($id);
    }
?>
<div class="button-add"><a href="admin_cp.php?action=manage_cost&query=add" class="button-add-form"><i class="fa fa-plus"></i>  Thêm</a></div>
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
            <td><?php echo $result['name'] ?></td>
            <td><?php echo number_format($result['cost'], 0, '.', ',') . ' ₫'; ?></td>
            <td><?php echo $result['date_used'] ?></td>
            <td><a href="admin_cp.php?action=manage_cost&query=edit&id_cost=<?php echo $result['id'] ?>"><i id ="pencil" class="fa fa-pencil"></i></a> <a href="admin_cp.php?action=manage_cost&query=show&id_cost=<?php echo $result['id'] ?>" onclick="return confirm_delete(event);"><i
            id ="trash" class="fa fa-trash-o"></i></a></td>
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
                        href="admin_cp.php?action=manage_cost&query=show&page=<?php echo $i ?>"><?php echo $i ?></a>
                </li>
            <?php
                }
            ?>
        </ul>
    </div>
</div>