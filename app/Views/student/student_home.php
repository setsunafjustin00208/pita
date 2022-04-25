<?php
    helper(['array','date','form','html','security','url']);
    $session = session();
    $loginverification = $session->get('logged_in');
    $usertype = $session->get('user_type');
    $status = $session->get('is_active');
    
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
            if($usertype == 'ADMIN')
            {
                header("Location:".site_url('/views/view_admin'));
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
    <script src="<?=base_url('/design/js/mine.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/all.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/jquery-3.6.0.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/popper.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/modal-fx.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/sweetalert2.all.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('/design/js/acorn_interpreter.js')?>"></script>
    <script src="<?=base_url('/design/js/blockly_compressed.js')?>"></script>
    <script src="<?=base_url('/design/js/blocks_compressed.js')?>"></script>
    <script src="<?=base_url('/design/js/javascript_compressed.js')?>"></script>
    <script src="<?=base_url('/design/js/msg/js/en.js')?>"></script>
    <script src="<?=base_url('/design/js/wait_block.js')?>"></script>
    <title>Student</title>
    <style>
    body {
      background-color: #fff;
      font-family: sans-serif;
    }
    h1 {
      font-weight: normal;
      font-size: 140%;
    }
    // html, body, #app {
    //   height: 100%;
    // }
    // #app {
    //   min-height: 100%;
    //   //display: flex;
    //   //flex-direction: column;
    // }
    // .main-content {
    //   //flex: 1;
    // }
    // .footer {
    //   margin-top: -12px;
    // }
    @media screen and (max-width: 768px) {
    #menu-toggle:checked + .nav-menu {
        display: block;
    }
    }
  </style>
</head>
<body>
<nav class="navbar is-link" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="https://bulma.io">
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
        Home
      </a>

      <a class="navbar-item">
        Documentation
      </a>
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
      <div class="navbar-item has-dropdown is-hoverable ">
        <a class="navbar-link">
          <i class="fa fa-user"></i>
        </a>
        <div class="navbar-dropdown is-right">
          <a class="navbar-item">
            About
          </a>
          <a class="navbar-item">
            Jobs
          </a>
          <a class="navbar-item">
            Contact
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
<div class="container columns">
    <div class="column is-2 box mt-3 ml-2">
    <aside class="menu">
            <p class="menu-label">
                General
            </p>
            <ul class="menu-list">
                <li><a>Dashboard</a></li>
                <li><a>Customers</a></li>
            </ul>
            <p class="menu-label">
                Administration
            </p>
            <ul class="menu-list">
                <li><a>Team Settings</a></li>
                <li>
                <a class="is-active">Manage Your Team</a>
                <ul>
                    <li><a>Members</a></li>
                    <li><a>Plugins</a></li>
                    <li><a>Add a member</a></li>
                </ul>
                </li>
                <li><a>Invitations</a></li>
                <li><a>Cloud Storage Environment Settings</a></li>
                <li><a>Authentication</a></li>
            </ul>
            <p class="menu-label">
                Transactions
            </p>
            <ul class="menu-list">
                <li><a>Payments</a></li>
                <li><a>Transfers</a></li>
                <li><a>Balance</a></li>
            </ul>
        </aside>
    </div>
    <div class="column is-10 box ml-2 is-fullheight-with-navbar">
        <p>
            <button class="button is-link p-3 m-3" onclick="runCode()" id="runButton">Run Program</button>
        </p>

    <div class="" style="width: 100%">
        <div id="blocklyDiv"
            style="display: inline-block; height: 480px; width: 68%"></div>
        <textarea id="output" disabled="disabled"
            style="display: inline-block; height: 480px; width: 30%;">
        </textarea>
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
        <block type="controls_whileUntil"></block>
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
        var demoWorkspace = Blockly.inject('blocklyDiv',
            {media: '<?=base_url('design/media/')?>',
            toolbox: document.getElementById('toolbox')});
        Blockly.Xml.domToWorkspace(document.getElementById('startBlocks'),
                                demoWorkspace);

        // Exit is used to signal the end of a script.
        Blockly.JavaScript.addReservedWords('exit');

        var outputArea = document.getElementById('output');
        var runButton = document.getElementById('runButton');
        var myInterpreter = null;
        var runner;

        function initApi(interpreter, globalObject) {
        // Add an API function for the alert() block, generated for "text_print" blocks.
        var wrapper = function(text) {
            text = text ? text.toString() : '';
            outputArea.value = outputArea.value + '\n' + text;
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

        function highlightBlock(id) {
        demoWorkspace.highlightBlock(id);
        highlightPause = true;
        }

        function resetStepUi(clearOutput) {
        demoWorkspace.highlightBlock(null);
        highlightPause = false;
        runButton.disabled = '';

        if (clearOutput) {
            outputArea.value = 'Program output:\n=================';
        }
        }

        function generateCodeAndLoadIntoInterpreter() {
        // Generate JavaScript code and parse it.
        Blockly.JavaScript.STATEMENT_PREFIX = 'highlightBlock(%1);\n';
        Blockly.JavaScript.addReservedWords('highlightBlock');
        latestCode = Blockly.JavaScript.workspaceToCode(demoWorkspace);

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

            // And then show generated code in an alert.
            // In a timeout to allow the outputArea.value to reset first.
            setTimeout(function() {
                Swal.fire('Ready to execute the following code?\n',
                latestCode, 'question');

            // Begin execution
            highlightPause = false;
            myInterpreter = new Interpreter(latestCode, initApi);
            runner = function() {
                if (myInterpreter) {
                var hasMore = myInterpreter.run();
                if (hasMore) {
                    // Execution is currently blocked by some async call.
                    // Try again later.
                    setTimeout(runner, 10);
                } else {
                    // Program is complete.
                    outputArea.value += '\n\n<< Program complete >>';
                    resetInterpreter();
                    resetStepUi(false);
                }
                }
            };
            runner();
            }, 1);
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