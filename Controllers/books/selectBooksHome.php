<?php

require_once '../../DB_book_store/Table_Books/selectBooksHome.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //// Visuality Edit Book Properties
    $currentBook = getProperties($book_id);
} elseif (isset($_GET['searchBTN'])) {
    /// Search Book
    $searchKey = filter_var($_GET['searchKey'] , FILTER_SANITIZE_STRING);
    $searchKey = addslashes($searchKey);
    $resultNum = searchByKeyRows($searchKey);
    $booksArray = searchByKeyBooks($searchKey);
} else {
    /// Select All Books - Check How Many - For Paging
    $resultNum = selectAll();
    if (isset($_GET['pageNum'])) {
        /// Select 10 Books With Offset
        $offset = filter_var($_GET['pageNum'] , FILTER_SANITIZE_STRING);
        $booksArray = selectForPages($offset);
    } else {
        /// Select 10 Books - Default
        $booksArray = selectDefault();
    }
}