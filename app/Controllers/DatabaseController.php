<?php
    namespace App\Controllers;

    class DatabaseController extends BaseController
    {
        public function login()
        {
            $Username = $_POST['Username'];
            $Password = $_POST['Password'];
            $sql_login = $this->db->query("SELECT * FROM USERS WHERE username = '{$Username}' and password = '{$Password}'");
            if($sql_login-> getNumRows() > 0)
            {
                foreach ($sql_login->getResult() as $loginrow)
                {
                    $userdata = array('user_id' => $loginrow->user_id, 'fname' => $loginrow->fname, 'mname' => $loginrow->mname, 'lname' => $loginrow->lname, 'user_type' => $loginrow->user_type, 'is_active' => $loginrow->is_active ,'logged_in' => TRUE);
                    $this->session->set($userdata);

                    if(($loginrow->is_active) == 1)
                    {
                        if(($loginrow->user_type) == "ADMIN")
                        {
                            return redirect()->to('/views/view_admin');
                        }
                        else if(($loginrow->user_type) == "TEACHER")
                        {
                            return redirect()->to('/views/view_teacher');
                        }
                        else if(($loginrow->user_type) == "STUDENT")
                        {
                            //echo view('student/student_home',$userdata);
                            return redirect()->to('/views/view_student');
                        }
                    }

                    else
                    {
                        $_SESSION['notActive'] = "User not Active yet";
                        return redirect()->to('/views/index');
                    } 
                    
                }
            }
            else
            {   $_SESSION['wrongLogInTitle'] = "Please Log-In Again";
                $_SESSION['wrongLogIn'] = "Invalid Username Or Password!!";
                return redirect()->to('/views/login_page');

            }
        }
        public function logout()
        {
            $this->session->destroy();
            return redirect()->to(site_url());
            
        }

        public function sign_up()
        {   
            $Username = $_POST['username'];
            $sql_sign_up_verification = $this->db->query("SELECT * FROM USERS WHERE username = '{$Username}'");
            if($sql_sign_up_verification->getNumRows() > 0)
            {
                $_SESSION['MayUserNaIto'] = "Username Available. Please Choose another Username";
                $_SESSION['MayUserNaItoTitle'] = "Username Taken";
                return redirect()->to('/views/signup_page');
            }
            else
            {
                $sign_up_query_builder=$this->db->table('users');
                $sign_up_query_builder->insert($_POST);
                return redirect()->to('/views/index');
            }
            
        }
    }



?>