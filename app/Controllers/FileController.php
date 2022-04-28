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
          /**Data for activities chart */
            $activity_count = db_connect();
            $count_activity_query= $activity_count->query("SELECT COUNT(activity_id) as activitycount FROM actvities");
            $activitytrow = $count_activity_query->getRow();
            if(isset($activitytrow))
            {
                $count_activity = $activitytrow->activitycount;
            }
            $score_count = db_connect();
            $count_score_query= $activity_count->query("SELECT COUNT(score_id) as scorecount FROM scores");
            $scoretrow = $count_score_query->getRow();
            if(isset($scoretrow))
            {
                $count_score = $scoretrow->scorecount;
            }
        /**Data for activities chart */
            

            $file_name = 'report.xlsx';
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            //user chart data
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
            //user chart data

            //activity chart data
                $sheet->mergeCells('A7:D7');
                $sheet->setCellValue('A7','# of Users');
                $sheet->setCellValue('A9', 'Total Actv.');
                $sheet->setCellValue('B9', 'No. of Scores');
                $sheet->setCellValue('C9', 'Teachers');
                $sheet->setCellValue('D9', 'Students');
                $sheet->setCellValue('A10', $count_activity);
                $sheet->setCellValue('B10', $count_score);
                $sheet->setCellValue('C10', $count_teacher);
                $sheet->setCellValue('D10', $count_student);
            //activity chart data

            //Total Statistics Chart
                $sheet->mergeCells('A13:F13');
                $sheet->setCellValue('A15','Total Statistics');
                $sheet->setCellValue('A17', 'Total Actv.');
                $sheet->setCellValue('B17', 'No. of Scores');
                $sheet->setCellValue('C17', 'Total Users');
                $sheet->setCellValue('D17', 'Administrators');
                $sheet->setCellValue('E17', 'Teachers');
                $sheet->setCellValue('F17', 'Students');
                $sheet->setCellValue('A18', $count_activity);
                $sheet->setCellValue('B18', $count_score);
                $sheet->setCellValue('C18', $all_users);
                $sheet->setCellValue('D18',$count_admin);
                $sheet->setCellValue('E18', $count_teacher);
                $sheet->setCellValue('F18', $count_student);
            //Total Statistics Chart

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