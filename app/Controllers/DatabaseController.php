<?php
    namespace App\Controllers;
    use CodeIgniter\Files\File;

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

                if(($loginrow->is_active) ==  "DISABLED")
                {
                    $_SESSION['Activate'] = "Account Inactive";
                    $_SESSION['ActivateCode'] = "Enter Code first";
                    return redirect()->to('/views/verification_page');
                }

                else if(($loginrow->is_active) ==  "ACTIVE")
                {
                    $userdata = array('user_id' => $loginrow->user_id, 'email' => $loginrow->email, 'username' => $loginrow->username ,'password' => $loginrow->password,'fname' => $loginrow->fname, 'mname' => $loginrow->mname, 'lname' => $loginrow->lname,'grade' => $loginrow->grade, 'section' => $loginrow->section ,'user_type' => $loginrow->user_type, 'is_active' => $loginrow->is_active ,'img_pic' => $loginrow->img_pic, 'about' => $loginrow->about,'logged_in' => TRUE);
                    $this->session->set($userdata);
                    
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
               
                $this->email->setFrom('akantor_verification@outlook.com', 'Akantor Programmer');
                $this->email->setTo($email_string);
                $this->email->setSubject('Verification Code');
                $this->email->setMessage('Welcome user! <br><br>Here is Your Verification Code:'.$_POST['verification']. '<br><br>Ignore this email if anyone use your email without permission');
                $this->email->send();
                $sign_up_query_builder=$this->db->table('users');
                $sign_up_query_builder->insert($_POST);
                return redirect()->to('/views/verification_page');
                
            }
            
        }
        public function email_test()
        {   
            $this->email->setFrom('akantor_verification@outlook.com', 'Akantor Programmer');
            $this->email->setTo('setsunafjustin002@gmail.com');
            $this->email->setSubject('Email Test');
            $this->email->setMessage('Testing the email class.');
            $this->email->send();

            

        }
        public function verification()
        {
            $verification_code = $_POST['verification'];
            $verification_builder=$this->db->table('users');
            $verification_data=$verification_builder->getWhere(['verification'=>$verification_code]);
            if($verification_data)
            {
                $vdata = 
                [
                    'is_active' => 'ACTIVE',
                    'verification' => 0
                ];
                $verification_builder->set($vdata);
                $verification_builder->where('verification',$verification_code);
                $verification_builder->update();
                return redirect()->to('/views/login_page');
            }
            else
            {
                $_SESSION['Activate'] = "Account Inactive";
                $_SESSION['ActivateCode'] = "Enter Code first";
                header('Location:'.site_url('views/verification_page'));
                exit();
            }

        }

        public function add_users()
        {
            $email_string = $_POST['email'];
            $email_builder=$this->db->table('users');
            $email_data = $email_builder->getWhere(['email'=>$email_string]);

            if($email_data->getNumRows() != 1)
            {
                $add_user=$this->db->table('users');
                $add_user->insert($_POST);

                $user_type = $_POST['user_type'];
                
                if($user_type == 'ADMIN')
                {
                    return redirect()->to('/views/admin_administrator_view');
                }
                else if($user_type == 'TEACHER')
                {
                    return redirect()->to('/views/admin_teacher_view');
                }
                else if($user_type == 'STUDENT')
                {
                    return redirect()->to('/views/admin_teacher_view');
                }
            }

            else
            {
                $user_type = $_POST['user_type'];
                
                if($user_type == 'ADMIN')
                {
                    return redirect()->to('/views/admin_administrator_view');
                }
                else if($user_type == 'TEACHER')
                {
                    return redirect()->to('/views/admin_teacher_view');
                }
                else if($user_type == 'STUDENT')
                {
                    return redirect()->to('/views/admin_student_view');
                }
            }


        }
        public function update_users()
        {
           $user_id = $_POST['user_id'];
           $user_type = $_POST['user_type'];

           $update_function = $this->db->table('users');
           $update_function->where('user_id',$user_id);
           $update_function->update($_POST);

           if($user_type == 'ADMIN')
           {
               return redirect()->to('/views/admin_administrator_view');
           }
           else if($user_type == 'TEACHER')
           {
               return redirect()->to('/views/admin_teacher_view');
           }
           else if($user_type == 'STUDENT')
           {
                return redirect()->to('/views/admin_student_view');
           }

        }
        public function delete_users()
        {
           $delete_user_id = $_POST['user_id'];
           $delete_user_type = $_POST['user_type'];

           $delete_function = $this->db->table('users');
           $delete_function->where('user_id',$delete_user_id);
           $delete_function->delete();

           if($delete_user_type == 'ADMIN')
                {
                    return redirect()->to('/views/admin_administrator_view');
                }
                else if($delete_user_type == 'TEACHER')
                {
                    return redirect()->to('/views/admin_teacher_view');
                }
                else if($delete_user_type == 'STUDENT')
                {
                    return redirect()->to('/views/admin_student_view');
                }


        }
        public function update_status()
        {
            $status_user_id = $_POST['user_id'];
            $user_status_update = $_POST['is_active'];

            if($user_status_update == "DISABLED")
            {
                $vercode = rand(00000,99999);
                $email_string2 = $_POST['email'];
                
                $this->email->setFrom('akantor_verification@outlook.com', 'Akantor Programmer');
                $this->email->setTo($email_string2);
                $this->email->setSubject('Verification Code');
                $this->email->setMessage('Seems your account got disabled due to reasons! <br><br>Here is Your Verification Code:'.$vercode. '<br><br>Ignore this email if anyone use your email without permission');
                $this->email->send();
                $status_update = $this->db->table('users');
                $status_update_data = [
                    'is_active' => $user_status_update,
                    'verification' => $vercode
                ];
                $status_update->set($status_update_data);
                $status_update->where('user_id',$status_user_id);
                $status_update->update();
                return redirect()->to('/views/view_admin_users');
            }
            else
            {
                $status_update = $this->db->table('users');
                $status_update->set('is_active',$user_status_update);
                $status_update->where('user_id',$status_user_id);
                $status_update->update();
                return redirect()->to('/views/view_admin_users');
            }
           
            
        }

        public function create_announcements()
        {   
            $title_announcement = $_POST['announcement_title'];
            $title_announcement_query = $this->db->query("SELECT * FROM announcements WHERE announcement_title ='{$title_announcement}'");
            
            if($title_announcement_query->getNumRows() > 0)
            {
                $_SESSION['announcment_available'] = "There is an available announcment";
                return redirect()->to('/views/view_admin');
            }
            else
            {
                $announcement_builder = $this->db->table('announcements');
                $announcement_builder->insert($_POST);
                return redirect()->to('/views/view_admin');
            }
           
        }

        public function update_announcements()
        {
            $ua_id = $_POST['a_id'];
            $update_announcement_function = $this->db->table('announcements');
            $update_announcement_function->where('a_id',$ua_id);
            $update_announcement_function->update($_POST);
            return redirect()->to('/views/view_admin');
        }
        public function delete_announcements()
        {
            $a_id = $_POST['a_id'];
            $delete_announcement_function = $this->db->table('announcements');
            $delete_announcement_function->where('a_id',$a_id);
            $delete_announcement_function->delete($_POST);
            return redirect()->to('/views/view_admin');
        }

        public function create_teacher_announcements()
        {   
            $title_announcement = $_POST['announcement_title'];
            $title_announcement_query = $this->db->query("SELECT * FROM teacher_announcements WHERE announcement_title ='{$title_announcement}'");
            
            if($title_announcement_query->getNumRows() > 0)
            {
                $_SESSION['announcment_available'] = "There is an available announcment";
                return redirect()->to('/views/view_teacher');
            }
            else
            {
                $announcement_builder = $this->db->table('teacher_announcements');
                $announcement_builder->insert($_POST);
                return redirect()->to('/views/view_teacher');
            }
           
        }

        public function update_teacher_announcements()
        {
            $ua_id = $_POST['ta_id'];
            $update_announcement_function = $this->db->table('teacher_announcements');
            $update_announcement_function->where('ta_id',$ua_id);
            $update_announcement_function->update($_POST);
            return redirect()->to('/views/view_teacher');
        }
        public function delete_teacher_announcements()
        {
            $a_id = $_POST['ta_id'];
            $delete_announcement_function = $this->db->table('teacher_announcements');
            $delete_announcement_function->where('ta_id',$a_id);
            $delete_announcement_function->delete($_POST);
            return redirect()->to('/views/view_teacher');
        }

        public function add_student()
        {
            $user_id = $_POST['user_id'];
            $add_student_builder = $this->db->table('users');
            $add_student_builder->where('user_id',$user_id);
            $add_student_builder->update($_POST);
            return redirect()->to('/views/teacher_manage_students');
        }
        public function remove_student()
        {
            $user_id = $_POST['user_id'];
            $remove_student_builder = $this->db->table('users');
            $remove_student_builder->where('user_id',$user_id);
            $remove_student_builder->update($_POST);
            return redirect()->to('/views/teacher_manage_students');

        }
        public function create_activity()
        {   
            $title_activity = $_POST['activity_title'];
            $title_activity_query = $this->db->query("SELECT * FROM actvities WHERE activity_title ='{$title_activity}'");
            
            if($title_activity_query->getNumRows() > 0)
            {
                $_SESSION['activity_available'] = "Activity Available";
                return redirect()->to('/views/teacher_actvities');
            }
            else
            {
                $activty_builder = $this->db->table('actvities');
                $activty_builder->insert($_POST);
                return redirect()->to('/views/teacher_actvities');
            }
           
        }

        public function update_activity()
        {
            $act_id = $_POST['activity_id'];
            $update_announcement_function = $this->db->table('actvities');
            $update_announcement_function->where('activity_id',$act_id);
            $update_announcement_function->update($_POST);
            return redirect()->to('/views/teacher_actvities');
        }
        public function delete_activity()
        {
            $act_id = $_POST['activity_id'];
            $delete_announcement_function = $this->db->table('actvities');
            $delete_announcement_function->where('activity_id',$act_id);
            $delete_announcement_function->delete($_POST);
            $delete_announcement_function = $this->db->table('scores');
            $delete_announcement_function->where('activity_id',$act_id);
            $delete_announcement_function->delete($_POST);
            return redirect()->to('/views/teacher_actvities');
        }
         
    }



?>