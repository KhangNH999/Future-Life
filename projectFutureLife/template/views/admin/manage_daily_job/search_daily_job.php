<?php include 'actor/admin/module/manage_daily_job/manage_daily_job.php' ?>
<form action="admin_cp.php?action=manage_daily_job&query=show" method="post">
    <table class="form-search">
        <tr>
            <td>Id <input type="text" name="id" value=""></td>
            <td>Tên công việc hàng ngày  <input type="text" name="daily_job_name" value=""></td>
        </tr>
        <tr>
            <td>Ngày bắt đầu <input type="text" name="time_start" value=""></td>
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
</form>