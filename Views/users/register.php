<?php
if (isset($_POST['registerBTN'])) {
    require_once '../../Controllers/users/registerLoginControl.php';
    $user_id = $_POST['user_id'];
    $user_name = addslashes($_POST['username']);
    $password_new = $_POST['password'];
    $email = addslashes($_POST['email']);
    if (strcmp($_POST['confirm_password'], $_POST['password']) === 0) {
        /////////// Passwords Confirmation -> 0 is ok, 1 is not the same
        if (filter_has_var(INPUT_POST, 'email')) {
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                /////////// Email Format Is Ok
                if (filter_has_var(INPUT_POST, 'username')) {
                    $user_name = filter_var($user_name, FILTER_SANITIZE_STRING);
                    $usernameCheck = checkIfUsernameExists($user_name);
                    if (!$usernameCheck->num_rows > 0) {
                        /////////// Username Is Not Exist In Our Database USER IS OK
                        $emailCheck = checkIfEmailExists($email);
                        if (!$emailCheck->num_rows > 0) {
                            /////////// Email Is Not Exist In Our Database EMAIL IS OK
                            $message = createNewUser($user_id, $user_name, $password_new, $email);
                            if ($message == "User Has Created Successfully.") {
                                /////// Success USER HAVE BEEN CREATED!!! ////////// Success USER HAVE BEEN CREATED!!! ////////// Success USER HAVE BEEN CREATED!!! ////////// Success USER HAVE BEEN CREATED!!! //////////
                                echo '<div class="success-msg">';
                                echo '<h3>' . $message . '</h3>';
                                echo '</div>';
                                /////// Success USER HAVE BEEN CREATED!!! ////////// Success USER HAVE BEEN CREATED!!! ////////// Success USER HAVE BEEN CREATED!!! ////////// Success USER HAVE BEEN CREATED!!! //////////
                            }
                        } else {
                            /////////// Email Is Already Exists
                            echo '<div class="error-msg">';
                            echo '<h3>Email Is Already Exists.</h3>';
                            echo '</div>';
                        }
                    } else {
                        /////////// Username Is Already Exists
                        echo '<div class="error-msg">';
                        echo '<h3>Username Is Already Exists.</h3>';
                        echo '</div>';
                    }
                }
            } else {
                /////////// Email Input Is Probably Not An Email
                echo '<div class="error-msg">';
                echo '<h3>Email Format is invalid.</h3>';
                echo '</div>';
            }
        }
    } else {
        /////////// Passwords Confirmation Failed
        echo '<div class="error-msg">';
        echo '<h3>Passwords Are Not The Same. Please Fix it.</h3>';
        echo '</div>';
    }
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <!--jQuery-->
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script> 
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>


        <style>
            body, html{
                height: 100%;
                background-repeat: no-repeat;
                background-color: #f4f4f4;
                font-family: 'Oxygen', sans-serif;
            }

            .main{
                margin-top: 70px;
            }

            h1.title { 
                font-size: 50px;
                font-family: 'Passion One', cursive; 
                font-weight: 400; 
            }

            hr{
                width: 10%;
                color: #fff;
            }

            .form-group{
                margin-bottom: 15px;
            }

            label{
                margin-bottom: 15px;
            }

            input,
            input::-webkit-input-placeholder {
                font-size: 11px;
                padding-top: 3px;
            }

            .main-login{
                background-color: #fff;
                /* shadows and rounded borders */
                -moz-border-radius: 2px;
                -webkit-border-radius: 2px;
                border-radius: 2px;
                -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);

            }

            .main-center{
                margin-top: 30px;
                margin: 0 auto;
                max-width: 330px;
                padding: 40px 40px;

            }

            .login-button{
                margin-top: 5px;
            }

            .login-register{
                font-size: 15px;
                text-align: center;
            }
            .error-msg{
                border:1px solid darkred;
                background-color: #ff6666;
                text-align: center;
            }
            .success-msg{
                border:1px solid darkgreen;
                background-color: #66ff66;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <?php
        if (isset($_SERVER['REQUEST_METHOD']) == "GET") {
            ?>

            <div class="container">
                <div class="row main">
                    <div class="panel-heading">
                        <div class="panel-title text-center">
                            <h1 class="title">Booka Register</h1>
                            <hr />
                        </div>
                    </div> 
                    <div class="main-login main-center">
                        <form class="form-horizontal" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                            <div class="form-group">
                                <label for="email" class="cols-sm-2 control-label">Your Email</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="email" autocomplete="email" id="email"  placeholder="Enter your Email" autofocus required="required" maxlength="40"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="username" class="cols-sm-2 control-label">Username</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" autocomplete="username" name="username" id="username"  placeholder="Enter your Username" required="required" maxlength="16"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="cols-sm-2 control-label">Password</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                        <input type="password" class="form-control" autocomplete="new-password" name="password" id="password"  placeholder="Enter your Password" required="required" maxlength="24"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                        <input type="password" class="form-control" autocomplete="new-password" name="confirm_password" id="confirm"  placeholder="Confirm your Password" required="required" maxlength="24"/>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="user_id" value=""/>
                            <div class="form-group ">
                                <button type="submit" name="registerBTN" class="btn btn-primary btn-lg btn-block login-button">Register</button>
                            </div>
                            <div class="login-register">
                                <a href="../../index.php">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php
        } elseif (isset($_SERVER['REQUEST_METHOD']) == "POST") {
            ?>
            <div class="container">
                <div class="row main">
                    <div class="panel-heading">
                        <div class="panel-title text-center">
                            <h1 class="title">Booka Register</h1>
                            <hr />
                        </div>
                    </div> 
                    <div class="main-login main-center">
                        <form class="form-horizontal" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                            <div class="form-group">
                                <label for="email" class="cols-sm-2 control-label">Your Email</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="email" autocomplete="email" id="email"  placeholder="Enter your Email" autofocus required="required" maxlength="40"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="username" class="cols-sm-2 control-label">Username</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" autocomplete="username" name="username" id="username"  placeholder="Enter your Username" required="required" maxlength="16"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="cols-sm-2 control-label">Password</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                        <input type="password" class="form-control" autocomplete="new-password" name="password" id="password"  placeholder="Enter your Password" required="required" maxlength="24"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                        <input type="password" class="form-control" autocomplete="new-password" name="confirm_password" id="confirm"  placeholder="Confirm your Password" required="required" maxlength="24"/>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="user_id" value=""/>
                            <div class="form-group ">
                                <button type="submit" name="registerBTN" class="btn btn-primary btn-lg btn-block login-button">Register</button>
                            </div>
                            <div class="login-register">
                                <a href="../../index.php">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </body>
</html>
