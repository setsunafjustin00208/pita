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

      $actvity_verification = db_connect()->table('scores');
      $ver =  $actvity_verification->getWhere(['student_id'=>$session->get('user_id'),'activity_id' => $_SESSION['act_id']]);
      $rowscore = $ver->getRow();
      if(isset($rowscore))
      {
        header("Location:".site_url('/views/student_activity'));
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
    <link rel="stylesheet" href="<?=base_url('/design/css/codemirror.css')?>" type="text/css">
    <link rel="stylesheet" href="<?=base_url('/design/css/theme/ayu-dark.css')?>" type="text/css">
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
    <script src="<?=base_url('/design/js/python_compressed.js')?>"></script>
    <script src="<?=base_url('/design/js/javascript_compressed.js')?>"></script>
    <script src="<?=base_url('/design/js/msg/js/en.js')?>"></script>
    <script src="<?=base_url('/design/js/wait_block.js')?>"></script>
    <script src="<?=base_url('/design/js/storage.js')?>"></script>
    <script src="<?=base_url('/design/js/codemirror.js')?>"></script>
    <script src="<?=base_url('/design/js/mode/python/python.js')?>"></script>
    <title>Hello&nbsp;<?=session()->get('fname')?></title>
</head>
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
                <li><a class="is-active" href="<?=site_url('/views/student_activity')?>">Activities</a></li>
                
            </ul>
        </aside>
    </div>
    <div class="column container p-4 mt-3">
    <div class="buttons columns">
        <div class="column is-9">
         <button class="button is-link p-3 m-3 mt-6" onclick="runCode()" id="runButton"><i class="fa fa-terminal" aria-hidden="true"></i>&nbsp; Run Program</button>
         <button class="button is-success p-3 m-3 mt-6 modal-trigger" data-target="instructions"><i class="fa-solid fa-diamond-turn-right"></i> &nbsp; View Instructions</button>
         <div class="modal" id="instructions">
          <div class="modal-background"></div>
          <div class="modal-card">
            <header class="modal-card-head">
              <p class="modal-card-title">Instructions</p>
              <button class="delete" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
              <div class="container mb-4 box">
                <h1 class="subtitle">1. Hover mouse to the block category</h1>
                <figure class="image">
                    <img src="<?=base_url('/design/images/documentation.png')?>">
                </figure>
              </div>
              <div class="container mb-4 box">
              <h1 class="subtitle">2. Choose a block</h1>
                <figure class="image">
                    <img src="<?=base_url('/design/images/documentation2.png')?>">
                </figure>
              </div>
              <div class="container mb-4 box">
              <h1 class="subtitle">3. Press a block and drag it into the empty space</h1>
                <figure class="image">
                    <img src="<?=base_url('/design/images/documentation3.png')?>">
                </figure>
              </div>
              <div class="container mb-4 box">
              <h1 class="subtitle">5. Put the blocks together</h1>
                <figure class="image">
                    <img src="<?=base_url('/design/images/documentation4.png')?>">
                </figure>
              </div>
              <div class="container mb-4 box">
              <h1 class="subtitle">6. Press the 'Run program' Button</h1>
                <figure class="image">
                    <img src="<?=base_url('/design/images/documentation5.png')?>">
                </figure>
              </div>
            </section>
            <footer class="modal-card-foot">
              <button class="button">Cancel</button>
            </footer>
          </div>
        </div>
        </div>
        <div class="column">
        <?=form_open_multipart('filecontroller/validate_output')?>
        <input type="hidden"  name="activity_id" value="<?=$_SESSION['act_id']?>">
        <input type="hidden"  name="teacher_id" value="<?=$_SESSION['teacher_id']?>">
        <input type="hidden"  name="student_id" value="<?=$session->get('user_id')?>">
        <input type="hidden"  name="grade" value="<?=$session->get('grade')?>">
        <input type="hidden"  name="section" value="<?=$session->get('section')?>">
          <div id="file-js-example" class="file has-name is-small is-boxed ml-4 pr-3">
                  <label class="file-label">
                    <input class="file-input" type="file" name="userfile2" required>
                    <span class="file-cta">
                      <span class="file-icon">
                        <i class="fas fa-upload"></i>
                      </span>
                      <span class="file-label">
                        Upload code (scrsht)
                      </span>
                    </span>
                    <span class="file-name">
                      No file uploaded
                    </span>
                  </label>
          </div>
          <script>
            const fileInput = document.querySelector('#file-js-example input[type=file]');
            fileInput.onchange = () => {
              if (fileInput.files.length > 0) {
                const fileName = document.querySelector('#file-js-example .file-name');
                fileName.textContent = fileInput.files[0].name;
                    }
            }
          </script>
          <button class="button is-success p-3 mt-5 ml-5"><i class="fa-solid fa-file-code"></i> &nbsp;  Submit Output</button>
        </div>
    </div>
    <div class="columns" style="width: 100%">
        <div class="column is-4" id="blocklyDiv"
            style="display: inline-block; height: 590px; width: 68%"><h1 class="subtitle mb-5">Intergrated Development Environment</h1></div>
        <div class="column">
        <h1 class="subtitle mb-5">Code Output</h1>
        <textarea name="a_output" id="output"
            style="display: inline-block; height: 200px;" readonly class="textarea has-fixed-size has-text-black is-link">
        </textarea>
        </form>
        <h1 class="subtitle mb-5 mt-4"><i class="fa-brands fa-python"></i> &nbsp;Code In Python</h1>
        <textarea name="" id="code" style="display: inline-block; height: auto;" readonly class="textarea has-fixed-size has-text-black is-link"></textarea>
        </div>
    </div>
    

    <xml xmlns="https://developers.google.com/blockly/xml" id="toolbox" style="display: none">
        <category name="Logic" colour="%{BKY_LOGIC_HUE}">
        <block type="controls_if"></block>
        <block type="logic_compare"></block>
        <block type="logic_operation"></block>
        <block type="logic_negate"></block>
        <block type="logic_boolean"></block>
        </category>
        <category name="Loops" colour="%{BKY_LOOPS_HUE}">
        <block type="controls_repeat_ext">
            <value name="TIMES">
            <block type="math_number">
                <field name="NUM">10</field>
            </block>
            </value>
        </block>
        <!--<block type="controls_whileUntil"></block>-->
        </category>
        <category name="Math" colour="%{BKY_MATH_HUE}">
        <block type="math_number">
            <field name="NUM">123</field>
        </block>
        <block type="math_arithmetic"></block>
        <block type="math_single"></block>
        </category>
        <category name="Text" colour="%{BKY_TEXTS_HUE}">
        <block type="text"></block>
        <block type="text_length"></block>
        <block type="text_print"></block>
        <block type="text_prompt_ext">
            <value name="TEXT">
            <block type="text"></block>
            </value>
        </block>
        </category>
        <sep></sep>
        <category name="Variables" custom="VARIABLE" colour="%{BKY_VARIABLES_HUE}">
        </category>
        
    </xml>

    <xml xmlns="https://developers.google.com/blockly/xml" id="startBlocks" style="display: none">
        
    </xml>

    <script>
       var editor = CodeMirror.fromTextArea(document.getElementById('code'), {
                    lineNumbers: true,
                    mode: 'text/x-python',
                    theme: 'ayu-dark',
                    readOnly: true,
        }); 
        var demoWorkspace = Blockly.inject('blocklyDiv',
            {media: '<?=base_url()?>/design/media/',
            toolbox: document.getElementById('toolbox')});
        Blockly.Xml.domToWorkspace(document.getElementById('startBlocks'),
                                demoWorkspace);

            
        // Exit is used to signal the end of a script.
        setTimeout(BlocklyStorage.restoreBlocks, 0);
        BlocklyStorage.backupOnUnload();
        Blockly.JavaScript.addReservedWords('exit');

        var outputArea = document.getElementById('output');
        var runButton = document.getElementById('runButton');
        var myInterpreter = null;
        var runner;

        function initApi(interpreter, globalObject) {
        // Add an API function for the alert() block, generated for "text_print" blocks.
        var wrapper = function(text) {
            text = text ? text.toString() : '';
            outputArea.value = outputArea.value + text + '\n';
        };
        interpreter.setProperty(globalObject, 'alert',
            interpreter.createNativeFunction(wrapper));

        // Add an API function for the prompt() block.
        var wrapper = function(text) {
            text = text ? text.toString() : '';
            return interpreter.createPrimitive(prompt(text));
        };
        interpreter.setProperty(globalObject, 'prompt',
            interpreter.createNativeFunction(wrapper));

        // Add an API for the wait block.  See wait_block.js
        initInterpreterWaitForSeconds(interpreter, globalObject);

        // Add an API function for highlighting blocks.
        var wrapper = function(id) {
            id = id ? id.toString() : '';
            return interpreter.createPrimitive(highlightBlock(id));
        };
        interpreter.setProperty(globalObject, 'highlightBlock',
            interpreter.createNativeFunction(wrapper));
        }

        var highlightPause = false;
        var latestCode = '';
        var latestCodePython = '';

        function highlightBlock(id) {
        demoWorkspace.highlightBlock(id);
        highlightPause = true;
        }

        function resetStepUi(clearOutput) {
        demoWorkspace.highlightBlock(null);
        highlightPause = false;
        runButton.disabled = '';

        if (clearOutput) {
            outputArea.value = '';
        }
        }

        function generateCodeAndLoadIntoInterpreter() {
        // Generate JavaScript code and parse it.
        Blockly.JavaScript.STATEMENT_PREFIX = 'highlightBlock(%1);\n';
        Blockly.JavaScript.addReservedWords('highlightBlock');
        latestCode = Blockly.JavaScript.workspaceToCode(demoWorkspace);
        latestCodePython = Blockly.Python.workspaceToCode(demoWorkspace);
        
        resetStepUi(true);
        }

        function resetInterpreter() {
        myInterpreter = null;
          if (runner) {
              clearTimeout(runner);
              runner = null;
          }
        }

        function runCode() {
        if (!myInterpreter) {
            // First statement of this code.
            // Clear the program output.
            resetStepUi(true);
            runButton.disabled = 'disabled';

             // Begin execution
             highlightPause = false;
            myInterpreter = new Interpreter(latestCode, initApi);
            runner = function() {
                if (myInterpreter) {
                var hasMore = myInterpreter.run();
                if (hasMore) {
                    // Execution is currently blocked by some async call.
                    // Try again later.
                    setTimeout(runner, 5);
                    outputArea.value = 'Error';
                    
                } else {
                    // Program is complete.
                    editor.setValue(latestCodePython);
                    resetInterpreter();
                    resetStepUi(false);
                 }
                }
            };
            runner();

            // And then show generated code in an alert.
            // In a timeout to allow the outputArea.value to reset first.
            /*setTimeout(function() {
                alert('Ready to execute the following code\n' +
            '===================================\n' +
            latestCode);

            // Begin execution
            highlightPause = false;
            myInterpreter = new Interpreter(latestCode, initApi);
            runner = function() {
                if (myInterpreter) {
                var hasMore = myInterpreter.run();
                if (hasMore) {
                    // Execution is currently blocked by some async call.
                    // Try again later.
                    setTimeout(runner, 5);
                    outputArea.value = 'Error';
                    
                } else {
                    // Program is complete.
                    resetInterpreter();
                    resetStepUi(false);
                 }
                }
            };
            runner();
            }, 1); */
            return;
          }
        }

        // Load the interpreter now, and upon future changes.
        generateCodeAndLoadIntoInterpreter();
        demoWorkspace.addChangeListener(function(event) {
        if (!(event instanceof Blockly.Events.Ui)) {
            // Something changed. Parser needs to be reloaded.
            resetInterpreter();
            generateCodeAndLoadIntoInterpreter();
            
        }
        });
    </script>
    </div>
</div>
</body>
</html>