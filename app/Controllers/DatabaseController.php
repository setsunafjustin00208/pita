<?php
    namespace App\Controllers;

    class DatabaseController extends BaseController
    {
        public function login()
        {
            $email_string = $_POST['email'];
            $Password = $_POST['Password'];
            $sql_login = $this->db->query("SELECT * FROM USERS WHERE email = '{$email_string}' and password = '{$Password}'");
            if($sql_login-> getNumRows() > 0)
            {
                $loginrow = $sql_login->getRow();
                $userdata = array('user_id' => $loginrow->user_id, 'fname' => $loginrow->fname, 'mname' => $loginrow->mname, 'lname' => $loginrow->lname, 'user_type' => $loginrow->user_type, 'is_active' => $loginrow->is_active ,'logged_in' => TRUE);
                $this->session->set($userdata);

                if(($loginrow->is_active) ==  "DISABLED")
                {
                    $_SESSION['wrongLogInTitle'] = "Account Inactive";
                    $_SESSION['wrongLogIn'] = "Enter Code first";
                    header('Location:'.site_url('views/verification-page'));
                    exit();
                }

                else if(($loginrow->is_active) ==  "ACTIVE")
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
                        return redirect()->to('/views/view_student');
                    }

            }    
        
        }
        else
        {   
                $_SESSION['wrongLogInTitle'] = "Please Log-In Again";
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
            $email_string = $_POST['email'];
            $sql_sign_up_verification = $this->db->query("SELECT * FROM USERS WHERE email = '{$email_string}'");
            if($sql_sign_up_verification->getNumRows() > 0)
            {
                $_SESSION['MayUserNaIto'] = "Email Available. Please Choose another email";
                $_SESSION['MayUserNaItoTitle'] = "Email Taken";
                return redirect()->to('/views/signup_page');
            }
            else
            {
                $sign_up_query_builder=$this->db->table('users');
                $sign_up_query_builder->insert($_POST);
                $email = \Config\Services::email();
                $email->setFrom('akantor_verification@outlook.com', 'Akantor Programmer');
                $email->setTo($email_string);
                $email->setSubject('Verification Code');
                $email->setMessage('Welcome user! <br><br>Here is Your Verification Code:'.$_POST['verification']. '<br><br>Ignore this email if anyone use your email without permission');
                $email->send();
                return redirect()->to('/views/verification_page');
            }
            
        }
        public function verification()
        {
            $verification_code = $_POST['verification'];
            $verification_builder=$this->db->table('users');
            $verification_data=$verification_builder->getWhere(['verification'=>$verification_code]);
            if($verification_data)
            {
                $verification_builder->set('is_active','ACTIVE');
                $verification_builder->where('verification',$verification_code);
                $verification_builder->update();
                return redirect()->to('/views/login_page');
            }
            else
            {
                $_SESSION['wrongLogInTitle'] = "Account Inactive";
                $_SESSION['wrongLogIn'] = "Enter Code first";
                header('Location:'.site_url('views/verification-page'));
                exit();
            }

        }

        
    }



?>