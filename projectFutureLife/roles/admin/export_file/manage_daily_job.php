<?php 
    require 'lib/vendor/autoload.php';
    include_once 'config/connect_db/database.php';
    require 'roles/admin/module/download_file/download_file.php';
    require_once 'roles/admin/const/delete.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Style\Font;
    use PhpOffice\PhpSpreadsheet\Style\Border;
?>
<?php 
ob_start();

class export_file_daily_job {    
    private $database;
    // database
    public function __construct() {
        $this->database = new Database();
    }
    // export file cost
    public function export_file($id, $daily_job_name, $time_start) {
        $download_file = new download_file();
        // Get data
        $query = "SELECT * FROM daily_job WHERE search_flg = " . FLG_OFF . " ";
        if (!Empty($id)) {
            $query .= "AND id LIKE '%$id%' ";
        }
        if (!Empty($daily_job_name)) {
            $query .= "AND daily_job_name LIKE '%$daily_job_name%' ";
        } 
        if (!Empty($time_start)) {
            $formatted_date = date('Y-m-d H:i:s', strtotime($time_start));
            $query .= "AND time_start = '$formatted_date' ";
        }
        $query .= " ORDER BY id DESC";
        $result = $this->database->select($query);

        // spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // set Title
        $sheet = $spreadsheet->getActiveSheet()->setTitle('daily_job_list');

        // rown count
        $row_count = 1;
        $number_count = 1;

        // Font weight bold
        $style = $sheet->getStyle('A'.$row_count);
        $style->getFont()->setBold(true);
        $style = $sheet->getStyle('B'.$row_count);
        $style->getFont()->setBold(true);
        $style = $sheet->getStyle('C'.$row_count);
        $style->getFont()->setBold(true);
        $style = $sheet->getStyle('D'.$row_count);
        $style->getFont()->setBold(true);

        // Border
        $style = $sheet->getStyle('A'.$row_count);
        $style->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $style = $sheet->getStyle('B'.$row_count);
        $style->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $style = $sheet->getStyle('C'.$row_count);
        $style->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $style = $sheet->getStyle('D'.$row_count);
        $style->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        //Column
        $sheet->setCellValue('A'.$row_count, 'STT');
        $sheet->setCellValue('B'.$row_count, 'Id công việc');
        $sheet->setCellValue('C'.$row_count, 'Tên công việc hàng ngày');
        $sheet->setCellValue('D'.$row_count, 'Ngày bắt đầu');
        $sheet->getColumnDimension("C")->setAutoSize(true);
        $sheet->getColumnDimension("D")->setAutoSize(true);

        while($row = $result->fetch_assoc()) {
            $row_count++;
            // set row
            $sheet->setCellValue('A'.$row_count, $number_count);
            $sheet->setCellValue('B'.$row_count, $row['id']);
            $sheet->setCellValue('C'.$row_count, $row['daily_job_name']);
            $sheet->setCellValue('D'.$row_count, $row['time_start']);
            // boder
            $style = $sheet->getStyle('A'.$row_count);
            $style->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $style = $sheet->getStyle('B'.$row_count);
            $style->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $style = $sheet->getStyle('C'.$row_count);
            $style->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $style = $sheet->getStyle('D'.$row_count);
            $style->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $number_count++;
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
		$writer->setOffice2003Compatibility(true);
		$file_name = "tmp/download/excel/daily_job/"."daily_job_file".time().".xlsx";
		$writer->save($file_name);
        $download_file->insert_file('Danh sách những công việc hàng ngày', 1, $file_name);
    }
}
?>