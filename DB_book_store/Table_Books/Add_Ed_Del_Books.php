<?php

require_once 'connection-DB.php';

function addBook($bookNow) {
    $conn = $GLOBALS["connection"];
    ////Add A Book
    $sqlAddBook = $conn->prepare("INSERT INTO books (book_name, author, price) VALUES (?, ?, ?)");
    $sqlAddBook->bind_param("ssd", $bookNow->book_name, $bookNow->author, $bookNow->price);
    try {
       $result =  $sqlAddBook->execute();
        if(!$result){
            throw new Exception("Adding: ". htmlspecialchars($bookNow->book_name) . " has failed.");
        };
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    $conn->close();
}

function deleteBook($book_id) {
    $conn = $GLOBALS["connection"];
    //// Delete A Book
    $sqlDeleteSentence = "DELETE FROM books WHERE book_id = $book_id;";
    $sqlTheName = "SELECT * FROM books WHERE book_id = $book_id;";
    try {
      $result = $conn->query($sqlDeleteSentence);
        if(!$result){
            throw new Exception("Delete: ". htmlspecialchars($sqlTheName) . " has failed.");
        }
    } catch (Exception $e) {
       echo $e->getMessage();
    }
    $conn->close();
}

function updateBook($bookNow) {
    $conn = $GLOBALS["connection"];
    /// Update A book
    $sqlUpdateSentence = $conn->prepare("UPDATE books SET book_name = ? , author = ? , price = ? WHERE book_id = $bookNow->book_id");
    $sqlUpdateSentence->bind_param("ssd", $bookNow->book_name, $bookNow->author, $bookNow->price);
    try {
       $result = $sqlUpdateSentence->execute();
       if(!$result){
            throw new Exception("Updating: ". htmlspecialchars($bookNow->book_name) . " has failed.");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    $conn->close();
}
