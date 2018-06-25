<?php

session_start();
require_once '../../Models/book.php';
if (isset($_POST['book_name'])) {
    $book_name = $_POST['book_name'];
    $book_name = filter_var($book_name , FILTER_SANITIZE_STRING);
    $author = $_POST['author'];
    $author = filter_var($author , FILTER_SANITIZE_STRING);
    $price = (double) $_POST['price'];
    $price = filter_var($price , FILTER_VALIDATE_FLOAT);
};
if (isset($_POST['book_id'])) {
    $book_id = $_POST['book_id'];
};
require '../../DB_book_store/Table_Books/Add_Ed_Del_Books.php';

//// ///////// Create
if (isset($_POST['addBTN'])) {
    $bookNow = new book($book_id, $book_name, $author, $price);
    addBook($bookNow);
    ////// Send Echo To User
    $_SESSION['previous_location'] = 'addedAbook';
    header('location: ../../Views/books/addBook__C.php');
    //////// ///// Delete   
} else {
    if (isset($_POST['deleteBTN'])) {
        deleteBook($book_id);
        header('location: ../../Views/books/home__R_U_D.php');

        ////////  //// Update
    } elseif (isset($_POST['updateBTN'])) {
        $bookNow = new book($book_id, $book_name, $author, $price);
        updateBook($bookNow);
        header('location: ../../Views/books/home__R_U_D.php');
    }
}