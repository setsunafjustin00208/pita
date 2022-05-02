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
                    <li><a  href="<?=site_url('/views/admin_teacher_view')?>">Teachers</a></li>
                    <li><a href="<?=site_url('/views/admin_student_view')?>">Students</a></li>
                    <li><a class="is-active" href="<?=site_url('/views/admin_administrator_view')?>">Administrators</a></li>
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
              <i class="fas fa-user-cog"></i> &nbsp;
                List of Administrators
            </p>
            <p class="subtitle">
              Check and manage Administrators. Except yours of course...
            </p>
          </div>
        </section>
    <div class="buttons">
        <a data-target="modal-trigger" class="button is-link modal-trigger"><i class="fas fa-user-cog"></i> &nbsp; Add Administrator</a>
      </div>
      <div id= "modal-trigger" class="modal modal-fx-fadeInScale">
            <div class="modal-background"></div>
                <div class="modal-card modal-size">
                        <header class="modal-card-head">
                            <p class="modal-card-title">Add Administrator</p>
                            <button class="delete" aria-label="close"></button>
                        </header>
                        <section class="modal-card-body">
                        <?=form_open('databasecontroller/add_users')?>
                        <input type="hidden" name="date_created" value="<?=date("y_m_d H:i:s")?>">
                        <input type="hidden" name="date_modified" value="<?=date("y_m_d H:i:s")?>">
                        <input type="hidden" name="is_active" value="ACTIVE">
                        <input type="hidden" name="grade" value="999">
                        <input type="hidden" name="section" value="ADMIN">
                        <input type="hidden" name="verification" value="0">
                        <input type="hidden" name="user_type" value="ADMIN">
                            <div class="field">
                                <label for="" class="label">Email</label>
                            </div>
                            <div class="control">
                                <input type="email" name="email" placeholder="Ente email" class="input is-link">
                            </div>
                            <div class="field">
                                <label for="" class="label">Username</label>
                            </div>
                            <div class="control">
                                <input type="text" name="username" placeholder="Enter Username" class="input is-link" required>
                            </div>
                            <div class="field">
                                <label for="" class="label">Password</label>
                            </div>
                            <div class="control">
                                <input type="password" id="password" name="password" placeholder="Enter Password" class="input is-link" onkeyup="check();" required>
                            </div>
                            <div class="field">
                                <label for="" class="label">Confirm Password</label>
                            </div>
                            <div class="control">
                                <input type="password" id="confirm" placeholder="Confirm Password" class="input is-link" onkeyup="check();" required>
                            </div>
                            <div class="field mt-2">
                                <label for="" class="label" id="message"></label>
                            </div>
                            <script>
                                var check = function() {
                                    if (document.getElementById('password').value == document.getElementById('confirm').value) 
                                    {
                                        if(document.getElementById('password').value === ""  || document.getElementById('confirm').value === "")
                                        {
                                            document.getElementById('message').innerHTML = '';
                                            document.getElementById('submit').disabled = true;
                                        }

                                        else
                                        {
                                            document.getElementById('message').style.color = 'green';
                                            document.getElementById('message').innerHTML = 'Passwords matched';
                                            document.getElementById('submit').disabled = false;
                                        }
                                       
                                    } 
                                    else {
                                        document.getElementById('message').style.color = 'red';
                                        document.getElementById('message').innerHTML = 'Passwords not matched';
                                        document.getElementById('submit').disabled = true;
                                    }
                                }
                        </script>
                            <div class="field">
                                <label for="" class="label">First name</label>
                            </div>
                            <div class="control">
                                <input type="text" name="fname" placeholder="Enter First Name" class="input is-link" required>
                            </div>
                            <div class="field">
                                <label for="" class="label">Middle name</label>
                            </div>
                            <div class="control">
                                <input type="text" name="mname" placeholder="Enter Middle name" class="input is-link" required>
                            </div>
                            <div class="field">
                                <label for="" class="label">Last name</label>
                            </div>
                            <div class="control">
                                <input type="text" name="lname" placeholder="Section" class="input is-link" required>
                            </div>
                        </section>
                        <footer class="modal-card-foot">
                            <button class="button is-success" id="submit"> <i class="fa fa-plus"></i> &nbsp; Add Administrator</button>
                        </form>
                        </footer>
                </div>
        </div>
      <div class="table-container">
      <table class="table is-narrow is-hoverable is-fullwidth display compact cell-border stripe"id="mytable">
                      <script>
                          $(document).ready( function () {
                            $('#mytable').DataTable();
                          });
                      </script>
                      <thead>
                        <tr>
                          <th><abbr title="Username">Username</abbr></th>
                          <th><abbr title="First Name">F.Name</abbr></th>
                          <th><abbr title="Middle Name">M.Name</abbr></th>
                          <th><abbr title="Last Name">L.Name</abbr></th>
                          <th><abbr title="Last Name">Grade</abbr></th>
                          <th><abbr title="Last Name">Section</abbr></th>
                          <th><abbr title="Last Name">Status</abbr></th>
                          <th><abbr title="Actions">Actn</abbr></th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                            $users_builder= db_connect()->table('users');
                            $user_results = $users_builder->getWhere(['user_type'=>'ADMIN']);

                            foreach($user_results->getResult() as $userRow)
                            {
                              if(($userRow->user_id) != $session->get('user_id'))
                              {

                              
                          ?>
                          <tr>
                            <td><?=$userRow->username?></td>
                            <td><?=$userRow->fname?></td>
                            <td><?=$userRow->mname?></td>
                            <td><?=$userRow->lname?></td>
                            <td><?=$userRow->grade?></td>
                            <td><?=$userRow->section?></td>
                            <td><?=$userRow->is_active?></td>
                            <td>
                              <div class="buttons">
                                <a data-target="modal-trigger-edit<?=$userRow->user_id?>" class="button is-success is-small modal-trigger"><i class="fa fa-edit"></i></a>
                                <div id= "modal-trigger-edit<?=$userRow->user_id?>" class="modal modal-fx-fadeInScale">
                                  <div class="modal-background"></div>
                                      <div class="modal-card modal-size">
                                              <header class="modal-card-head">
                                                  <p class="modal-card-title">Edit Administrators</p>
                                                  <button class="delete" aria-label="close"></button>
                                              </header>
                                              <section class="modal-card-body">
                                              <?=form_open('databasecontroller/update_users')?>
                                              <input type="hidden" name="date_created" value="<?=$userRow->date_created?>">
                                              <input type="hidden" name="date_modified" value="<?=date("y_m_d H:i:s")?>">
                                              <input type="hidden" name="verification" value="0">
                                              <input type="hidden" name="grade" value="999">
                                              <input type="hidden" name="section" value="ADMIN">
                                              <input type="hidden" name="user_id" value="<?=$userRow->user_id?>">
                                              <input type="hidden" name="user_type" value="<?=$userRow->user_type?>">
                                                  <div class="field">
                                                      <label for="" class="label">Email</label>
                                                  </div>
                                                  <div class="control">
                                                      <input type="email" name="email" value="<?=$userRow->email?>" class="input is-link">
                                                  </div>
                                                  <div class="field">
                                                      <label for="" class="label">Username</label>
                                                  </div>
                                                  <div class="control">
                                                      <input type="text" name="username" value="<?=$userRow->username?>" class="input is-link" required>
                                                  </div>
                                                  <div class="field">
                                                      <label for="" class="label">Password</label>
                                                  </div>
                                                  <div class="control">
                                                      <input type="password" id="password" name="password" value="<?=$userRow->password?>" class="input is-link" onkeyup="check();" required>
                                                  </div>
                                                  <div class="field">
                                                      <label for="" class="label">Confirm Password</label>
                                                  </div>
                                                  <div class="control">
                                                      <input type="password" id="confirm" value="<?=$userRow->password?>" class="input is-link" onkeyup="check();" required>
                                                  </div>
                                                  <div class="field mt-2">
                                                      <label for="" class="label" id="message"></label>
                                                  </div>
                                                  <script>
                                                      var check = function() {
                                                          if (document.getElementById('password').value == document.getElementById('confirm').value) 
                                                          {
                                                              if(document.getElementById('password').value === ""  || document.getElementById('confirm').value === "")
                                                              {
                                                                  document.getElementById('message').innerHTML = '';
                                                                  document.getElementById('submit').disabled = true;
                                                              }

                                                              else
                                                              {
                                                                  document.getElementById('message').style.color = 'green';
                                                                  document.getElementById('message').innerHTML = 'Passwords matched';
                                                                  document.getElementById('submit').disabled = false;
                                                              }
                                                            
                                                          } 
                                                          else {
                                                              document.getElementById('message').style.color = 'red';
                                                              document.getElementById('message').innerHTML = 'Passwords not matched';
                                                              document.getElementById('submit').disabled = true;
                                                          }
                                                      }
                                              </script>
                                                  <div class="field">
                                                      <label for="" class="label">First name</label>
                                                  </div>
                                                  <div class="control">
                                                      <input type="text" name="fname" value="<?=$userRow->fname?>" class="input is-link" required>
                                                  </div>
                                                  <div class="field">
                                                      <label for="" class="label">Middle name</label>
                                                  </div>
                                                  <div class="control">
                                                      <input type="text" name="mname"value="<?=$userRow->mname?>" class="input is-link" required>
                                                  </div>
                                                  <div class="field">
                                                      <label for="" class="label">Last name</label>
                                                  </div>
                                                  <div class="control">
                                                      <input type="text" name="lname" value="<?=$userRow->lname?>" class="input is-link" required>
                                                  </div>
                                                  <div class="field">
                                                      <label for="" class="label">Grade Level</label>
                                                  </div>
                                                  <div class="control">
                                                      <input type="number" maxlength="1" name="grade" value="<?=$userRow->grade?>" class="input is-link" required>
                                                  </div>
                                                  <div class="field">
                                                      <label for="" class="label">Section</label>
                                                  </div>
                                                  <div class="control">
                                                      <input type="text" name="Section" value="<?=$userRow->section?>" class="input is-link" required>
                                                  </div>
                                              </section>
                                              <footer class="modal-card-foot">
                                                  <button class="button is-success" id="submit"><i class="fa fa-refresh"></i> &nbsp; Update Administrator</button>
                                              </form>
                                                  <button class="button">Cancel</button>
                                              </footer>
                                      </div>
                              </div>
                                <a data-target="modal-trigger-delete<?=$userRow->user_id?>" class="button is-danger is-small modal-trigger"><i class="fa fa-trash"></i></a>
                                <div id= "modal-trigger-delete<?=$userRow->user_id?>" class="modal modal-fx-fadeInScale">
                                  <div class="modal-background"></div>
                                      <div class="modal-card modal-size">
                                              <header class="modal-card-head">
                                                  <p class="modal-card-title">Delete User?</p>
                                                  <button class="delete" aria-label="close"></button>
                                              </header>
                                              <section class="modal-card-body">
                                              <?=form_open('databasecontroller/delete_users')?>
                                                  <h2 class="subtitle">Are you sure to delete this user?</h2>
                                                  <input type="hidden" name="user_id" value="<?=$userRow->user_id?>">
                                                  <input type="hidden" name="user_type" value="<?=$userRow->user_type?>">
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
                            }
                          ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th><abbr title="Username">Username</abbr></th>
                          <th><abbr title="First Name">F.Name</abbr></th>
                          <th><abbr title="Middle Name">M.Name</abbr></th>
                          <th><abbr title="Last Name">L.Name</abbr></th>
                          <th><abbr title="Last Name">Grade</abbr></th>
                          <th><abbr title="Last Name">Section</abbr></th>
                          <th><abbr title="Last Name">Status</abbr></th>
                          <th><abbr title="Actions">Actn</abbr></th>
                        </tr>
                      </tfoot>
                  </table>
      </div>
    </div>
</div>
</body>
</html>