<?php
session_start();
//////// Create Schema book_store + books table + users table
require_once 'DB_book_store/schemaCreation.php';
////////
if (isset($_POST['loginBTN'])) {
    require_once 'Controllers/users/registerLoginControl.php';
    $user__name = addslashes($_POST['username']);
    $password_now = addslashes($_POST['password']);
    $stringIfExists = checkIfMatch($user__name, $password_now);
    if ($stringIfExists == 'Not Exists') {
        /////////// Password Or Username are Invalid
        echo '<div class="error-msg">';
        echo '<h3>Password Or Username are Invalid.</h3>';
        echo '</div>';
    } else {
        $currentUser = getUser($user__name, $password_now);
        $_SESSION['current_user'] = $currentUser;
        header('location: Views/books/home__R_U_D.php');
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
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> 
    </head>
    <style>
        body{
            height:100vh;
            background-color: #f4f4f4;
        }
        .login{
            font-family: 'Josefin Sans', sans-serif;
            background: #f4f4f4; 
            padding:70px 0px;
        }

        h1{
            font-weight:600;
            font-family: 'Josefin Sans', sans-serif;
            text-transform:capitalize;
            text-align:center;
            color:#FFF;
            background:#72d6f5;
            padding:25px 0px;
        }

        form{
            padding:80px;
        }

        .inner-form{
            background:#FFF;
            box-shadow: 0 2px 4px 0 rgba(0,0,0,0.4);
        }

        label{
            font-weight:400;
            font-size:15px;
        }

        .form-control {
            background-color: #f5f5f5;
            box-shadow: none;
            color: #565656;
            font-size:14px;
            padding:30px 10px;
            margin-bottom:30px;
            border: 1px solid #f1f1f1;
        }

        .btn{ 
            background: #72d6f5;
            color: #FFF;
            border-radius: 6px;
            margin: 0 auto;
            height: 48px;
            line-height: 38px;
            display: table;
            font-size: 15px;
            width: 100%;
        }

        .btn:hover{
            background:#FFF;
            border:2px solid #24acb3;
        }

        .forgot{
            text-align:center;
            margin-top:30px;
            font-size:16px;
        }

        input[type=text], input[type=password], input[type=email] {
            background-color: transparent;
            border: none;
            border-bottom: 1px solid #72d6f5;
            border-radius: 0;
            width: 100%;
            margin: 0 0 30px 0;
            padding: 0;
            box-shadow: none;
        }


        input[type=text]:focus, input[type=password]:focus, input[type=email]:focus {
            box-shadow: none;
            border-bottom: 1px solid #6eafc4;
        }
        .error-msg{
            border:1px solid darkred;
            background-color: #ff6666;
            text-align: center;
        }
    </style>
    <body>
        <?php
        if (isset($_SERVER['REQUEST_METHOD']) == "GET") {
            ?>
            <div class="login">
                <div class="container">
                    <div class="col-lg-6 col-lg-offset-3">

                        <div class="inner-form">

                            <h1>Login</h1> 

                            <form role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="row">

                                    <div class="col-lg-12">
                                        <label>Username</label>
                                        <div class="form-group">
                                            <input type="text" name="username" id="username" class="form-control" placeholder="" autofocus>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <label>Password</label>
                                        <div class="form-group">
                                            <input type="password" autocomplete="password" name="password" id="password" class="form-control" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <button type="submit" name="loginBTN" class="btn btn-default">
                                            <span>LOGIN</span>
                                        </button>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="forgot">
                                            <a href="Views/users/register.php">Not registered yet? Create an account for free!</a>
                                        </div>
                                    </div>

                                </div>
                            </form>

                        </div> <!-- inner-form -->

                    </div>   
                </div>   
            </div>    
            <?php
        } elseif (isset($_SERVER['REQUEST_METHOD']) == "POST") {
            ?>
            <div class="login">
                <div class="container">
                    <div class="col-lg-6 col-lg-offset-3">

                        <div class="inner-form">

                            <h1>Login</h1> 

                            <form role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="row">

                                    <div class="col-lg-12">
                                        <label>Username</label>
                                        <div class="form-group">
                                            <input type="text" name="username" id="username" class="form-control" placeholder="" autofocus>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <label>Password</label>
                                        <div class="form-group">
                                            <input type="password" autocomplete="password" name="password" id="password" class="form-control" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <button type="submit" name="loginBTN" class="btn btn-default">
                                            <span>LOGIN</span>
                                        </button>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="forgot">
                                            <a href="Views/users/register.php">Not registered yet? Create an account for free!</a>
                                        </div>
                                    </div>

                                </div>
                            </form>

                        </div> <!-- inner-form -->

                    </div>   
                </div>   
            </div>  

            <?php
        }
        ?>
    </body>
</html>
