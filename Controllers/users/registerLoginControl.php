<?php

if (isset($_POST['registerBTN'])) {
    require_once '../../Models/user.php';
    require_once '../../DB_book_store/Table_Users/createUserLogin.php';

    function createNewUser($user_id, $user_name, $password_new, $email) {

//    setUsername($username);
        $newUser = new user($user_id, $user_name, $password_new, $email);
        $message = createUser($newUser);
        return $message;
    }

    function checkIfUsernameExists($user_name) {

        $resultNum = checkIfUsernameExists1(addslashes($user_name));
        return $resultNum;
    }

    function checkIfEmailExists($email) {

        $resultNum = checkIfEmailExists1(addslashes($email));
        return $resultNum;
    }

} elseif (isset($_POST['loginBTN'])) {
    require_once 'Models/user.php';
    require_once 'DB_book_store/Table_Users/createUserLogin.php';

    function checkIfMatch($user__name, $password_now) {
        $userPassMatch = userPassMatch(addslashes($user__name), addslashes($password_now));
        if ($userPassMatch == 'Exists') {
            return 'Exists';
        } else {
            return 'Not Exists';
        }
    }

    function getUser($user__name, $password_now) {
        $currentUser = knowTheUser(addslashes($user__name), addslashes($password_now));
        return $currentUser;
    }

}