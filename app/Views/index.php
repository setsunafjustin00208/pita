<?php
    helper('form');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="design/css/all.css" type="text/css">
    <link rel="stylesheet" href="design/css/bulma.css" type="text/css">
    <link rel="stylesheet" href="design/css/animate.min.css" type="text/css">
    <script src="design/js/mine.js" type="text/javascript"></script>
    <script src="design/js/all.js" type="text/javascript"></script>
    <script src="design/js/jquery-3.6.0.js" type="text/javascript"></script>
    <script src="design/js/popper.min.js" type="text/javascript"></script>
    <script src="design/js/sweetalert2.min.js" type="text/javascript"></script>
</head>
<style>
    body, html
    {
        height: 100%;
    }

    .bg 
    {
        /* The image used */
        background-image: url("design/images/bg.jpg");

        /* Full height */
        height: 100%;

        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .modal-size
    {
        min-width: auto;
        max-width: 450px;
    }
   
</style>
<body class="bg">
    <nav class="navbar is-info" role="navigation" aria-label="main navigation">
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
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Functions to open and close a modal
            function openModal($el) {
                $el.classList.add('is-active');
            }

            function closeModal($el) {
                $el.classList.remove('is-active');
            }

            function closeAllModals() {
                (document.querySelectorAll('.modal') || []).forEach(($modal) => {
                closeModal($modal);
                });
            }

            // Add a click event on buttons to open a specific modal
            (document.querySelectorAll('.modal-trigger') || []).forEach(($trigger) => {
                const modal = $trigger.dataset.target;
                const $target = document.getElementById(modal);
                console.log($target);

                $trigger.addEventListener('click', () => {
                openModal($target);
                });
            });

            // Add a click event on various child elements to close the parent modal
            (document.querySelectorAll('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button') || []).forEach(($close) => {
                const $target = $close.closest('.modal');

                $close.addEventListener('click', () => {
                closeModal($target);
                });
            });

            // Add a keyboard event to close all modals
            document.addEventListener('keydown', (event) => {
                const e = event || window.event;

                if (e.keyCode === 27) { // Escape key
                closeAllModals();
                }
            });
            });
    </script>
        <div id= "modal-trigger" class="modal">
            <div class="modal-background animate__backInUp"></div>
                <div class="modal-card modal-size">
                        <header class="modal-card-head">
                            <p class="modal-card-title"><strong>Log-in</strong></p>
                            <button class="delete" aria-label="close"></button>
                        </header>
                        <section class="modal-card-body">
                        <?=form_open('DatabaseController/login')?>
                            <div class="field">
                                <label for="" class="label">Username</label>
                            </div>
                            <div class="control">
                                <input type="text" name="Username" placeholder="Enter Username" class="input is-link">
                            </div>
                            <div class="field">
                                <label for="" class="label">Password</label>
                                <div class="control">
                                    <input type="text" name="Password" placeholder="Enter Password" class="input is-link">
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
        <div id= "modal-trigger-2" class="modal">
            <div class="modal-background"></div>
                <div class="modal-card modal-size animate__backInUp">
                        <header class="modal-card-head">
                            <p class="modal-card-title">Sign-up</p>
                            <button class="delete" aria-label="close"></button>
                        </header>
                        <section class="modal-card-body">
                        <form action="">
                            <div class="field">
                                <label for="" class="label">Username</label>
                            </div>
                            <div class="control">
                                <input type="text" name="Username" placeholder="Enter Username" class="input is-link">
                            </div>
                            <div class="field">
                                <label for="" class="label">Username</label>
                            </div>
                            <div class="control">
                                <input type="text" name="Username" placeholder="Enter Username" class="input is-link">
                            </div>
                            <div class="field">
                                <label for="" class="label">Username</label>
                            </div>
                            <div class="control">
                                <input type="text" name="Username" placeholder="Enter Username" class="input is-link">
                            </div>
                            <div class="field">
                                <label for="" class="label">Username</label>
                            </div>
                            <div class="control">
                                <input type="text" name="Username" placeholder="Enter Username" class="input is-link">
                            </div>
                            <div class="field">
                                <label for="" class="label">Username</label>
                            </div>
                            <div class="control">
                                <input type="text" name="Username" placeholder="Enter Username" class="input is-link">
                            </div>
                        
                        </section>
                        <footer class="modal-card-foot">
                            <button class="button is-success">Register</button>
                        </form>
                            <button class="button">Cancel</button>
                        </footer>
                
                </div>
        </div>
</body>
</html>