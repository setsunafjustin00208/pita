<?php
    helper(['array','date','form','html','security','url']);
    $session = session();
    $loginverification = $session->get('logged_in');
    $usertype = $session->get('user_type');
    if($loginverification) 
    {
        if($usertype == 'ADMIN')
        {
            header('Location:'.site_url('views/view_admin'));
            exit();
        }
        else if ($usertype == 'TEACHER')
        {
            header('Location:'.site_url('views/view_teacher'));
            exit();
        }
        else if ($usertype == 'STUDENT')
        {
            header('Location:'.site_url('views/view_student'));
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
    <title>Welcome</title>
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
</head>
<style>
    body, html
    {
        height: 100%;
    }

    .bg 
    {
        /* The image used */
        background-image: url("<?=base_url('/design/images/bg.gif')?>");

        /* Full height */
        height: 100%;

        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        overflow: auto;
    }
    .modal-size
    {
        min-width: auto;
        max-width: 450px;
    }
   
</style>
<script>
    
</script>
<body class="bg">
    <nav class="navbar is-info" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item">
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
            <a href="<?=base_url()?>" class="navbar-item">
                Home
            </a>

            <a data-target="about" class="navbar-item">
                About
            </a>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                More
                </a>

                <div class="navbar-dropdown">
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
                <a class="navbar-item">
                    Report an issue
                </a>
                </div>
            </div>
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <a data-target="modal-trigger-2" class="button is-primary modal-trigger">
                            <strong>Sign up</strong>
                        </a>
                        <a data-target="modal-trigger" class="button is-link modal-trigger">
                            Log in
                        </a>
                       <!-- <a href="<?=site_url('databasecontroller/email_test')?>" class="button is-link modal-trigger">
                            Test email
                        </a> -->
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
 <div id= "modal-trigger" class="modal modal-fx-fadeInScale">
            <div class="modal-background"></div>
                <div class="modal-card modal-size">
                        <header class="modal-card-head">
                            <p class="modal-card-title"><strong>Log-in</strong></p>
                            <button class="delete" aria-label="close"></button>
                        </header>
                        <section class="modal-card-body">
                        <?=form_open('databasecontroller/login')?>
                            <div class="field">
                                <label for="" class="label">Email</label>
                            </div>
                            <div class="control">
                                <input type="email" name="email" placeholder="Ente email" class="input is-link">
                            </div>
                            <div class="field">
                                <label for="" class="label">Password</label>
                                <div class="control">
                                    <input type="password" name="Password" placeholder="Enter Password" class="input is-link">
                                </div>
                            </div>
                        </section>
                        <footer class="modal-card-foot">
                            <button class="button is-link">Log-In</button>
                        </form>
                            <button class="button is-danger">Cancel</button>
                        </footer>
                </div>
        </div>
        <div id= "modal-trigger-2" class="modal modal-fx-fadeInScale">
            <div class="modal-background"></div>
                <div class="modal-card modal-size">
                        <header class="modal-card-head">
                            <p class="modal-card-title">Sign-up</p>
                            <button class="delete" aria-label="close"></button>
                        </header>
                        <section class="modal-card-body">
                        <?=form_open('databasecontroller/sign_up')?>
                        <input type="hidden" name="date_created" value="<?=date("y_m_d H:i:s")?>">
                        <input type="hidden" name="date_modified" value="<?=date("y_m_d H:i:s")?>">
                        <input type="hidden" name="is_active" value="DISABLED">
                        <input type="hidden" name="verification" value="<?=rand(10000,99999)?>">
                        <input type="hidden" name="user_type" value="STUDENT">
                        <input type="hidden" name="grade" value="0">
                        <input type="hidden" name="section" value="TBA">
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
                                <input type="text" name="lname" placeholder="Enter Last name" class="input is-link" required>
                            </div>
                        </section>
                        <footer class="modal-card-foot">
                            <button class="button is-success" id="submit">Register</button>
                        </form>
                            <button class="button">Cancel</button>
                        </footer>
                </div>
        </div>
        <div class="container mb-6">
        <div class="container content has-background-light box p-3 mt-5 are-large animate__animated animate__backInUp">
            <section class="hero is-link is-small box animate__animated animate__backInLeft animate__delay-1s">
                <div id="about" class="hero-body">
                    <div class="columns">
                      <div class="column is-2 animate__animated animate__bounceIn animate__delay-2s">
                            <figure class="image is-128x128">
                                <i><img src="<?=base_url('/design/images/PITA.png')?>" width="1280" height="1280"></i>
                            </figure>
                      </div>
                      <div class="column animate__animated animate__bounceInDown animate__delay-2s">
                        <p class="title pt-6">
                            Welcome To PITA
                        </p>
                      </div>
                    </div>
                    <p class="subtitle box has-background-info animate__animated animate__bounceInUp animate__delay-3s">
                        The <u>Program-Block Interface for Teaching Application</u> is a Web based block by block programming interface with activities given by the teacher for further understanding how to code. In a Visual way!
                    </p>
                
                </div>
                </section>
            <div class="content box animate__animated animate__backInRight animate__delay-1s">
                <h2>ANNOUNCEMENT:</h2>
                <?php
                        $announcement_builder = db_connect()->table('announcements');
                        $announcement_builder->orderBy('a_id','DESC');
                        $announcement_builder->limit(1);
                        $announcement = $announcement_builder->get();
                        $announcementRow = $announcement->getRow();
                        
                        if(isset($announcementRow))
                        {
                ?>
                <h3><?=$announcementRow->announcement_title?></h3>
                <p>
                    <?=nl2br($announcementRow->announcement_details)?>
                </p>
                <?php
                        }
                ?>
            </div>
            
            
        </div>
        <div class="container has-background-light p-3 box animate__animated animate__backInUp animate__delay-1s">
            <h1 class="title animate__animated animate__backInLeft animate__delay-2s"><strong>Try It:</strong> </h1>
                <div class="buttons animate__animated animate__backInUp animate__delay-2s">
                    <button class="button is-link p-3 m-3" onclick="runCode()" id="runButton"><i class="fa-solid fa-terminal"></i> &nbsp; Run Program</button>
                </div>
                <div class="columns animate__animated animate__backInUp animate__delay-3s" style="width: 100%">
                    <div class="column" id="blocklyDiv"
                        style="display: inline-block; height: 480px; width: 68%"></div>
                    <div class="column animate__animated animate__backInUp animate__delay-4s">
                    <textarea name="a_output" id="output"
                        style="display: inline-block; height: 455px;" readonly class="textarea has-fixed-size has-text-black is-link">
                    </textarea>
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
                        {media: '<?=base_url()?>/design/media/',
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
                        outputArea.value = 'Program output:\n=================\n';
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
        <footer class="footer">
        <div class="content has-text-centered">
            <p>
            <strong>PITA</strong> by <a href="https://github.com/setsunafjustin00208">Justin Ed Pierre Cabrales Tecson</a>. The source code is licensed
            <a href="http://opensource.org/licenses/mit-license.php">MIT</a>. The website content
            is licensed <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC BY NC SA 4.0</a>.
            </p>
        </div>
        </footer>
</body>
</html>