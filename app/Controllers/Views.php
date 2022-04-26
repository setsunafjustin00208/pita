<?php

namespace App\Controllers;
use CodeIgniter\Config\View;

class Views extends BaseController
{
    public function index()
    {
        echo view('index');
    }

    public function login_page()
    {
        echo view('login');
    }
    public function signup_page()
    {
        echo view('sign_up');
    }
    public function verification_page()
    {
        echo view('verification');
    }

/** 
    Landing page eacher user type

**/

    public function view_admin()
    {
        echo view('admin/admin_home');
    }


    public function view_student()
    {
        echo view('student/student_home');
    }
    
    public function view_teacher()
    {
        echo view('teacher/teacher_home');
    }

    /**for admins */
    public function view_admin_users()
    {
        echo view('admin/admin_users');
    }
    public function admin_teacher_view()
    {
        echo view('admin/admin_teachers');
    }
    public function admin_student_view()
    {
        echo view('admin/admin_students');
    }
    public function admin_administrator_view()
    {
        echo view('admin/admin_administrators');
    }
    public function admin_overall_statistics()
    {
        echo view('admin/admin_statistics');
    }
    public function admin_users_statistics()
    {
        echo view('admin/admin_user_statistics');
    }
    public function admin_about_view()
    {
        echo view('admin/admin_about');
    }
    public function admin_profile_view()
    {
        echo view('admin/admin_profile');
    }


}


?>