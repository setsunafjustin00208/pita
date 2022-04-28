<?php

    namespace App\Controllers;

    use PhpOffice\PhpSpreadsheet\Spreadsheet;

    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    class FileController extends BaseController
    {
        public function export_report()
        {
            /**Data for the user chart */
            $allusers_count=db_connect()->table('users');
            $all_users = $allusers_count->countAll();
           

            $admin_count = db_connect();
            $count_admin_query= $admin_count->query("SELECT COUNT(user_id) as admincount FROM users WHERE user_type = 'ADMIN' ");
            $countrow = $count_admin_query->getRow();
            if(isset($countrow))
            {
              $count_admin = $countrow->admincount;
            }

            $teacher_count = db_connect();
            $count_teacher_query= $teacher_count->query("SELECT COUNT(user_id) as teachercount FROM users WHERE user_type = 'TEACHER' ");
            $teacherrow = $count_teacher_query->getRow();
            if(isset($teacherrow))
            {
                $count_teacher = $teacherrow->teachercount;
            }

            $student_count = db_connect();
            $count_student_query= $student_count->query("SELECT COUNT(user_id) as studentcount FROM users WHERE user_type = 'STUDENT' ");
            $studentrow = $count_student_query->getRow();
            if(isset($studentrow))
            {
                $count_student = $studentrow->studentcount;
            }
          /**Data for the user chart */
            

            $file_name = 'report.xlsx';
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->mergeCells('A1:D1');
            $sheet->setCellValue('A1','# of Users');
            $sheet->setCellValue('A3', 'Total Users');
		    $sheet->setCellValue('B3', 'Administrators');
		    $sheet->setCellValue('C3', 'Teachers');
		    $sheet->setCellValue('D3', 'Students');
            $sheet->setCellValue('A4', $all_users);
		    $sheet->setCellValue('B4',$count_admin);
		    $sheet->setCellValue('C4',$count_teacher);
		    $sheet->setCellValue('D4',$count_student);
            $writer = new Xlsx($spreadsheet);
		    $writer->save($file_name);
		    header("Content-Type: application/vnd.ms-excel");
		    header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length:' . filesize($file_name));
		    flush();
		    readfile($file_name);
            return redirect()->to('/views/view_admin');
        }
    }

?>