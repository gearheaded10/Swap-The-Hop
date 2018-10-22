<?php

session_start();

if (isset($_POST['submitLogin'])){
    
    // include database connection
    include_once "../DBC.php";
    
    // create variables
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    // error handlers
    // check if inputs are empty
    if (empty($username)){
        header("Location: ../index.php?login=emptyusername");
        exit(); // exits script
    }else{
        if (empty($password)){
            header("Location: ../index.php?login=emptypassword");
            exit(); // exits script
        } else {
            $sql = "SELECT * FROM users WHERE user_username = '$username'";
            $result = mysqli_query($connect, $sql);
            $resultsCheck = mysqli_num_rows($result);
            if ($resultsCheck <= 0) {
                header("Location: ../index.php?login=UsernameError");
                exit(); // exits script
            } else {
                if ($row = mysqli_fetch_assoc($result)){
                    // de-hashing the password
                    $hashedPasswordCheck = password_verify($password, $row['user_password']);
                    if ($hashedPasswordCheck == false){
                        header("Location: ../index.php?login=errorP");
                        exit(); // exits script
                    } elseif($hashedPasswordCheck == true){
                        // login the user here
                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['user_first'] = $row['user_first'];
                        $_SESSION['user_last'] = $row['user_last'];
                        $_SESSION['user_email'] = $row['user_email'];
                        $_SESSION['user_username'] = $row['user_username'];
                        header("Location: ../index.php?login=success");
                        exit(); // exits script
                    }
                }

            }
        }
    }

    } else {
        header("Location: ../index.php?login=error");
        exit(); // exits script
    }