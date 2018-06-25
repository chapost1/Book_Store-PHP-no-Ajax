<?php
require_once '../../Models/user.php';
session_start();
if (!isset($_SESSION['current_user'])) {
    header('location: ../../index.php');
} else {
    $currentUser = $_SESSION['current_user'];
}
//////// If didn't find Search Redirect to Home
if ((isset($_GET['searchBTN'])) && ($_GET['searchKey'] == '')) {
    header('location: home__R_U_D.php');
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
        <!--   //////  Require Default Header  ///////  -->
        <?php require_once '../header.php'; ?>
        <article class="container">
            <!--   //////  Search Form ///////  -->
            <nav class="row nav-search">
                <div class="col-4">
                    <form method="GET"  action="<?php $_SERVER['PHP_SELF']; ?>">
                        <div class="row form-group">
                            <input class="col-10 searchVector" type="text" name="searchKey" placeholder="Search books by name.." />
                            <input class="col-2 searchBTN" name="searchBTN" type="submit" value="">
                        </div>
                    </form>
                </div>
                <div class="col-8"></div>
            </nav>
            <div class="row">
                <h3 class="mainH1">Dear Employees, Welcome to booka database Searching Feature.
                    Please follow your Branch manager to prevent mistakes.
                    Thank you!
                </h3>
            </div>
                <br/>
            <!--Table Head Maker-> <!--Table Head Maker-->
            <div class="books-container row">
                <div class="air col-xs-2"></div>
                <table class="col-xs-2 table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Book Name</th>
                            <th>Author Name</th>
                            <th>Price</th>
                            <th>Manipulation</th>
                        </tr>
                    </thead>
                <?php
                ////////////////////////////// If GET ONLY - Making Visual Data
                if ($_SERVER['REQUEST_METHOD'] == "GET") {
                    if (isset($_GET['searchBTN']) && $_GET['searchKey'] == "") {
                        header('location: home__R_U_D.php');
                    }
                    require_once '../../Controllers/books/selectBooksHome.php';
                    //////// Check How Many books - Pages Preparation
                    if ($resultNum->num_rows > 0) {
                        $index = 0;
                        //////// Make The Visual Table , SELECT FROM ALL BOOKS loop ----- Contains DELETE BTN & EDIT BTN
                        foreach ($booksArray AS $currentBook) {
                            $index++;
                            echo '<tbody>';
                            echo '<tr>';
                            echo '<td>';
                            echo $index;
                            echo '</td>';
                            echo '<td>';
                            echo htmlspecialchars($currentBook->book_name);
                            echo '</td>';
                            echo '<td>';
                            echo htmlspecialchars($currentBook->author);
                            echo '</td>';
                            echo '<td>';
                            echo htmlspecialchars($currentBook->price) . ' &#8362';
                            echo '</td>';
                            echo '<td>';
                            echo '<form class="inline-form" method="POST" action="../Controllers/Add_Ed_Del_Books.php">';
                            echo '<input id="book_id" type="hidden" readonly name="book_id" value="' . htmlspecialchars($currentBook->book_id) . '"/>';
                            echo '<input type="submit" name="deleteBTN" value="Delete" />';
                            echo '</form>';
                            echo '&nbsp;&nbsp;&nbsp;';
                            echo '<form class="inline-form" method="POST" action="home__R_U_D.php">';
                            echo '<input type="hidden" name="book_id" value="' . htmlspecialchars($currentBook->book_id) . '"/>';
                            echo '<input type="submit" name="editBTN" value="Edit" />';
                            echo '</form>';
                            echo '</td>';
                            echo '</tr>';
                            echo '</tbody>';
                        }
                    } else {
                        if (isset($_GET['searchBTN'])) {/////// If Search Didn't Find Any Match .....
                            echo "<h5 class='mainH1'>Didn't Find Any Match..</h5>";
                        }
                        /////// If There Are No Books to show, SHOW NONE.
                        echo '<tbody>' . '<tr>' . '<td>' . 'none' . '</td>' . '<td>' . 'none' . '</td>' . '<td>' . 'none' . '</td>' . '<td>' . 'none' . '</td>' . '<td>' . 'none' . '</td>' . '</tr>' . '</tbody>';
                    }
                } else {
                    
                }
                ?>
            </table>
            <div class="air col-xs-2"></div>
            </div>
        </article>
    </body>
</html>
