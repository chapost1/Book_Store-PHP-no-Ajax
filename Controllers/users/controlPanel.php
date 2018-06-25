<?php

require_once '../../Models/user.php';
require_once '../../DB_book_store/Table_Users/createUserLogin.php';

function checkIfEmailExists($email) {

    $resultNum = checkIfEmailExists1(addslashes($email));
    return $resultNum;
}

function changeUserEmail($email, $userID) {
    $currentUser = changeUserEmail1(addslashes($email), $userID);
    if ($currentUser === 'change Has failed.') {
        return 'change Has failed.';
    } else {
        return $currentUser;
    }
}

function changeUserPassword($new_pass, $userID) {
    $currentUser = changeUserPassword1(addslashes($new_pass), $userID);
    if ($currentUser === 'change Has failed.') {
        return 'change Has failed.';
    } else {
        return $currentUser;
    }
}
