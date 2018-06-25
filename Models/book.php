<?php

class book {

    public $book_id;
    public $book_name;
    public $author;
    public $price;

    function __construct($book_id, $book_name, $author, $price) {
        if (!$book_id == "" || !$book_id == NULL) {
            $this->book_id = $book_id;
        }
        $this->book_name = $book_name;
        $this->author = $author;
        $this->price = $price;
    }
}
