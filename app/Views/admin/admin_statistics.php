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
          if($usertype != 'ADMIN')
          {
            if($usertype == 'STUDENT')
            {
                header("Location:".site_url('/views/view_student'));
                exit();
            }
            else if ($usertype == 'TEACHER')
            {
              header("Location:".site_url('/views/view_teacher'));
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
    <link rel="stylesheet" href="<?=base_url('/design/css/mine.css')?>" type="text/css">
    <script src="<?=base_url('/design/js/mine.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/all.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/jquery-3.6.0.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/popper.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/modal-fx.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/sweetalert2.all.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/dataTables.bulma.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/datatables.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/jquery.dataTables.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/chart.esm.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/chart.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/acorn_interpreter.js')?>"></script>
    <script src="<?=base_url('/design/js/blockly_compressed.js')?>"></script>
    <script src="<?=base_url('/design/js/blocks_compressed.js')?>"></script>
    <script src="<?=base_url('/design/js/javascript_compressed.js')?>"></script>
    <script src="<?=base_url('/design/js/msg/js/en.js')?>"></script>
    <script src="<?=base_url('/design/js/wait_block.js')?>"></script>
    <title>Hello <?=session()->get('fname')?></title>
</head>
<body>
<nav class="navbar is-link" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="<?=site_url('/views/view_admin')?>">
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
          <a href="<?=site_url('/views/admin_about_view')?>" class="navbar-item">
          <i class="fa fa-user"></i>&nbsp;
            About me
          </a>
          <a href="<?=site_url('/views/admin_about_view')?>" class="navbar-item">
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
                <li><a href="<?=site_url('/views/view_admin')?>">Dashboard</a></li>
                <li><a href="<?=site_url('/views/view_admin_users')?>">Users</a></li>
            </ul>
            <p class="menu-label">
                User manipulation
            </p>
            <ul class="menu-list">
                <li><a>Manage users</a></li>
                <li>
                <ul>
                    <li><a href="<?=site_url('/views/admin_teacher_view')?>">Teachers</a></li>
                    <li><a href="<?=site_url('/views/admin_student_view')?>">Students</a></li>
                    <li><a href="<?=site_url('/views/admin_administrator_view')?>">Administrators</a></li>
                </ul>
            </ul>
            <p class="menu-label">
                Statistics
            </p>
            <ul class="menu-list">
                <li><a class="is-active" href="<?=site_url('/views/admin_overall_statistics')?>">Overall</a></li>
            </ul>
        </aside>
    </div>
    <div class="column container p-3 mt-4">
    <section class="hero is-link is-small mb-5">
        <div class="hero-body">
          <p class="title">
            <i class="fa-solid fa-chart-bar"></i> &nbsp;
              System Statistics
          </p>
          <p class="subtitle">
            Overall Statistics of the system
          </p>
        </div>
      </section>
      <?php
              /**Data for the user chart */
                $allusers_count=db_connect()->table('users');
                $all_users = $allusers_count->countAll();
               

                $admin_count = db_connect();
                $count_admin_query= $admin_count->query("SELECT COUNT(user_id) as admincount FROM users WHERE user_type = 'ADMIN' ");
                $countrow = $count_admin_query->getRow();
                if(isset($countrow))
                {
                  $count_admin = $countrow->admincount;
                }

                $teacher_count = db_connect();
                $count_teacher_query= $teacher_count->query("SELECT COUNT(user_id) as teachercount FROM users WHERE user_type = 'TEACHER' ");
                $teacherrow = $count_teacher_query->getRow();
                if(isset($teacherrow))
                {
                    $count_teacher = $teacherrow->teachercount;
                }

                $student_count = db_connect();
                $count_student_query= $student_count->query("SELECT COUNT(user_id) as studentcount FROM users WHERE user_type = 'STUDENT' ");
                $studentrow = $count_student_query->getRow();
                if(isset($studentrow))
                {
                    $count_student = $studentrow->studentcount;
                }
              /**Data for the user chart */
              /**Data for activities chart */
                $activity_count = db_connect();
                $count_activity_query= $activity_count->query("SELECT COUNT(activity_id) as activitycount FROM actvities");
                $activitytrow = $count_activity_query->getRow();
                if(isset($activitytrow))
                {
                    $count_activity = $activitytrow->activitycount;
                }
                $score_count = db_connect();
                $count_score_query= $activity_count->query("SELECT COUNT(score_id) as scorecount FROM scores");
                $scoretrow = $count_score_query->getRow();
                if(isset($scoretrow))
                {
                    $count_score = $scoretrow->scorecount;
                }
              /**Data for activities chart */
            ?>
      <div class="buttons">
        <a href="<?=site_url('filecontroller/export_report')?>" class="button is-success"><i class="fa fa-file"></i>&nbsp; Generate Report</a>
      </div>
      <div class="tile is-ancestor p-4 mt-1 container">
        <style>
        .chart-container {
          position: relative;
          margin: auto;
          height: 80vh;
          width: 80vw;
        }
        </style>
        
        <script>
            $(function(){
                  var ctx = document.getElementById('myChart').getContext('2d');
                  var myChart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                      labels: ['Total', 'Admin', 'Teachers', 'Students'],
                      datasets: [{
                          label: '# of Users per Type',
                          data: [<?=$all_users?>, <?=$count_admin?>, <?=$count_teacher?>, <?=$count_student?>],
                          backgroundColor: [
                              'rgba(255, 99, 132, 0.2)',
                              'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 206, 86, 0.2)',
                              'rgba(75, 192, 192, 0.2)'
                          ],
                          borderColor: [
                              'rgba(255, 99, 132, 1)',
                              'rgba(54, 162, 235, 1)',
                              'rgba(255, 206, 86, 1)',
                              'rgba(75, 192, 192, 1)'
                          ],
                          borderWidth: 1
                      }]
                  },
                  options: {
                      scales: {
                          y: {
                              beginAtZero: true
                          }
                      },
                      responsive: true,
                  }
              });
                  var ctx = document.getElementById('myChart2').getContext('2d');
                  var myChart2 = new Chart(ctx, {
                  type: 'line',
                  data: {
                      labels: ['Total Act', 'ScoresAct','Teachers', 'Student'],
                      datasets: [{
                          label: '# of Actvities',
                          data: [<?=$count_activity?>, <?=$count_score?>, <?=$count_teacher?>, <?=$count_student?>],
                          backgroundColor: [
                              'rgba(255, 99, 132, 0.2)',
                              'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 206, 86, 0.2)',
                              'rgba(75, 192, 192, 0.2)'
                          ],
                          borderColor: [
                              'rgba(255, 99, 132, 1)',
                              'rgba(54, 162, 235, 1)',
                              'rgba(255, 206, 86, 1)',
                              'rgba(75, 192, 192, 1)'
  
                          ],
                          borderWidth: 1
                      }]
                  },
                  options: {
                      scales: {
                          y: {
                              beginAtZero: true
                          }
                      },
                      responsive: true,
                  }
              });
              var ctx = document.getElementById('myChart3').getContext('2d');
              var myChart3 = new Chart(ctx, {
                  type: 'radar',
                  data: {
                      labels: ['Total', 'Admin', 'Teachers', 'Students', 'Total Act', 'ScoresAct'],
                      datasets: [{
                          label: 'Total Statistics',
                          data: [<?=$all_users?>, <?=$count_admin?>, <?=$count_teacher?>, <?=$count_student?>,<?=$count_activity?>, <?=$count_score?>],
                          backgroundColor: [
                              'rgba(255, 99, 132, 0.2)',
                              'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 206, 86, 0.2)',
                              'rgba(75, 192, 192, 0.2)',
                              'rgba(153, 102, 255, 0.2)',
                              'rgba(255, 159, 64, 0.2)'
                          ],
                          borderColor: [
                              'rgba(255, 99, 132, 1)',
                              'rgba(54, 162, 235, 1)',
                              'rgba(255, 206, 86, 1)',
                              'rgba(75, 192, 192, 1)',
                              'rgba(153, 102, 255, 1)',
                              'rgba(255, 159, 64, 1)'
                          ],
                          borderWidth: 1
                      }]
                  },
                  options: {
                      scales: {
                          y: {
                              beginAtZero: true
                          },
                         
        
                      },
                      responsive: true,
                  }
              });
            });
          </script>
        <div class="tile is-5 is-vertical p-3 mr-6 ml-3 is-offset-2 ml-6" class="chart-container">
          <p class="title is-4">User Chart</p>
          <canvas id="myChart" width="100" height="100"></canvas>
        </div>
        <div class="tile is-5 is-vertical p-3 mr-6 ml-3" class="chart-container">
        <p class="title is-4">Activity Chart</p>
          <canvas id="myChart2" width="100" height="100"></canvas>
        </div>
      </div>
      <div class="tile is-ancestor p-4 mt-1 container">
        <div class="tile is-11 is-vertical p-5">
        <p class="title is-4">Total Statistics Chart</p>
          <canvas id="myChart3" width="100" height="100"></canvas>
        </div>
      </div>
      
    </div>
</div>
</body>
</html>