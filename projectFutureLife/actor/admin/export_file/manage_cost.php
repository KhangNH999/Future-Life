<?php 
    require 'lib/vendor/autoload.php';
    include_once 'config/connect_db/database.php';
    require 'actor/admin/module/download_file/download_file.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Style\Font;
    use PhpOffice\PhpSpreadsheet\Style\Border;
?>
<?php 
ob_start();
class export_file_cost {
    private $database;
    // database
    public function __construct() {
        $this->database = new Database();
    }
    // export file cost
    public function export_file($id, $cost_name, $cost, $date_used) {
        $download_file = new download_file();
        // Get data
        $query = "SELECT * FROM cost_life WHERE search_flg = 0 ";
        if (!Empty($id)) {
            $query .= "AND id LIKE '%$id%' ";
        }
        if (!Empty($cost_name)) {
            $query .= "AND cost_name LIKE '%$cost_name%' ";
        } 
        if (!Empty($cost)) {
            $query .= "AND cost LIKE '%$cost%' ";
        }
        if (!Empty($date_used)) {
            $formatted_date = date('Y-m-d H:i:s', strtotime($date_used));
            $query .= "AND date_used = '$formatted_date' ";
        }
        $query .= " ORDER BY id DESC";
        $result = $this->database->select($query);

        // spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // set Title
        $sheet = $spreadsheet->getActiveSheet()->setTitle('Cost_list');

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
        $style = $sheet->getStyle('E'.$row_count);
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
        $style = $sheet->getStyle('E'.$row_count);
        $style->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        //Column
        $sheet->setCellValue('A'.$row_count, 'STT');
        $sheet->setCellValue('B'.$row_count, 'Id chi phí');
        $sheet->setCellValue('C'.$row_count, 'Tên chi phí');
        $sheet->setCellValue('D'.$row_count, 'Số tiền bỏ ra');
        $sheet->setCellValue('E'.$row_count, 'Ngày sử dụng'); 
        $sheet->getColumnDimension("C")->setAutoSize(true);
        $sheet->getColumnDimension("D")->setAutoSize(true);
        $sheet->getColumnDimension("E")->setAutoSize(true);
        
        while($row = $result->fetch_assoc()) {
            $row_count++;
            // set row
            $sheet->setCellValue('A'.$row_count, $number_count);
            $sheet->setCellValue('B'.$row_count, $row['id']);
            $sheet->setCellValue('C'.$row_count, $row['cost_name']);
            $sheet->setCellValue('D'.$row_count, number_format($row['cost'], 0, '.', ',') . ' ₫');
            $sheet->setCellValue('E'.$row_count, $row['date_used']);
            // boder
            $style = $sheet->getStyle('A'.$row_count);
            $style->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $style = $sheet->getStyle('B'.$row_count);
            $style->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $style = $sheet->getStyle('C'.$row_count);
            $style->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $style = $sheet->getStyle('D'.$row_count);
            $style->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $style = $sheet->getStyle('E'.$row_count);
            $style->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $number_count++;
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
		$writer->setOffice2003Compatibility(true);
		$file_name = "tmp/download/excel/cost/"."cost_file".time().".xlsx";
		$writer->save($file_name);
		$download_file->insert_file('Danh sách chi tiêu', 2, $file_name);
    }
}
?>