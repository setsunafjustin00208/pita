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
                <li><a class="is-active" href="<?=site_url('/views/view_teacher')?>">Dashboard</a></li>
                <li><a href="<?=site_url('/views/teacher_ide')?>">Intergrated Dev. Env</a></li>
                <li><a href="<?=site_url('/views/teacher_view_students')?>">Students List</a></li>
            </ul>
            <p class="menu-label">
                Class management
            </p>
            <ul class="menu-list">
                <li><a href="<?=site_url('/views/teacher_manage_students')?>">Manage Students</a></li>
                <li><a href="<?=site_url('/views/teacher_actvities')?>">Manage Actvities</a></li>
                
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
            How is your day?
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
                $count_activity_query= $activity_count->query("SELECT COUNT(activity_id) as activitycount FROM actvities WHERE teacher_id = '{$session->get('user_id')}'");
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
              $count_teacher_query= $teacher_count->query("SELECT COUNT(ta_id) as teachercount FROM teacher_announcements WHERE teacher_id = '{$session->get('user_id')}' ");
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
        <div class="buttons">
          <a data-target="modal-trigger" class="button is-link modal-trigger"><i class="fa fa-bullhorn"></i> &nbsp; Add New Announcement</a>
          <div id= "modal-trigger" class="modal modal-fx-fadeInScale">
                          <div class="modal-background"></div>
                            <div class="modal-card modal-size">
                              <header class="modal-card-head">
                                <p class="modal-card-title">Add Announcment</p>
                                  <button class="delete" aria-label="close"></button>
                              </header>
                              <section class="modal-card-body">
                                <?=form_open('databasecontroller/create_teacher_announcements')?>
                                  <input type="hidden" name="date_created" value="<?=date("y_m_d H:i:s")?>">
                                  <input type="hidden" name="date_modified" value="<?=date("y_m_d H:i:s")?>">
                                  <input type="hidden" name="teacher_grade" value="<?=$session->get('grade')?>">
                                  <input type="hidden" name="teacher_section" value="<?=$session->get('section')?>">
                                  <input type="hidden" name="teacher_id" value="<?=$session->get('user_id')?>">
                                  <div class="field">
                                     <label for="" class="label">Announcement Title</label>
                                  </div>
                                  <div class="control mb-5">
                                    <input type="text" name="announcement_title" placeholder="Title" class="input is-link">
                                  </div>
                                  <div class="field">
                                     <label for="" class="label">Announcement Detail</label>
                                  </div>
                                  <div class="control is-large">
                                    <textarea class="textarea is-link has-fixed-size" name="announcement_body" placeholder="Details"></textarea>
                                  </div>
                                <footer class="modal-card-foot">
                                  <button class="button is-success" id="submit"><i class="fa fa-plus"></i> &nbsp; Post</button>
                                </form>
                                </footer>
                              </div>
                        </div>
        </div>
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
                          <th><abbr title="Announcement_title">AnncmtTitle</abbr></th>
                          <th><abbr title="Announcement_details">AnncmtBdy</abbr></th>
                          <th><abbr title="Actions">Actn</abbr></th>
                </tr>
            </thead>
            <tbody>
              <?php
                   $announcement_builder= db_connect()->table('teacher_announcements');
                   $announcement_results = $announcement_builder->getWhere(['teacher_id' => $session->get('user_id')]);

                   foreach($announcement_results->getResult() as $announcementRow)
                   {
              ?>
              <tr>
                  <td><?=$announcementRow->announcement_title?></td>
                  <td><?=$announcementRow->announcement_body?></td>
                  <td>
                  <div class="buttons">
                    <a data-target="modal-trigger-edit<?=$announcementRow->ta_id?>" class="button is-success is-small modal-trigger"><i class="fa fa-edit"></i></a>
                      <div id= "modal-trigger-edit<?=$announcementRow->ta_id?>" class="modal modal-fx-fadeInScale">
                          <div class="modal-background"></div>
                            <div class="modal-card modal-size">
                              <header class="modal-card-head">
                                <p class="modal-card-title">Edit Announcement</p>
                                  <button class="delete" aria-label="close"></button>
                              </header>
                              <section class="modal-card-body">
                                <?=form_open('databasecontroller/update_teacher_announcements')?>
                                  <input type="hidden" name="ta_id" value="<?=$announcementRow->ta_id?>">
                                  <div class="field">
                                      <label for="" class="label">Announcement Title</label>
                                    </div>
                                    <div class="control mb-5">
                                      <input type="text" name="announcement_title" value="<?=$announcementRow->announcement_title?>" class="input is-link">
                                    </div>
                                    <div class="field">
                                      <label for="" class="label">Announcement Detail</label>
                                    </div>
                                    <div class="control is-large">
                                      <textarea class="textarea is-link has-fixed-size" name="announcement_body"><?=$announcementRow->announcement_body?></textarea>
                                    </div>
                                <footer class="modal-card-foot">
                                  <button class="button is-success" id="submit"><i class="fa fa-refresh"></i> &nbsp; Update Announcement</button>
                                </form>
                                  <button class="button">Cancel</button>
                                </footer>
                              </div>
                        </div>
                        <a data-target="modal-trigger-delete<?=$announcementRow->ta_id?>" class="button is-danger is-small modal-trigger"><i class="fa fa-trash"></i></a>
                          <div id= "modal-trigger-delete<?=$announcementRow->ta_id?>" class="modal modal-fx-fadeInScale">
                            <div class="modal-background"></div>
                                <div class="modal-card modal-size">
                                        <header class="modal-card-head">
                                            <p class="modal-card-title">Delete Announcement?</p>
                                            <button class="delete" aria-label="close"></button>
                                        </header>
                                        <section class="modal-card-body">
                                        <?=form_open('databasecontroller/delete_teacher_announcements')?>
                                            <h2 class="subtitle">Are you sure to delete this Announcement?</h2>
                                            <input type="hidden" name="ta_id" value="<?=$announcementRow->ta_id?>">
                                        </section>
                                        <footer class="modal-card-foot">
                                            <button class="button is-danger is-small"><i class="fa fa-check"></i> &nbsp;Yes</button>
                                        </form>
                                            <button class="button is-link is-small"><i class="fa fa-cancel"></i>&nbsp; No</button>
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
                          <th><abbr title="Announcement_title">AnncmtTitle</abbr></th>
                          <th><abbr title="Announcement_details">AnncmtBdy</abbr></th>
                          <th><abbr title="Actions">Actn</abbr></th>
                </tr>
            </foot>
        </table>
    </div>
    </div>

</div>
</body>
</html>