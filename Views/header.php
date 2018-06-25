<?php
$user_name = $currentUser->getUsername();
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
        <link href="../../style/book_store_style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container-fluid">
            <header class="row">
                <div class="col-12 row header-buttons">
                    <img class="col-md-2 col-xs-4 " src="../../images/bookaLogo.png" alt="logo" />
                    <a class="col-md-2 col-xs-4 btn btn-basic cPanel"  href="../users/controlPanel.php"><strong>Hi, <?php echo htmlspecialchars($user_name); ?>!</strong>
                        <br/>Control Panel&#9997;</a>
                    <a class="col-md-1 col-xs-2 btn btn-basic ss"  href="../books/home__R_U_D.php">Home&#127968;</a>
                    <a class="col-md-2 col-xs-4 btn btn-basic ss"  href="../books/addBook__C.php">Add A Book&#128214;</a>
                    <a class="col-md-2 col-xs-4 btn btn-basic ss"  href="#">Booka Chat&#9749;</a>
                    <a class="col-md-2 col-xs-4 btn btn-primary ss"  href="../reports/report.php">Report&#128196;&#10071;</a>
                    <a class="col-md-1 col-xs-2 btn btn-danger logoutB"  href="../../Controllers/users/logout.php">Log Out</a>
                </div>
            </header>
        </div>
    </body>
</html>
