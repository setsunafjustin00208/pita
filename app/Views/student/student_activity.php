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
          if($usertype == 'TEACHER')
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
        $_SESSION['Activate'] = "Account Inactive";
        $_SESSION['ActivateCode'] = "Enter Code first";
        header('Location:'.site_url('views/verification_page'));
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
      <figure class="image">
            <i><img src="<?=base_url('/design/images/PITA.png')?>" width="1280" height="1280"></i>
        </figure>
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
                <li><a href="<?=site_url('/views/view_student')?>">Dashboard</a></li>
                <li><a href="<?=site_url('/views/student_ide')?>">Intergrated Dev. Env</a></li>
                <li>
                  <?php
                     if($session->get('section') != 'TBA' && $session->get('grade') != 0)
                     {
                  ?>
                  <a class="is-active" href="<?=site_url('/views/student_activity')?>">Activities</a>
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
            <i class="fa-solid fa-tasks"></i> &nbsp;
              Activities
          </p>
          <p class="subtitle">
              <?php
              if(isset($_SESSION['message']))
              {
                 print_r($_SESSION['message']);
                unset($_SESSION['message']);
              }
              else
              {
                echo "View and do your activities";
              }
            ?>
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
                          <th><abbr title="Activity_title">ActTitle</abbr></th>
                          <th><abbr title="Activity_details">ActBdy</abbr></th>
                          <th><abbr title="Activity_output">output</abbr></th>
                          <th><abbr title="Actions">Actn</abbr></th>
                </tr>
            </thead>
            <tbody>
              <?php
                   $activity_builder= db_connect()->table('actvities');
                   $activity_results = $activity_builder->getWhere(['grade' => $session->get('grade'), 'section' => $session->get('section') ]);

                   foreach($activity_results->getResult() as $activityRow)
                   {
              ?>
              <tr>
                  <td><?=$activityRow->activity_title?></td>
                  <td><?=$activityRow->activity_details?></td>
                  <td><?=$activityRow->activity_output?></td>
                  <td>
                  <div class="buttons">
                      <?php
                        $actvity_verification = db_connect()->table('scores');
                        $ver =  $actvity_verification->getWhere(['student_id'=>$session->get('user_id'),'activity_id' =>$activityRow->activity_id]);
                        $rowscore = $ver->getRow();
                        if(isset($rowscore))
                        {
                      ?>
                        <a data-target="modal-trigger-view<?=$rowscore->score_id?>" class="button is-warning is-small modal-trigger"><i class="fa fa-eye"></i></a>
                                <div id= "modal-trigger-view<?=$rowscore->score_id?>" class="modal modal-fx-fadeInScale">
                                  <div class="modal-background"></div>
                                      <div class="modal-card modal-size">
                                              <header class="modal-card-head">
                                                  <p class="modal-card-title">Results</p>
                                                  <button class="delete" aria-label="close"></button>
                                              </header>
                                              <section class="modal-card-body">
                                                <form>
                                                <div class="field">
                                                      <label for="" class="label">Score</label>
                                                  </div>
                                                  <div class="control mb-5">
                                                      <input type="text" value="<?=$rowscore->student_score?>/<?=$activityRow->activity_score?>" class="input is-link" disabled>
                                                  </div>
                                                  <div class="field">
                                                      <label for="" class="label">Code output</label>
                                                  </div>
                                                  <div class="control">
                                                     <figure class="image">
                                                        <img src="<?=$rowscore->student_evidence?>">
                                                     </figure>
                                                  </div>
                                                </form>
                                              </section>
                                              <footer class="modal-card-foot">

                                                  <button class="button is-link is-small"><i class="fa fa-close"></i>&nbsp; Close</button>
                                              </footer>
                                      </div>
                              </div>
                      <?php 
                        }
                        else
                        {
                    
                       
                      ?>
                        <a href="<?=site_url('/views/student_do_activity')?>/<?=$activityRow->activity_id?>" class="button is-link is-small"><i class="fa fa-eye"></i></a>
                    <?php
                         }
                      
                    ?>
                    </div>
                  </td>
              </tr>

              <?php
                   }
              ?>
            </tbody>
            <foot>
                <tr>
                          <th><abbr title="Activity_title">ActTitle</abbr></th>
                          <th><abbr title="Activity_details">ActBdy</abbr></th>
                          <th><abbr title="Actions">Actn</abbr></th>
                </tr>
            </foot>
        </table>
    </div>
    </div>

</div>
</body>
</html>