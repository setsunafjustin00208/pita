<?php
    helper(['array','date','form','html','security','url']);
    $session = session();
    $loginverification = $session->get('logged_in');
    $usertype = $session->get('user_type');
    $status = session()->get('is_active');
    if(!$loginverification) 
    {
      header('Location:'.base_url());
      die();

    }
    else
    {
      if($status == 'ACTIVE')
      {
        if($usertype != 'STUDENT')
        {
          if($usertype == 'STUDENT')
          {
            header("Location:".site_url('/views/view_teacher'));
            exit();
          }
          else if ($usertype == 'ADMIN')
          {
            header("Location:".site_url('/views/view_admin'));
            exit();
          }
        }
      }
      else
      {
          $_SESSION['wrongLogInTitle'] = "Account Inactive";
          $_SESSION['wrongLogIn'] = "Enter Code first";
          header('Location:'.site_url('views/login_page'));
          exit();
      }

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
    <link rel="stylesheet" href="<?=base_url('/design/css/datatables.min.css')?>" type="text/css">
    <link rel="stylesheet" href="<?=base_url('/design/css/dataTables.bulma.css')?>" type="text/css">
    <link rel="stylesheet" href="<?=base_url('/design/css/jquery.dataTables.css')?>" type="text/css">
    <script src="<?=base_url('/design/js/mine.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/all.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/jquery-3.6.0.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/popper.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/modal-fx.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/sweetalert2.all.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/dataTables.bulma.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/datatables.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/jquery.dataTables.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/acorn_interpreter.js')?>"></script>
    <script src="<?=base_url('/design/js/blockly_compressed.js')?>"></script>
    <script src="<?=base_url('/design/js/blocks_compressed.js')?>"></script>
    <script src="<?=base_url('/design/js/javascript_compressed.js')?>"></script>
    <script src="<?=base_url('/design/js/msg/js/en.js')?>"></script>
    <script src="<?=base_url('/design/js/wait_block.js')?>"></script>
    <title>Hello&nbsp;<?=session()->get('fname')?></title>
</head>
<body>
<nav class="navbar is-link" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="<?=site_url('/views/view_teacher')?>">
      <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
    </a>

    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item">
        <?php

            echo "HELLO! ".session()->get('fname')."&nbsp".session()->get('mname')."&nbsp".session()->get('lname');

        ?>
      </a>
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
      <div class="navbar-item has-dropdown is-hoverable ">
        <a class="navbar-link">
          <i class="fa fa-cog"></i>
        </a>
        <div class="navbar-dropdown is-right">
          <a href="<?=site_url('/views/student_about')?>" class="navbar-item">
          <i class="fa fa-user"></i>&nbsp;
            About me
          </a>
          <a href="<?=site_url('/views/student_profile')?>" class="navbar-item">
           <i class="fa fa-user-edit"></i>&nbsp;
            Profile
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item" href="<?=site_url('databasecontroller/logout')?>">
          <i class="fa fa-sign-out"></i> &nbsp;
            Log-out
          </a>
        </div>
      </div>
      </div>
    </div>
  </div>
</nav>
<div class="columns">
<div class="column container is-2 box mt-3 ml-2">
        <aside class="menu">
        <figure class="image is-128x128 ml-4">
            <?php
                if(!$session->get('img_pic'))
                {
                  echo '<img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">';
                }
                else
                {
                  ?>
                  <img class="is-rounded" src="<?=$session->get('img_pic')?>">
             <?php     
                }

            ?>
          </figure>
            <p class="menu-label">
                General
            </p>
            <ul class="menu-list">
                <li><a class="is-active" href="<?=site_url('/views/view_student')?>">Dashboard</a></li>
                <li><a href="<?=site_url('/views/student_ide')?>">Intergrated Dev. Env</a></li>
                <li>
                  <?php
                     if($session->get('section') != 'TBA' && $session->get('grade') != 0)
                     {
                  ?>
                  <a href="<?=site_url('/views/student_activity')?>">Activities</a>
                  <?php
                     }
                  ?>
                </li>
            </ul>
        </aside>
    </div>
    <div class="column container p-4 mt-3 columns">
      <div class="content column is-7">
      <section class="hero is-link is-small mb-5">
          <div class="hero-body">
            <p class="title">
              <i class="fas fa-user"></i> &nbsp;
                About Me
            </p>
          </div>
        </section>
          <form>
            <div class="tile is-ancestor mb-6 mt-2">
              <div class="tile is-4 is-vertical box">
                <figure class="image is-128x128">
                  <?php
                      if($session->get('img_pic'))
                      {

                  ?>
                  <img src="<?=$session->get('img_pic')?>">
                  <?php
                      }
                      else
                      {
                  ?>
                    <img src="https://bulma.io/images/placeholders/128x128.png">
                  <?php
                       
                      }
                  ?>
                </figure>
              </div>
              <div class="tile is-vertical ml-3 pl-3">
                <div class="field">
                  <label for="" class="label">About</label>
                </div>
                <div class="control">
                  <textarea class="textarea has-fixed-size has-text-black" name="announcement_details" disabled><?=$session->get('about')?></textarea>
                </div>
              </div>
            </div>
            <div class="field">
              <label for="" class="label">Email</label>
            </div>
            <div class="control">
                <input type="email" name="email" value="<?=$session->get('email')?>" class="input has-text-black" disabled>
            </div>
            <div class="field">
                <label for="" class="label">Username</label>
            </div>
            <div class="control">
                <input type="text" name="username" value="<?=$session->get('username')?>" class="input has-text-black" disabled>
            </div>
            <div class="field">
                <label for="" class="label">Password</label>
            </div>
            <div class="control">
                <input type="password" id="password" name="password" value="<?=$session->get('password')?>" class="input has-text-black" disabled>
            </div>
            <div class="field">
                <label for="" class="label">First name</label>
            </div>
            <div class="control">
                <input type="text" name="fname" value="<?=$session->get('fname')?>" class="input has-text-black" disabled>
            </div>
            <div class="field">
                <label for="" class="label">Middle name</label>
            </div>
            <div class="control">
                <input type="text" name="mname" value="<?=$session->get('mname')?>" class="input has-text-black" disabled>
            </div>
            <div class="field">
                <label for="" class="label">Last name</label>
            </div>
            <div class="control">
                <input type="text" name="lname" value="<?=$session->get('lname')?>" class="input has-text-black" disabled>
            </div>
          </form>
        </div>
      </div>
</div>
</body>
</html>