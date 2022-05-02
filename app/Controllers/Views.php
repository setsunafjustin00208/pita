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
    public function admin_about_view()
    {
        echo view('admin/admin_about');
    }
    public function admin_profile_view()
    {
        echo view('admin/admin_profile');
    }
 /**End for admins */

 /** For Teachers */
    public function teacher_about()
    {
        echo view('teacher/teacher_about');
    }
    public function teacher_profile()
    {
        echo view('teacher/teacher_profile');
    }
    public function teacher_ide()
    {
        echo view('teacher/teacher_ide');
    }
    public function teacher_actvities()
    {
        echo view('teacher/teacher_activities');
    }
    public function teacher_view_students()
    {
        echo view('teacher/teacher_view_students');
    }
    public function teacher_manage_students()
    {
        echo view('teacher/teacher_manage_students');
    }
    public function teacher_activity_results()
    {
        $_SESSION['activity_id'] = $this->request->uri->getSegment(3);
        echo view('teacher/teacher_activity_results');
    }
/** For Teachers */
/** For Students */

    public function student_activity()
    {
        echo view('student/student_activity');
    }
    public function student_do_activity()
    {
        $_SESSION['act_id'] = $this->request->uri->getSegment(3);
        echo view('student/student_do_activity');
    }
    public function student_about()
    {
        echo view('student/student_about');
    }
    public function student_profile()
    {
        echo view('student/student_profile');
    }
    public function student_ide()
    {
        echo view('student/student_ide');
    }
    
/** For Students */

    public function search_user()
    {
        echo view('search_user');
    }

}


?>