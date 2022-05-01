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
              Activities
          </p>
          <p class="subtitle">
            Create and manage activities for your Students
          </p>
        </div>
      </section>
    <div class="container box">
        <div class="buttons">
          <a data-target="modal-trigger" class="button is-link modal-trigger"><i class="fa fa-tasks"></i> &nbsp; Create Activity</a>
          <div id= "modal-trigger" class="modal modal-fx-fadeInScale">
                          <div class="modal-background"></div>
                            <div class="modal-card modal-size">
                              <header class="modal-card-head">
                                <p class="modal-card-title">Create Activity</p>
                                  <button class="delete" aria-label="close"></button>
                              </header>
                              <section class="modal-card-body">
                                <?=form_open('databasecontroller/create_activity')?>
                                  <input type="hidden" name="date_created" value="<?=date("y_m_d H:i:s")?>">
                                  <input type="hidden" name="date_modified" value="<?=date("y_m_d H:i:s")?>">
                                  <input type="hidden" name="grade" value="<?=$session->get('grade')?>">
                                  <input type="hidden" name="section" value="<?=$session->get('section')?>">
                                  <input type="hidden" name="teacher_id" value="<?=$session->get('user_id')?>">
                                  <div class="field">
                                     <label for="" class="label">Activity Title</label>
                                  </div>
                                  <div class="control mb-5">
                                    <input type="text" name="activity_title" placeholder="Title" class="input is-link">
                                  </div>
                                  <div class="field">
                                     <label for="" class="label">Activity Instructions</label>
                                  </div>
                                  <div class="control is-large">
                                    <textarea class="textarea is-link has-fixed-size" name="activity_details" placeholder="Instructions"></textarea>
                                  </div>
                                  <div class="field">
                                     <label for="" class="label">Activity Title</label>
                                  </div>
                                  <div class="control mb-5">
                                    <input type="text" name="activity_output" placeholder="Output" class="input is-link">
                                  </div>
                                  <div class="field">
                                     <label for="" class="label">Activity Score</label>
                                  </div>
                                  <div class="control mb-5">
                                    <input type="text" name="activity_score" placeholder="Score" class="input is-link">
                                  </div>
                                <footer class="modal-card-foot">
                                  <button class="button is-success" id="submit"><i class="fa fa-plus"></i> &nbsp; Add</button>
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
                          <th><abbr title="Activity_title">ActTitle</abbr></th>
                          <th><abbr title="Activity_details">ActBdy</abbr></th>
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
                  <td>
                  <div class="buttons">
                    <a data-target="modal-trigger-edit<?=$activityRow->activity_id?>" class="button is-success is-small modal-trigger"><i class="fa fa-edit"></i></a>
                      <div id= "modal-trigger-edit<?=$activityRow->activity_id?>" class="modal modal-fx-fadeInScale">
                          <div class="modal-background"></div>
                            <div class="modal-card modal-size">
                              <header class="modal-card-head">
                                <p class="modal-card-title">Edit Activity</p>
                                  <button class="delete" aria-label="close"></button>
                              </header>
                              <section class="modal-card-body">
                              <?=form_open('databasecontroller/update_activity')?>
                                  <input type="hidden" name="date_modified" value="<?=date("y_m_d H:i:s")?>">
                                  <input type="hidden" name="grade" value="<?=$session->get('grade')?>">
                                  <input type="hidden" name="section" value="<?=$session->get('section')?>">
                                  <input type="hidden" name="teacher_id" value="<?=$session->get('user_id')?>">
                                  <input type="hidden" name="activity_id" value="<?=$activityRow->activity_id?>">
                                  <div class="field">
                                     <label for="" class="label">Activity Title</label>
                                  </div>
                                  <div class="control mb-5">
                                    <input type="text" name="activity_title" value="<?=$activityRow->activity_title?>" class="input is-link">
                                  </div>
                                  <div class="field">
                                     <label for="" class="label">Activity Instructions</label>
                                  </div>
                                  <div class="control is-large">
                                    <textarea class="textarea is-link has-fixed-size" name="activity_details"><?=$activityRow->activity_details?></textarea>
                                  </div>
                                  <div class="field">
                                     <label for="" class="label">Activity output</label>
                                  </div>
                                  <div class="control mb-5">
                                    <input type="text" name="activity_output" value="<?=$activityRow->activity_output?>" class="input is-link">
                                  </div>
                                  <div class="field">
                                     <label for="" class="label">Activity Score</label>
                                  </div>
                                  <div class="control mb-5">
                                    <input type="text" name="activity_score" value="<?=$activityRow->activity_score?>" class="input is-link">
                                  </div>
                                <footer class="modal-card-foot">
                                  <button class="button is-success" id="submit"><i class="fa fa-refresh"></i> &nbsp; Update Activity</button>
                                </form>
                                  <button class="button">Cancel</button>
                                </footer>
                              </div>
                        </div>
                        <a data-target="modal-trigger-delete<?=$activityRow->activity_id?>" class="button is-danger is-small modal-trigger"><i class="fa fa-trash"></i></a>
                          <div id= "modal-trigger-delete<?=$activityRow->activity_id?>" class="modal modal-fx-fadeInScale">
                            <div class="modal-background"></div>
                                <div class="modal-card modal-size">
                                        <header class="modal-card-head">
                                            <p class="modal-card-title">Delete Activity?</p>
                                            <button class="delete" aria-label="close"></button>
                                        </header>
                                        <section class="modal-card-body">
                                        <?=form_open('databasecontroller/delete_activity')?>
                                            <h2 class="subtitle">Are you sure to delete this Announcement?</h2>
                                            <input type="hidden" name="activity_id" value="<?=$activityRow->activity_id?>">
                                        </section>
                                        <footer class="modal-card-foot">
                                            <button class="button is-danger is-small"><i class="fa fa-check"></i> &nbsp;Yes</button>
                                        </form>
                                            <button class="button is-link is-small"><i class="fa fa-cancel"></i>&nbsp; No</button>
                                        </footer>
                                </div>
                              </div>
                              <a href="<?=site_url('/views/teacher_activity_results')?>/<?=$activityRow->activity_id?>" class="button is-link is-small"><i class="fa fa-eye"></i></a>
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