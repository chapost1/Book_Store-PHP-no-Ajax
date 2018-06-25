<?php
require_once '../../Models/user.php';
session_start();
if (!isset($_SESSION['current_user'])) {
    header('location: ../../index.php');
} else {
    $currentUser = $_SESSION['current_user'];
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
        <!--Bootsrtap-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
              crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>
    </head>
    <body>
        <?php require_once '../header.php'; ?>

        <article class="container">
            <br/>
            <h3 class="mainH1">Dear Employees, Welcome to booka database Adding Section.
                Please follow your Branch manager to prevent mistakes.
                Thank you!</h3>
            <div class="successCont">
                <?php
                if (isset($_SESSION['previous_location']) == "addedAbook") {
                    echo'<h5 class="success">Book Has Added Successfully</h5>';
                    unset($_SESSION["previous_location"]);
                }
                ?>
            </div>
            <div class="row">
                <div class="col-2"></div>
                <form class="addContainer col-8" method="POST" action="../../Controllers/books/Add_Ed_Del_Books.php">
                    <h2>Add A book:</h2>
                    <div class="form-group">
                        <label for="bookname">Book Name:</label>
                        <input id="bookname" required="required" type="text" class="form-control" placeholder="Book Name" name="book_name" />
                    </div>
                    <div class="form-group">
                        <label for="authorname">Author Name:</label>
                        <input id="authorname" required="required" type="text" class="form-control" placeholder="Author Name" name="author" />
                    </div>
                    <div class="form-group">
                        <label for="bookprice">Price in &#8362:</label>
                        <input id="bookprice" required="required" type="number" step="0.01" class="form-control" placeholder="Book Price" name="price" />
                    </div>
                    <input class="btn btn-primary" type="submit" name="addBTN" value="Add"/>
                </form>
                <div class="col-2"></div>
            </div>
        </article>
    </body>
</html>
