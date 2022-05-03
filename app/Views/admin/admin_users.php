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
    <script src="<?=base_url('/design/js/dataTables.bulma.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/datatables.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/jquery.dataTables.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/popper.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/modal-fx.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/sweetalert2.all.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/acorn_interpreter.js')?>"></script>
    <script src="<?=base_url('/design/js/blockly_compressed.js')?>"></script>
    <script src="<?=base_url('/design/js/blocks_compressed.js')?>"></script>
    <script src="<?=base_url('/design/js/javascript_compressed.js')?>"></script>
    <script src="<?=base_url('/design/js/msg/js/en.js')?>"></script>
    <script src="<?=base_url('/design/js/wait_block.js')?>"></script>
    <title>Hello <?=session()->get('fname')?></title>

<body>
<nav class="navbar is-link" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="<?=site_url('/views/view_admin')?>">
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
          <a href="<?=site_url('/views/admin_about_view')?>" class="navbar-item">
          <i class="fa fa-user"></i>&nbsp;
            About me
          </a>
          <a href="<?=site_url('/views/admin_profile_view')?>" class="navbar-item">
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
                <li><a  href="<?=site_url('/views/view_admin')?>">Dashboard</a></li>
                <li><a class="is-active" href="<?=site_url('/views/view_admin_users')?>">Users</a></li>
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
                <li><a href="<?=site_url('/views/admin_overall_statistics')?>">System Statistics</a></li>
            </ul>
        </aside>
    </div>
    <div class="column container p-4 mt-3">
    <section class="hero is-link is-small mb-5">
      <div class="hero-body">
        <p class="title">
          <i class="fa fa-users"></i> &nbsp;
            List Of users
        </p>
        <p class="subtitle">
          Check if there is the user that you are looking for.
        </p>
      </div>
    </section>
      <div class="table-container">
        <table class="table is-narrow is-hoverable is-fullwidth display compact cell-border stripe"id="mytable">
            <script>
                $(document).ready( function () {
                  $('#mytable').DataTable({
                      stateSave: true
                  } );
                });
            </script>
            <thead>
              <tr>
                <th><abbr title="Email">Email</abbr></th>
                <th><abbr title="Username">Username</abbr></th>
                <th><abbr title="Name">Name</abbr></th>
                <th><abbr title="User Type">UsrType</abbr></th>
                <th><abbr title="Status">Status</abbr></th>
                <th><abbr title="Action">Actn</abbr></th>
              </tr>
            </thead>
            <tbody>
                <?php
                  $users_builder= db_connect()->table('users');
                  $user_results = $users_builder->get();

                  foreach($user_results->getResult() as $userRow)
                  {
                ?>
                <tr>
                  <td><?=$userRow->email?></td>
                  <td><?=$userRow->username?></td>
                  <td><?=$userRow->lname?>,&nbsp;<?=$userRow->fname?>&nbsp;<?=$userRow->mname?></td>
                  <td><?=$userRow->user_type?></td>
                  <td><?=$userRow->is_active?></td>
                  <td>
                    <div class="buttons">
                        <button data-target="modal-trigger-view-info<?=$userRow->user_id?>" class="button is-success is-small modal-trigger"><i class="fa-solid fa-eye"></i></button>
                        <div id= "modal-trigger-view-info<?=$userRow->user_id?>" class="modal modal-fx-fadeInScale">
                                  <div class="modal-background"></div>
                                      <div class="modal-card modal-size">
                                              <header class="modal-card-head">
                                                  <p class="modal-card-title">User Account Information</p>
                                                  <button class="delete" aria-label="close"></button>
                                              </header>
                                              <section class="modal-card-body">
                                                <form action="">
                                                  <div class="control mb-2">
                                                  <figure class="image is-128x128 ml-4">
                                                      <?php
                                                          if(!$userRow->img_pic)
                                                          {
                                                            echo '<img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">';
                                                          }
                                                          else
                                                          {
                                                            ?>
                                                            <img class="is-rounded" src="<?=$userRow->img_pic?>">
                                                      <?php     
                                                          }

                                                      ?>
                                                    </figure>
                                                  </div>
                                                  <div class="field">
                                                      <label for="" class="label">Email:</label>
                                                  </div>
                                                  <div class="control mb-2">
                                                      <input type="email" value="<?=$userRow->email?>" class="input is-link has-text-black" disabled>
                                                  </div>
                                                  <div class="field">
                                                      <label for="" class="label">Password:</label>
                                                  </div>
                                                  <div class="control mb-2">
                                                      <input type="text" value="<?=$userRow->password?>" class="input is-link has-text-black" disabled>
                                                  </div>
                                                  <div class="field">
                                                      <label for="" class="label">First name:</label>
                                                  </div>
                                                  <div class="control mb-2">
                                                      <input type="text" value="<?=$userRow->fname?>" class="input is-link has-text-black" disabled>
                                                  </div>
                                                  <div class="field">
                                                      <label for="" class="label">Middle name:</label>
                                                  </div>
                                                  <div class="control mb-2">
                                                      <input type="text" value="<?=$userRow->mname?>" class="input is-link has-text-black" disabled>
                                                  </div>
                                                  <div class="field">
                                                      <label for="" class="label">Last name:</label>
                                                  </div>
                                                  <div class="control mb-2">
                                                      <input type="text" value="<?=$userRow->lname?>" class="input is-link has-text-black" disabled>
                                                  </div>
                                                  <div class="field">
                                                      <label for="" class="label">Grade:</label>
                                                  </div>
                                                  <div class="control mb-2">
                                                      <input type="text" value="<?=$userRow->grade?>" class="input is-link has-text-black" disabled>
                                                  </div>
                                                  <div class="field">
                                                      <label for="" class="label">Section:</label>
                                                  </div>
                                                  <div class="control mb-2">
                                                      <input type="text" value="<?=$userRow->section?>" class="input is-link has-text-black" disabled>
                                                  </div>
                                                </form>
                                              </section>
                                              <footer class="modal-card-foot">
                                                  <button class="button is-link">Done</button>
                                              </footer>
                                      </div>
                              </div>
                        <?php
                          if(($userRow->user_id) != $session->get('user_id'))
                          {
                        ?>
                        <button data-target="modal-trigger-change-status<?=$userRow->user_id?>"class="button is-warning modal-trigger is-small"><i class="fa-solid fa-person-military-to-person"></i></button>
                        <div id= "modal-trigger-change-status<?=$userRow->user_id?>" class="modal modal-fx-fadeInScale">
                                  <div class="modal-background"></div>
                                      <div class="modal-card modal-size">
                                              <header class="modal-card-head">
                                                  <p class="modal-card-title">Change Account Status</p>
                                                  <button class="delete" aria-label="close"></button>
                                              </header>
                                              <section class="modal-card-body">
                                                <?=form_open('databasecontroller/update_status')?>
                                                  <input type="hidden" name="user_id" value="<?=$userRow->user_id?>">
                                                  <input type="hidden" name="email" value="<?=$userRow->email?>">
                                                  <?php
                                                      if(($userRow->is_active) ==  "ACTIVE")
                                                      {
                                                  ?>
                                                  <div class="control">
                                                    <label class="radio">
                                                      <input type="radio" name="is_active" value="ACTIVE" checked>
                                                      ACTIVE
                                                    </label>
                                                    <label class="radio">
                                                      <input type="radio" name="is_active" value="DISABLED">
                                                      DISABLED
                                                    </label>
                                                  </div>
                                                  <?php 
                                                     }
                                                     else
                                                     {
                                                  ?>
                                                    <div class="control">
                                                    <label class="radio">
                                                      <input type="radio" name="is_active" value="ACTIVE">
                                                      ACTIVE
                                                    </label>
                                                    <label class="radio">
                                                      <input type="radio" name="is_active" value="DISABLED" checked>
                                                      DISABLED
                                                    </label>
                                                  </div>
                                                  <?php
                                                    }
                                                  ?>
                                              </section>
                                              <footer class="modal-card-foot">
                                                  <button class="button is-success">Change Status</button>
                                                </form> 
                                                  <button class="button is-link">Cancel</button>
                                              </footer>
                                      </div>
                              </div>
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
            <tfoot>
              <tr>
                <th><abbr title="Email">Email</abbr></th>
                <th><abbr title="Username">Username</abbr></th>
                <th><abbr title="Name">Name</abbr></th>
                <th><abbr title="User Type">UsrType</abbr></th>
                <th><abbr title="Status">Status</abbr></th>
                <th><abbr title="Action">Actn</abbr></th>
              </tr>
            </tfoot>
        </table>
      </div>
    </div>
</div>
</body>
</html>