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
    <div class="column container p-4 mt-3">
    <section class="hero is-link is-small mb-5">
        <div class="hero-body">
          <p class="title">
            <i class="fa-solid fa-table-columns"></i> &nbsp;
              Dashboard
          </p>
          <p class="subtitle">
            <?php
              if($session->get('section') == 'TBA' && $session->get('grade') == 0)
              {
                echo "Wait for someone assigned you in a class";
              }
              else
              {

            ?>
           
            How is your day? Your Here at Grade <?=$session->get('grade')?> Section <?=$session->get('section')?>
            <?php
                }
            ?>
          </p>
        </div>
      </section>
      <nav class="level is-mobile">
     
      <div class="level-item has-text-centered">
        <div>
          <p class="heading">Total Actvities</p>
          <p class="title">
            <?php
                $activity_count = db_connect();
                $count_activity_query= $activity_count->query("SELECT COUNT(activity_id) as activitycount FROM actvities WHERE section = '{$session->get('section')}'");
                $activityrow = $count_activity_query->getRow();
                if(isset($activityrow))
                {
                    echo $activityrow->activitycount;
                }
            ?>
          </p>
        </div>
      </div>
      <div class="level-item has-text-centered">
        <div>
          <p class="heading">Total Announcements</p>
          <p class="title">
          <?php
              $teacher_count = db_connect();
              $count_teacher_query= $teacher_count->query("SELECT COUNT(ta_id) as teachercount FROM teacher_announcements WHERE teacher_section = '{$session->get('section')}' ");
              $teacherrow = $count_teacher_query->getRow();
              if(isset($teacherrow))
              {
                  echo $teacherrow->teachercount;
              }
            ?>
          </p>
        </div>
      </div>
      <div class="level-item has-text-centered">
        <div>
          <p class="heading">students</p>
          <p class="title">
            <?php
              $student_count = db_connect();
              $count_student_query= $student_count->query("SELECT COUNT(user_id) as studentcount FROM users WHERE user_type = 'STUDENT' and section = '{$session->get('section')}' and grade = '{$session->get('grade')}'");
              $studentrow = $count_student_query->getRow();
              if(isset($studentrow))
              {
                  echo $studentrow->studentcount;
              }
            ?></p>
        </div>
      </div>
    </nav>
    <div class="container box">
        <?php
            $teacher_announcment_builder = db_connect()->table('teacher_announcements');
            $teacher_announcment_builder->orderBy('ta_id','DESC');
            $teacher_announcment_query = $teacher_announcment_builder->getWhere(['teacher_section' => $session->get('section'), 'teacher_grade' => $session->get('grade')],1);
            foreach($teacher_announcment_query->getResult() as $ta_row)
            {

            
        ?>
        <h1 class="title">Announcements:</h1>
        <h1 class="subtitle mt-5"><?=$ta_row->announcement_title?></h1>
        <textarea class="textarea has-fixed-size" name="" id="" cols="30" rows="10" readonly><?=$ta_row->announcement_body?></textarea>
        <?php
            }
        ?>
    </div>
    </div>

</div>
</body>
</html>