<?php

function createUser($newUser) {

    require 'connection-DB.php';
    ////Create A User
    $user_name = $newUser->getUsername();
    $password_new = $newUser->getPassword();
    $email = $newUser->getEmail();
    $sqlcreateUser = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    $sqlcreateUser->bind_param("sss", $user_name, $password_new, $email);
    try {
        $result = $sqlcreateUser->execute();
        $conn->close();
        if (!$result) {
            throw new Exception("Creating" . htmlspecialchars($user_name) . " Has Failed. Contact us for more information: chapo12345@gmail.com");
        }
        return 'User Has Created Successfully.';
    } catch (Exception $e) {
        echo $e->getMessage();
        return 'Creation Has Failed.';
    }
}

/// Search Username If Exists
function checkIfUsernameExists1($user_name) {

    require 'connection-DB.php';
    $sqlCheckUsername = "SELECT * FROM users WHERE username ='" . $user_name . "'";
    try {
        $result = $conn->query($sqlCheckUsername);
        $conn->close();
        if (!$result) {
            throw new Exception("We are having issues. please try again later.");
        }
        return$result;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

/// Search Email If Exists
function checkIfEmailExists1($email) {

    require 'connection-DB.php';
    $sqlCheckUsername = "SELECT * FROM users WHERE email ='" . $email . "'";
    try {
        $result = $conn->query($sqlCheckUsername);
        if (!$result) {
            throw new Exception("We are having issues. please try again later.");
        }
        $conn->close();
        return$result;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

/// Check If Username And Password Are A Match
function userPassMatch($user__name, $password_now) {
    require 'connection-DB.php';
    $sqlCheckMatch = "SELECT * FROM users WHERE username ='" . $user__name . "' AND password ='" . $password_now . "' ";
    try {
        $result = $conn->query($sqlCheckMatch);
        if (!$result) {
            throw new Exception("We are having issues. please try again later.");
        }
        $conn->close();
        if ($result->num_rows > 0) {
            return 'Exists';
        } else {
            return 'Not Exists';
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

/// Know The User
function knowTheUser($user__name, $password_now) {
    require 'connection-DB.php';
    $sqlSelectUser = "SELECT * FROM users WHERE username ='" . $user__name . "' AND password ='" . $password_now . "' ";
    try {
        $result = $conn->query($sqlSelectUser);
        if (!$result) {
            throw new Exception("We are having issues. please try again later.");
        }
        $row = $result->fetch_assoc();
        $conn->close();
        $currentUser = new user($row['user_id'], $row['username'], $row['password'], $row['email']);
        return $currentUser;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

///// Change User Email
function changeUserEmail1($email, $userID) {
    require 'connection-DB.php';
    $sqlUpdateSentence = $conn->prepare("UPDATE users SET email = ? WHERE user_id = $userID");
    $sqlUpdateSentence->bind_param("s", $email);
    try {
        if ($row = $sqlUpdateSentence->execute()) {
            if (!$row) {
                throw new Exception("We are having issues. please try again later.");
            }
            $sqlGetDetails = "SELECT * FROM users WHERE user_id = $userID";
            $result = $conn->query($sqlGetDetails);
            $row = $result->fetch_assoc();
            $currentUser = new user($row['user_id'], $row['username'], $row['password'], $row['email']);
            $conn->close();
            return $currentUser;
        } else {
            $conn->close();
            return 'change Has failed.';
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

///// Change User Password
function changeUserPassword1($new_pass, $userID) {
    require 'connection-DB.php';
    $sqlUpdateSentence = $conn->prepare("UPDATE users SET password = ? WHERE user_id = $userID");
    $sqlUpdateSentence->bind_param("s", $new_pass);
    try {
        if ($row = $sqlUpdateSentence->execute()) {
            if (!$row) {
                throw new Exception("We are having issues. please try again later.");
            }
            $sqlGetDetails = "SELECT * FROM users WHERE user_id = $userID";
            $result = $conn->query($sqlGetDetails);
            $row = $result->fetch_assoc();
            $currentUser = new user($row['user_id'], $row['username'], $row['password'], $row['email']);
            $conn->close();
            return $currentUser;
        } else {
            $conn->close();
            return 'change Has failed.';
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
