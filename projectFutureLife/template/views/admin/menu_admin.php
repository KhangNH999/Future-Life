<?php include("actor/admin/model/menu.php"); ?>
<li>
    <a><i class="fa fa-check-square-o"></i>Quản lý công việc hàng ngày</a>
    <ul style="<?php add_color_menu(1); ?>" class="sub_menu">
        <li class=<?php add_color_menu(1.1); ?>><a href="admin_cp.php?action=manage_daily_job&query=add"><i class="fa fa-arrow-circle-right"></i>Thêm công việc hàng ngày</a></li>
        <li class=<?php add_color_menu(1.2); ?>><a href="admin_cp.php?action=manage_daily_job&query=show"><i class="fa fa-arrow-circle-right"></i>Tìm kiếm công việc hàng ngày</a></li>
    </ul>
</li>
<li>
    <a><i class="fa fa-list-alt"></i>Quản lý chi tiêu</a>
    <ul style="<?php add_color_menu(2); ?>" class="sub_menu">
        <li class=<?php add_color_menu(2.1); ?>><a href="admin_cp.php?action=manage_cost&query=add"><i class="fa fa-arrow-circle-right"></i>Thêm chi tiêu</a></li>
        <li class=<?php add_color_menu(2.2); ?>><a href="admin_cp.php?action=manage_cost&query=show"><i class="fa fa-arrow-circle-right"></i>Tìm kiếm chi tiêu</a></li>
    </ul>
</li>
<li>
    <a><i class="fa fa-bullhorn"></i>Quản lý dự định tương lai</a>
    <ul style="<?php add_color_menu(3); ?>" class="sub_menu">
        <li class=<?php add_color_menu(3.1); ?>><a href="admin_cp.php?action=manage_future_plan&query=add"><i class="fa fa-arrow-circle-right"></i>Thêm dự định</a></li>
        <li class=<?php add_color_menu(3.2); ?>><a href="admin_cp.php?action=manage_future_plan&query=show"><i class="fa fa-arrow-circle-right"></i>Tìm kiếm dự định tương lai</a></li>
    </ul>
</li>
<li class=<?php add_color_menu(4); ?>><a href="#"><i class="fa fa-bar-chart"></i>Biểu đồ</a></li>
<li>
    <a><i class="fa fa-download"></i>Nhật ký tải xuống</a>
    <ul style="<?php add_color_menu(5); ?>" class="sub_menu">
        <li class=<?php add_color_menu(5.1); ?>><a href="admin_cp.php?action=download_file&query=show"><i class="fa fa-arrow-circle-right"></i>Xem nhật ký tải xuống</a></li>
    </ul>
</li>
<li>
    <a><i class="fa fa-history"></i>Lịch sử future life</a>
    <ul style="<?php add_color_menu(6); ?>" class="sub_menu">
        <li class=<?php add_color_menu(6.1); ?>><a href="admin_cp.php?action=history_future_life&query=show"><i class="fa fa-arrow-circle-right"></i>Xem lịch sử</a></li>
    </ul>
</li>
