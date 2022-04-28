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
    <link rel="stylesheet" href="<?=base_url('/design/css/dataTables.bulma.min.css')?>" type="text/css">
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
                <li><a class="is-active" href="<?=site_url('/views/view_admin')?>">Dashboard</a></li>
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
                <li><a href="<?=site_url('/views/admin_overall_statistics')?>">Overall</a></li>
                <li><a href="<?=site_url('/views/admin_users_statistics')?>">Number of users</a></li>
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
      <?php
        $allusers_count=db_connect()->table('users');
      ?>
      <div class="level-item has-text-centered">
        <div>
          <p class="heading">Total Users</p>
          <p class="title"><?=$allusers_count->countAll()?></p>
        </div>
      </div>
      <div class="level-item has-text-centered">
        <div>
          <p class="heading">Administrators</p>
          <p class="title">
            <?php
              $admin_count = db_connect();
              $count_admin_query= $admin_count->query("SELECT COUNT(user_id) as admincount FROM users WHERE user_type = 'ADMIN' ");
              $countrow = $count_admin_query->getRow();
              if(isset($countrow))
              {
                  echo $countrow->admincount;
              }
            ?>
          </p>
        </div>
      </div>
      <div class="level-item has-text-centered">
        <div>
          <p class="heading">Teachers</p>
          <p class="title">
          <?php
              $teacher_count = db_connect();
              $count_teacher_query= $teacher_count->query("SELECT COUNT(user_id) as teachercount FROM users WHERE user_type = 'TEACHER' ");
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
              $count_student_query= $student_count->query("SELECT COUNT(user_id) as studentcount FROM users WHERE user_type = 'STUDENT' ");
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
                                <?=form_open('databasecontroller/create_announcements')?>
                                  <input type="hidden" name="date_created" value="<?=date("y_m_d H:i:s")?>">
                                  <input type="hidden" name="date_modified" value="<?=date("y_m_d H:i:s")?>">
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
                                    <textarea class="textarea is-link has-fixed-size" name="announcement_details" placeholder="Details"></textarea>
                                  </div>
                                <footer class="modal-card-foot">
                                  <button class="button is-success" id="submit"><i class="fa fa-plus"></i> &nbsp; Post</button>
                                </form>
                                  <button class="button">Cancel</button>
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
                   $announcement_builder= db_connect()->table('announcements');
                   $announcement_results = $announcement_builder->get();

                   foreach($announcement_results->getResult() as $announcementRow)
                   {
              ?>
              <tr>
                  <td><?=$announcementRow->announcement_title?></td>
                  <td><?=$announcementRow->announcement_details?></td>
                  <td>
                  <div class="buttons">
                    <a data-target="modal-trigger-edit<?=$announcementRow->a_id?>" class="button is-success is-small modal-trigger"><i class="fa fa-edit"></i></a>
                      <div id= "modal-trigger-edit<?=$announcementRow->a_id?>" class="modal modal-fx-fadeInScale">
                          <div class="modal-background"></div>
                            <div class="modal-card modal-size">
                              <header class="modal-card-head">
                                <p class="modal-card-title">Edit Announcement</p>
                                  <button class="delete" aria-label="close"></button>
                              </header>
                              <section class="modal-card-body">
                                <?=form_open('databasecontroller/update_announcements')?>
                                  <input type="hidden" name="a_id" value="<?=$announcementRow->a_id?>">
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
                                      <textarea class="textarea is-link has-fixed-size" name="announcement_details"><?=$announcementRow->announcement_details?></textarea>
                                    </div>
                                <footer class="modal-card-foot">
                                  <button class="button is-success" id="submit"><i class="fa fa-refresh"></i> &nbsp; Update Announcement</button>
                                </form>
                                  <button class="button">Cancel</button>
                                </footer>
                              </div>
                        </div>
                        <a data-target="modal-trigger-delete<?=$announcementRow->a_id?>" class="button is-danger is-small modal-trigger"><i class="fa fa-trash"></i></a>
                          <div id= "modal-trigger-delete<?=$announcementRow->a_id?>" class="modal modal-fx-fadeInScale">
                            <div class="modal-background"></div>
                                <div class="modal-card modal-size">
                                        <header class="modal-card-head">
                                            <p class="modal-card-title">Delete Announcement?</p>
                                            <button class="delete" aria-label="close"></button>
                                        </header>
                                        <section class="modal-card-body">
                                        <?=form_open('databasecontroller/delete_announcements')?>
                                            <h2 class="subtitle">Are you sure to delete this Announcement?</h2>
                                            <input type="hidden" name="a_id" value="<?=$announcementRow->a_id?>">
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
</body>
</html>