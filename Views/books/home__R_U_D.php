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
        <!--   //////  Require Default Header  ///////  -->
        <?php require_once '../header.php'; ?>
        <article class="container">
            <!--   //////  Search Form ///////  -->
            <nav class="row nav-search">
                <div class="col-4">
                    <form method="GET"  action="searchBookPage.php">
                        <div class="row form-group">
                            <input class="col-10 searchVector" type="text" name="searchKey" placeholder="Search books by name.." />
                            <input class="col-2 searchBTN" name="searchBTN" type="submit" value="">
                        </div>
                    </form>
                </div>
                <div class="col-8"></div>
            </nav>
            <div class="row">
                <h3 class="mainH1">
                    <?php
                    ////// //////  ////   If  ////   GET ////// GET  ////   If  ////   GET  REQUEST METHOD
                    if ($_SERVER['REQUEST_METHOD'] == "GET") {
                        echo'Dear Employees, Welcome to booka database Website.
                Please follow your Branch manager to prevent mistakes.
                Thank you!';
                    }
                    ?>
                </h3>
            </div>
            <!--Pages Maker--> <!--Pages Maker-->
            <div class='pages-cont'>
                <span class="pages-span">Page:&nbsp;</span>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == "GET") {
                    require_once '../../Controllers/books/selectBooksHome.php';
                    ///////////////////////////////////////////// Pages Maker
                    require_once '../../Controllers/books/pagesShower.php';
                }
                ?>
                <!--Pages Maker--> <!--Pages Maker-->
            </div>
            <!--Books Table Head Maker-> <!--Books Table Head Maker-->
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
                        if ($resultNum->num_rows > 0) {
                            ///////  Create Table Dividers only if there are books to show!
                            //////// Books ID to Start As Page Num * 10
                            if (isset($_GET['pageNum'])) {
                                $_GET['pageNum'] = htmlspecialchars($_GET['pageNum']);
                                $index = $_GET['pageNum'] * 10;
                            } else {
                                $index = 0;
                                ///////////////////////////////////////////// Pages Maker
                            }
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
                                echo (double)htmlspecialchars($currentBook->price) . ' &#8362';
                                echo '</td>';
                                echo '<td class="manipulation-forms-cont">';
                                echo '<form class="inline-form1" method="POST" action="../../Controllers/books/Add_Ed_Del_Books.php">';
                                echo '<input id="book_id" type="hidden" readonly name="book_id" value="' . htmlspecialchars($currentBook->book_id) . '"/>';
                                echo '<input class="btn btn-basic"  type="submit" name="deleteBTN" value="Delete" />';
                                echo '</form>';
                                echo '&nbsp;&nbsp;&nbsp;';
                                echo '<form class="inline-form2" method="POST" action="' . $_SERVER['PHP_SELF'] . '">';
                                echo '<input type="hidden" name="book_id" value="' . htmlspecialchars($currentBook->book_id) . '"/>';
                                echo '<input class="btn btn-basic"  type="submit" name="editBTN" value="Edit" />';
                                echo '</form>';
                                echo '</td>';
                                echo '</tr>';
                                echo '</tbody>';
                            }
                        } else {
                            /////// If There Are No Books to show, SHOW NONE.
                            echo '<tbody>' . '<tr>' . '<td>' . 'none' . '</td>' . '<td>' . 'none' . '</td>' . '<td>' . 'none' . '</td>' . '<td>' . 'none' . '</td>' . '<td>' . 'none' . '</td>' . '</tr>' . '</tbody>';
                        }
                    } else {
                        ////// //////  ////   If  ////   POST ////// POST  ////   If  ////   POST REQUEST METHOD
                        ////////////////// FOR EDIT & UPDATE
                        ?>
                        <h3 class="mainH1">Dear Employees, Welcome to booka database Edit's Query.
                            Please follow your Branch manager to prevent mistakes.
                            Thank you! 
                        </h3>
                        <?php
                        //////////////////// Edit A book Visualation - Happens only in POST ----- Contains UPDATE BTN
                        $book_id = $_POST['book_id'];
                        require_once '../../Controllers/books/selectBooksHome.php';
                        echo '<form method="POST" action="../../Controllers/books/Add_Ed_Del_Books.php">';
                        echo '<tbody>';
                        echo '<tr>';
                        echo '<td>';
                        echo $currentBook->book_id;
                        echo '</td>';
                        echo '<td>';
                        echo '<input type="text" name="book_name" placeholder="Book Name" value="' . htmlspecialchars($currentBook->book_name) . '"/>';
                        echo '</td>';
                        echo '<td>';
                        echo '<input type="text" name="author" placeholder="Author" value="' . htmlspecialchars($currentBook->author) . '"/>';
                        echo '</td>';
                        echo '<td>';
                        echo "<input type='number' name='price' step='0.01' placeholder='Book Price' value='" . (double)htmlspecialchars($currentBook->price) . "'/>";
                        echo '</td>';
                        echo '<td>';
                        echo '<input type="hidden" readonly name="book_id" value="' . htmlspecialchars($currentBook->book_id) . '"/>';
                        echo '<input class="btn btn-basic" type="submit" name="updateBTN" value="Save" />';
                        echo '</td>';
                        echo '</tr>';
                        echo '</tbody>';
                        echo '</form>';
                    }
                    ?>
                </table>
                <div class="air col-xs-2"></div>
            </div>
        </article>
    </body>
</html>
