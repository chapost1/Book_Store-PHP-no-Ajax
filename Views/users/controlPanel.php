<?php
require_once '../../Models/user.php';
session_start();
if (!isset($_SESSION['current_user'])) {
    header('location: ../../index.php');
} else {
    $currentUser = $_SESSION['current_user'];
}
$e_mail = $currentUser->getEmail();
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
        <!--Bootsrtap-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
              crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>
    </head>
    <body>
        <!--   //////  Require Default Header  ///////  -->
        <?php require_once '../header.php'; ?>
        <article class="container">
            </br>
            <h3 class="mainH1">Dear Employees, Here you can change your email or password, be careful do not forget it!</h3>
            <div class="successCont">
                <?php
                //////////// Change Email Validation & proccess.
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    require_once '../../Controllers/users/controlPanel.php';
                    if (filter_has_var(INPUT_POST, 'newEmail')) {
                        $email = $_POST['newEmail'];
                        $email = filter_var($email , FILTER_SANITIZE_EMAIL);
                        if(filter_var($email , FILTER_VALIDATE_EMAIL)){
                        $emailCheck = checkIfEmailExists($email);
                        }
                        if ($emailCheck->num_rows > 0) {
                            echo '<h5 class="failure">email is already in use.</h5>';
                        }  else {
                            $userID = $currentUser->getUser_id();
                            $currentUser = changeUserEmail($email, $userID);
                            if ($currentUser === 'change Has failed.') {
                                echo '<h5 class="failure">change Has failed.</h5>';
                            } else {
                                $_SESSION['current_user'] = $currentUser;
                                $e_mail = $currentUser->getEmail();
                                echo '<h5 class="success">Email Has Changed!</h5>';
                            }
                        }
                        //////////// Change Password Validation & proccess.
                    } elseif (isset($_POST['changePassBTN'])) {
                        $prev_pass = $currentUser->getPassword();
                        if ($prev_pass !== $_POST['prev_pass']) {
                            echo '<h5 class="failure">Your Password isn' . "'" . 't correct!</h5>';
                        } else {
                            if (strcmp($_POST['new_pass1'], $_POST['new_pass2'])!== 0 ) {
                                echo '<h5 class="failure">New Passwords aren' . "'" . 't the same</h5>';
                            } else {
                                $new_pass = $_POST['new_pass1'];
                                $userID = $currentUser->getUser_id();
                                $currentUser = changeUserPassword($new_pass, $userID);
                                if ($currentUser === 'change Has failed.') {
                                    echo '<h5 class="failure">change Has failed.</h5>';
                                } else {
                                    $_SESSION['current_user'] = $currentUser;
                                    $e_mail = $currentUser->getEmail();
                                    echo '<h5 class="success">Password Has Changed!</h5>';
                                }
                            }
                        }
                    }
                }
                ?>
            </div>
            <div class="row">
                <form class="control-panelCont col-12" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <h2>Change Email:</h2>
                    <div class="form-group">
                        <label for="email">Current Email address:</label>
                        <input readonly type="email" class="form-control" id="email" placeholder="example@email.com" value="<?php echo htmlspecialchars($e_mail); ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="email">New Email address:</label>
                        <input required="required" type="email" name="newEmail" class="form-control" id="email" placeholder="example@email.com" value=""/>
                    </div>
                    <button type="submit" name="changeEmailBTN" class="btn btn-primary">Submit</button>
                </form>

                <form class="control-panelCont col-12" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <h2>Change Password:</h2>
                    <div class="form-group">
                        <label for="pwd">Current Password:</label>
                        <input required="required" type="password" name="prev_pass" class="form-control" id="pwd">
                    </div>
                    <div class="form-group">
                        <label for="pwd1">New Password:</label>
                        <input required="required" type="password" name="new_pass1" class="form-control" id="pwd1">
                    </div>
                    <div class="form-group">
                        <label for="pwd2">Confirm Password:</label>
                        <input type="password" name="new_pass2" class="form-control" id="pwd2">
                    </div>
                    <button required="required" type="submit" name="changePassBTN" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </article>
    </body>
</html>
