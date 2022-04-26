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
                if(isset($_SESSION['Activate']))
                {
                    $loginmessage  = $_SESSION['Activate'];
                }
                else
                {
                    $loginmessage = "Check your email if the code was sent";
                }
                if(isset($_SESSION['ActivateCode']))
                {
                    $loginmessageTitle  = $_SESSION['ActivateCode'];
                }
                else
                {
                    $loginmessageTitle = "Enter Code";
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
    <title>Enter Code</title>
</head>
<body>
<div class="hero is-fullheight is-link">
<div class="hero-body">
    <div class="container is-max-desktop has-text-centered">
      <div class="column is-5 is-offset-3">
      <h1 class="title has-text-white is-4"><?=$loginmessageTitle?></h1>
        <hr class="login-hr">
        <p class="subtitle is-6 has-text-white"><?=$loginmessage?></p>
        <div class="box">
            <center>
            <div class="box image is-128x128">
                    <img src="https://miro.medium.com/proxy/0*4fHRBbNhF_1jpdCM.jpeg">
             </div>
             </center>
        <div class="title has-text-grey is-6">Please enter your Verification that is sent to your email.</div>
        <?=form_open('DatabaseController/verification')?>
            <div class="field">
                <div class="control">
                <input class="input is-link" type="number" placeholder="Enter code" name="verification" autofocus="">
                </div>
            </div>
            <button class="button is-block is-danger is-fullwidth">Enter Code</button>
            </form>
            
        </div>
        <p class="has-text-white">
        <a href="">Sign Up</a> &nbsp;·&nbsp;
        <a href="">Forgot Password</a> &nbsp;
        </p>
      </div>
      
    </div>
    
  </div>
  
</div>
</body>
</html>