<?php

require_once '../../Models/book.php';

//// Visuality Edit Book Properties
function getProperties($book_id) {
    require 'connection-DB.php';
    $sqlSelectBook = "SELECT book_id , book_name , author , ROUND(price , 2) AS 'price' FROM books WHERE book_id = $book_id ";
    try {
        $result = $conn->query($sqlSelectBook);
        $row = $result->fetch_assoc();
        if (!$result) {
            throw new Exception("Load" . $row['book_name'] . "has failed.");
        }
        $currentBook = new book($row['book_id'], $row['book_name'], $row['author'], $row['price']);
        return $currentBook;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

/// Search Book For Rows
function searchByKeyRows($searchKey) {
    require 'connection-DB.php';
    $sqlSelectWhere = "SELECT book_id , book_name , author , ROUND(price , 2) AS 'price' FROM books WHERE book_name LIKE '%" . $searchKey . "%'";
    try {
        $result = $conn->query($sqlSelectWhere);
        if (!$result) {
            throw new Exception("We are having some issues. Couldn't load books.");
        }
        $conn->close();
        return $result;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

/// Search Book For Books
function searchByKeyBooks($searchKey) {
    require 'connection-DB.php';
    $sqlSelectWhere = "SELECT book_id , book_name , author , ROUND(price , 2) AS 'price' FROM books WHERE book_name LIKE '%" . $searchKey . "%'";
    try {
        $result = $conn->query($sqlSelectWhere);
        $conn->close();
        if (!$result) {
            throw new Exception("We are having some issues. Searching Has Failed.");
        }
        $booksArray = array();
        while ($row = $result->fetch_assoc()) {
            $currentBook = new book($row['book_id'], $row['book_name'], $row['author'], $row['price']);
            array_push($booksArray, $currentBook);
        }
        return $booksArray;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

/// Select All Books - Check How Many - Pages Preparation
function selectAll() {
    require 'connection-DB.php';
    $sqlSelectAll = "SELECT book_id , book_name , author , ROUND(price , 2) AS 'price' FROM books";
    try {
        $resultNum = $conn->query($sqlSelectAll);
        if (!$resultNum) {
            throw new Exception("We are having some issues. Couldn't load books.");
        }
        $conn->close();
        return $resultNum;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

/// Select 10 Books With Offset
function selectForPages($offset) {
    require 'connection-DB.php';
    $sqlSelectAll = "SELECT book_id , book_name , author , ROUND(price , 2) AS 'price' FROM books LIMIT 10 OFFSET " . $offset . "0";
    try {
        $result = $conn->query($sqlSelectAll);
        $conn->close();
        if (!$result) {
            throw new Exception("We are having some issues. Couldn't load books.");
        }
        $booksArray = array();
        while ($row = $result->fetch_assoc()) {
            $currentBook = new book($row['book_id'], $row['book_name'], $row['author'], $row['price']);
            array_push($booksArray, $currentBook);
        }
        return $booksArray;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

/// Select 10 Books
function selectDefault() {
    require 'connection-DB.php';
    $sqlSelectAll = "SELECT book_id , book_name , author , ROUND(price , 2) AS 'price' FROM books LIMIT 10";
    try {
        $result = $conn->query($sqlSelectAll);
        $conn->close();
        if (!$result) {
            throw new Exception("We are having some issues. Couldn't load books.");
        }
        $booksArray = array();
        while ($row = $result->fetch_assoc()) {
            $currentBook = new book($row['book_id'], $row['book_name'], $row['author'], $row['price']);
            array_push($booksArray, $currentBook);
        }
        return $booksArray;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
