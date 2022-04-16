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
                    $userdata = array('user_id' => $loginrow->user_id, 'fname' => $loginrow->fname, 'mname' => $loginrow->mname, 'lname' => $loginrow->lname, 'user_type' => $loginrow->user_type, 'logged_in' => TRUE);
                    $session = session();
                    $this->session->set($userdata);

                    if(($loginrow->user_type) == "ADMIN")
                    {
                        return redirect()->to('/views/view_admin');
                    }
                    if(($loginrow->user_type) == "TEACHER")
                    {
                        return redirect()->to('/views/view_teacher');
                    }
                    if(($loginrow->user_type) == "STUDENT")
                    {
                        return redirect()->to('/views/view_student');
                    }
                   
                    
                }
            }
            else
            {
                $_SESSION['wrongLogIn'] = "Invalid Username Or Password!!";
                return redirect()->to('/views/index');

            }
        }
    }



?>