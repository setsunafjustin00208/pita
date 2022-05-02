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
                <li><a href="<?=site_url('/views/view_teacher')?>">Dashboard</a></li>
                <li><a href="<?=site_url('/views/teacher_ide')?>">Intergrated Dev. Env</a></li>
                <li><a href="<?=site_url('/views/teacher_view_students')?>">Students List</a></li>
            </ul>
            <p class="menu-label">
                Class management
            </p>
            <ul class="menu-list">
                <li><a class="is-active" href="<?=site_url('/views/teacher_manage_students')?>">Manage Students</a></li>
                <li><a href="<?=site_url('/views/teacher_actvities')?>">Manage Actvities</a></li>
                
            </ul>
        </aside>
    </div>
    <div class="column container p-4 mt-3">
    <section class="hero is-link is-small mb-5">
      <div class="hero-body">
        <p class="title">
          <i class="fa fa-users"></i> &nbsp;
            Manage Students
        </p>
        <p class="subtitle">
          Check if there is the Student that you are looking for.
        </p>
      </div>
    </section>
      <div class="table-container box">
        <h1 class="title is-3">Your Class</h1>
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
                  $user_results = $users_builder->getWhere(['user_type'=>'STUDENT','grade' => $session->get('grade'),'section'=> $session->get('section')]);

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
                              <button data-target="modal-trigger-delete<?=$userRow->user_id?>" class="button is-danger is-small modal-trigger"><i class="fa-solid fa-minus"></i></button>
                              <div id= "modal-trigger-delete<?=$userRow->user_id?>" class="modal modal-fx-fadeInScale">
                                  <div class="modal-background"></div>
                                      <div class="modal-card modal-size">
                                              <header class="modal-card-head">
                                                  <p class="modal-card-title">Delete User?</p>
                                                  <button class="delete" aria-label="close"></button>
                                              </header>
                                              <section class="modal-card-body">
                                              <?=form_open('databasecontroller/remove_student')?>
                                                  <h2 class="subtitle">Are you sure to remove this student?</h2>
                                                  <input type="hidden" name="user_id" value="<?=$userRow->user_id?>">
                                                  <input type="hidden" name="grade" value="0">
                                                  <input type="hidden" name="section" value="TBA">
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
      <div class="table-container mt-6 box">
      <h1 class="title is-3">Available Students</h1>
        <table class="table is-narrow is-hoverable is-fullwidth display compact cell-border stripe"id="mytable2">
            <script>
                $(document).ready( function () {
                  $('#mytable2').DataTable({
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
                  $user_results = $users_builder->getWhere(['user_type'=>'STUDENT','grade' => 0,'section'=> 'TBA']);

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
                              <button data-target="modal-trigger-add<?=$userRow->user_id?>" class="button is-warning is-small modal-trigger"><i class="fa-solid fa-plus"></i></button>
                              <div id= "modal-trigger-add<?=$userRow->user_id?>" class="modal modal-fx-fadeInScale">
                                  <div class="modal-background"></div>
                                      <div class="modal-card modal-size">
                                              <header class="modal-card-head">
                                                  <p class="modal-card-title">Delete User?</p>
                                                  <button class="delete" aria-label="close"></button>
                                              </header>
                                              <section class="modal-card-body">
                                              <?=form_open('databasecontroller/add_student')?>
                                              <h2 class="subtitle">Are you sure to add this student?</h2>
                                                  <input type="hidden" name="user_id" value="<?=$userRow->user_id?>">
                                                  <input type="hidden" name="grade" value="<?=$session->get('grade')?>">
                                                  <input type="hidden" name="section" value="<?=$session->get('section')?>">
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