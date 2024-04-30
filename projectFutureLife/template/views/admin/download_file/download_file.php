<?php 
    $path="tmp/download/excel/daily_job_file1710257391.xlsx";
    include 'roles/admin/module/download_file/download_file.php';
    $download_file = new download_file();
    // show data download
    $show_download_file = $download_file->show_download_file();

    // Delete file
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $link = $_GET['link'];
        $delete_file = $download_file->delete_file($id, $link);
    }
?>

<div class="title">Những file đã được xuất dữ liệu ra thành công, có thể tải file tại đây...</div>
<?php
if ($show_download_file) {
        while($result = $show_download_file->fetch_assoc()){
?>
<div class="download_file">
    <div class="sub_download">
        <div class="image_file">
            <img src="tmp/img/microsoft-excel-10.png" alt="" src="">
        </div>
        <div class="download_info">
            <div class="file_name"><?php echo $result['file_name'] ?></div>
            <div class="time_download">Ngày xuất file: <?php echo $result['time_download'] ?></div>
            <div class="format_file">Định dạng file: Excel</div>
        </div>
        <div class="download"><p>Tải xuống</p><a href="<?php echo $result['link'] ?>"><i class="fa fa-download"></i></a></div>
        <div class="delete_download"><a href="admin_cp.php?action=download_file&query=show&id=<?php echo $result['id'] ?>&link=<?php echo $result['link'] ?>" onclick="return confirm_delete(event);"><i class="fa fa-remove"></i></a></div>
    </div>
</div>
<?php
    }
}
?>
