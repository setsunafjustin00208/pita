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
        if($usertype != 'TEACHER')
        {
          if($usertype == 'STUDENT')
          {
            header("Location:".site_url('/views/view_student'));
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
    $uri = new \CodeIgniter\HTTP\URI();
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
          <a href="<?=site_url('/views/teacher_about')?>" class="navbar-item">
          <i class="fa fa-user"></i>&nbsp;
            About me
          </a>
          <a href="<?=site_url('/views/teacher_profile')?>" class="navbar-item">
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
            <p class="menu-label">
                General
            </p>
            <ul class="menu-list">
                <li><a href="<?=site_url('/views/view_teacher')?>">Dashboard</a></li>
                <li><a href="<?=site_url('/views/teacher_ide')?>">Intergrated Dev. Env</a></li>
                <li><a href="<?=site_url('/views/teacher_view_students')?>">Students List</a></li>
            </ul>
            <p class="menu-label">
                Class management
            </p>
            <ul class="menu-list">
                <li><a href="<?=site_url('/views/teacher_manage_students')?>">Manage Students</a></li>
                <li><a class="is-active" href="<?=site_url('/views/teacher_actvities')?>">Manage Actvities</a></li>
                
            </ul>
        </aside>
    </div>
    <div class="column container p-4 mt-3">
    <section class="hero is-link is-small mb-5">
        <div class="hero-body">
          <p class="title">
            <i class="fa-solid fa-tasks"></i> &nbsp;
              List of Students
          </p>
          <p class="subtitle">
            Who took the activity
          </p>
        </div>
      </section>
    <div class="container box">
        <table class="table is-narrow is-hoverable is-fullwidth display compact cell-border stripe" id="mytable">
        <script>
                $(document).ready( function () {
                  $('#mytable').DataTable({
                      stateSave: true
                  } );
                });
            </script>
            <thead>
                <tr>
                          <th><abbr title="Student name">Student Name</abbr></th>
                          <th><abbr title="Score">Score</abbr></th>
                          <th><abbr title="Student Output">Student Output</abbr></th>
                          <th><abbr title="Student Evidence">View Code</abbr></th>
                </tr>
            </thead>
            <tbody>
              <?php
                   $activity_builder= db_connect()->table('scores');
                   $activity_builder->select('*');
                   $activity_builder->join('users','users.user_id = scores.student_id','inner');
                   $activity_results = $activity_builder->getWhere(['scores.activity_id' => $_SESSION['activity_id'],'scores.teacher_id' => session()->get('user_id'),'users.user_type' => 'STUDENT','users.section' => $session->get('section'),'users.grade'=>$session->get('grade')]);

                   foreach($activity_results->getResult() as $activityRow)
                   {
              ?>
              <tr>
                  <td><?=$activityRow->fname?>&nbsp;<?=$activityRow->mname?>&nbsp;<?=$activityRow->lname?></td>
                  <td><?=$activityRow->activity_score?></td>
                  <td><?=$activityRow->student_output?></td>
                  <td>
                    <div class="buttons">
                      <a data-target="modal-trigger-view<?=$activityRow->activity_id?>" class="button is-warning is-small modal-trigger"><i class="fa fa-eye"></i></a>
                      <div id= "modal-trigger-view<?=$activityRow->activity_id?>" class="modal modal-fx-fadeInScale">
                          <div class="modal-background"></div>
                            <div class="modal-card modal-size">
                              <header class="modal-card-head">
                                <p class="modal-card-title">Edit Activity</p>
                                  <button class="delete" aria-label="close"></button>
                              </header>
                              <section class="modal-card-body">
                              <figure class="image">
                                <img src="<?=$activityRow->student_evidence?>">
                              </figure>
                                <footer class="modal-card-foot">
                                  <button class="button">Cancel</button>
                                </footer>
                              </div>
                        </div>
                    </div>
                  </td>

              </tr>

              <?php
                   }
              ?>
            </tbody>
            <foot>
                <tr>
                          <th><abbr title="Student name">Student Name</abbr></th>
                          <th><abbr title="Score">Score</abbr></th>
                          <th><abbr title="Student Output">Student Output</abbr></th>
                          <th><abbr title="Student Evidence">View Code</abbr></th>
                </tr>
            </foot>
        </table>
    </div>
    </div>

</div>
</body>
</html>