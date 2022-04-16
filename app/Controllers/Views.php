<?php

namespace App\Controllers;
use CodeIgniter\Config\View;

class Views extends BaseController
{
    public function index()
    {
        echo view('index');
    }

/** 
    Landing page eacher user type

**/

    public function view_admin()
    {
        echo view('admin/admin_home');
    }

    public function view_student($page = 'student')
    {
        echo view('student/student_home');
    }
    
    public function view_teacher($page = 'teacher')
    {
        echo view('teacher/teacher_home');
    }
}


?>