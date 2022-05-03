<?php
    helper(['array','date','form','html','security','url']);
    $session = session();
    $loginverification = $session->get('logged_in');
    $usertype = $session->get('user_type');
    if($loginverification) 
    {
        if($usertype == 'ADMIN')
        {
            header('Location:'.site_url('views/view_admin'));
            exit();
        }
        else if ($usertype == 'TEACHER')
        {
            header('Location:'.site_url('views/view_teacher'));
            exit();
        }
        else if ($usertype == 'STUDENT')
        {
            header('Location:'.site_url('views/view_student'));
            exit();
        }

    }
                if(isset($_SESSION['MayUserNaIto']))
                {
                    $loginmessage  = $_SESSION['MayUserNaIto'];
                }
                else
                {
                    $loginmessage  = "";
                }

                if(isset($_SESSION['MayUserNaItoTitle']))
                {
                    $loginmessagetitle  = $_SESSION['MayUserNaItoTitle'];
                }
                else
                {
                    $loginmessage  = "";
                }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=base_url('/design/css/all.css')?>" type="text/css">
    <link rel="stylesheet" href="<?=base_url('/design/css/bulma.css')?>" type="text/css">
    <link rel="stylesheet" href="<?=base_url('/design/css/animate.min.css')?>" type="text/css">
    <link rel="stylesheet" href="<?=base_url('/design/css/modal-fx.css')?>" type="text/css">
    <script src="<?=base_url('/design/js/mine.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/all.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/jquery-3.6.0.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/popper.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/modal-fx.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/sweetalert2.all.min.js')?>" type="text/javascript"></script>
    <title>Error Credentials</title>
</head>
<body>
<div class="hero is-fullheight is-link">
<div class="hero-body">
    <div class="container is-max-desktop has-text-centered">
      <div class="column is-5 is-offset-3">
      <h1 class="title has-text-white is-4"><?=$loginmessagetitle?></h1>
        <hr class="login-hr">
        <p class="subtitle is-6 has-text-white"><?=$loginmessage?>!</p>
        <div class="box">
            <center>
            <div class="box image is-128x128">
                    <img src="<?=base_url('/design/images/PITA.png')?>">
             </div>
             </center>
        <div class="title has-text-grey is-6">.</div>
        <?=form_open('DatabaseController/sign_up')?>
            <input type="hidden" name="date_created" value="<?=date("y_m_d H:i:s")?>">
            <input type="hidden" name="date_modified" value="<?=date("y_m_d H:i:s")?>">
            <input type="hidden" name="is_active" value="DISABLED">
            <input type="hidden" name="verification" value="<?=rand(10000,99999)?>">
            <input type="hidden" name="user_type" value="STUDENT">
            <input type="hidden" name="grade" value="0">
            <input type="hidden" name="section" value="TBA">
            <div class="field">
                <label for="" class="label">Email</label>
            </div>
            <div class="control">
                <input type="email" name="email" placeholder="Ente email" class="input is-link">
            </div>
            <div class="field">
                <label for="" class="label">Username</label>
            </div>
            <div class="control">
                <input type="text" name="username" placeholder="Enter Username" class="input is-link" required>
            </div>
            <div class="field">
                <label for="" class="label">Password</label>
            </div>
            <div class="control">
                <input type="password" id="password" name="password" placeholder="Enter Password" class="input is-link" onkeyup="check();" required>
            </div>
            <div class="field">
                <label for="" class="label">Confirm Password</label>
            </div>
            <div class="control">
                <input type="password" id="confirm" placeholder="Confirm Password" class="input is-link" onkeyup="check();" required>
            </div>
            <div class="field mt-2">
                <label for="" class="label" id="message"></label>
            </div>
            <script>
                var check = function() {
                    if (document.getElementById('password').value == document.getElementById('confirm').value) 
                    {
                        if(document.getElementById('password').value === ""  || document.getElementById('confirm').value === "")
                        {
                            document.getElementById('message').innerHTML = '';
                            document.getElementById('submit').disabled = true;
                        }
                
                        else
                        {
                            document.getElementById('message').style.color = 'green';
                            document.getElementById('message').innerHTML = 'Passwords Matched';
                            document.getElementById('submit').disabled = false;
                        }
                       
                    } 
                    else {
                        document.getElementById('message').style.color = 'red';
                        document.getElementById('message').innerHTML = 'Passwords do not Matched';
                        document.getElementById('submit').disabled = true;
                    }
                }
            </script>
            <div class="field">
                <label for="" class="label">First name</label>
            </div>
            <div class="control">
                <input type="text" name="fname" placeholder="Enter First Name" class="input is-link" required>
            </div>
            <div class="field">
                <label for="" class="label">Middle name</label>
            </div>
            <div class="control">
                <input type="text" name="mname" placeholder="Enter Middle name" class="input is-link" required>
            </div>
            <div class="field">
                <label for="" class="label">Last name</label>
            </div>
            <div class="control">
                <input type="text" name="lname" placeholder="Enter Last name" class="input is-link" required>
            </div>
            <div class="control mt-5">
                <button class="button is-block is-success is-fullwidth">Sign-up</button>
            </div>    
            </form>
            
        </div>
        <p class="has-text-white">
        <a href="<?=site_url('/views/login_page')?>">Have an Account?</a> &nbsp;
        </p>
      </div>
      
    </div>
    
  </div>
  
</div>
</body>
</html>