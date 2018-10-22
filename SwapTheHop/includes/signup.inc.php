<?php

// reroute if user tries to go here manually
if(isset($_POST['submit'])){
    
    include_once "../DBC.php";

    $first = mysqli_real_escape_string($connect, $_POST['firstName']);
    $last = mysqli_real_escape_string($connect, $_POST['lastName']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $repassword = mysqli_real_escape_string($connect, $_POST['repassword']);

    // create error variable
    $errorEmpty = false;
    $errorEmail = false;
    $errorEmptyFirstName = false;
    $errorEmptyLastName = false;
    $errorEmptyEmail = false;
    $errorEmptyUsername = false;
    $errorEmptyPassword = false;
    $errorEmptyRePassword = false;
    $errorInvalidChar = false;
    $errorUsernameTaken = false;
    $errorPasswordNotMatch = false;
    $errorEmailTaken = false;

    // error handlers
    // check if everything has been filled out and no empty fields

    //check if any field is empty
    if(empty($first) || empty($last) || empty($email) || empty($username) || empty($password) || empty($repassword)){
        echo "<span class='form-error'>Fill in all fields</span>";
        
        // check if first name is empty
        if(empty($first)){
            $errorEmptyFirstName = true;
        }
        // check if last name is empty
        if(empty($last)){
            $errorEmptyLastName = true;
        }
        // check if email is empty
        if(empty($email)){
            $errorEmptyEmail = true;
        }
        // check if username has been entered
        if(empty($username)){
            $errorEmptyUsername = true;
        }
        // check if password is empty
        if(empty($password)){
            $errorEmptyPassword = true;
        }
        // check if password is empty
        if(empty($repassword)){
            $errorEmptyRePassword = true;
        }
    }else {
        // check if input characters are valid
        if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)){
            echo "Inalid characters in first or last name";
            $errorInvalidChar = true;
        } else{
            // check if email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<span class='form-error'> Write a valid E-mail address</span>";
                $errorEmail = true;
         
            } else {
                // Check username isnt taken
                $sql = "SELECT * FROM users WHERE user_username='$username'";
                $result = mysqli_query($connect, $sql);
                $resultCheck = mysqli_num_rows($result);

                if($resultCheck > 0){
                    echo "Username is already taken";
                    $errorUsernameTaken = true;
    
                } else {
                    // check email isnt already in use
                    $sql_3 = "SELECT * FROM users WHERE user_email='$email'";
                    $result_3 = mysqli_query($connect, $sql_3);
                    $resultCheck_3 = mysqli_num_rows($result_3);

                    if($resultCheck_3 >0){
                        echo "E-mail is already in use";
                        $errorEmailTaken = true;

                    }else {   
                        if($repassword !== $password){
                            echo " Passwords do not match";
                            $errorPasswordNotMatch = true;
                        } else{ 
                            //Hashing the password
                            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                            // insert the user into the database
                            $sql_2 = "INSERT INTO users (user_first, user_last, user_email, user_username, user_password) 
                            VALUES ('$first','$last', '$email', '$username', '$hashedPassword')";
                            mysqli_query($connect, $sql_2);

                            // read user ID from table
                            $sql_user_ID = "SELECT * FROM users WHERE user_username='$username' AND user_last='$last'";
                            $result_user_ID = mysqli_query($connect, $sql_user_ID);
                            $resultCheck_user_ID = mysqli_num_rows($result_user_ID);
                            if ($resultCheck_user_ID >0){
                                while ($rows_user_ID = mysqli_fetch_assoc($result_user_ID)){
                                    $fetched_User_ID = $rows_user_ID['user_id'];
                                    // insert default profile pic
                                    $sql_profile_pic = "INSERT INTO profileimg VALUES (null,$fetched_User_ID,1)";
                                    $result = mysqli_query($connect, $sql_profile_pic);
                                    $rowcount = mysqli_num_rows($result);
                                    echo "<span class='form-success'>success </span>";
                                }

                            }else {
                                echo 'error submitting your info';
                            }

                        
                        }
                    }
                }
            }
        }
    }  
}else {
echo "there was an error";
// header("Location: ../index.php");
//  exit();
}

?>
<script> 
$("#signUp-first, #signUp-last, #signUp-email, #signUp-username, #signUp-password").removeClass("input-error")
    var errorEmpty = "<?php echo $errorEmpty; ?>";
    var errorEmail = "<?php echo $errorEmail; ?>";
    var errorEmptyFirstName = "<?php echo $errorEmptyFirstName; ?>";
    var errorEmptyLastName = "<?php echo $errorEmptyLastName; ?>";
    var errorEmptyEmail = "<?php echo $errorEmptyEmail; ?>";
    var errorEmptyUsername = "<?php echo $errorEmptyUsername; ?>";
    var errorEmptyPassword = "<?php echo $errorEmptyPassword; ?>";
    var errorEmptyRePassword = "<?php echo $errorEmptyRePassword; ?>";
    var errorInvalidChar = "<?php echo $errorInvalidChar; ?>";
    var errorUsernameTaken = "<?php echo $errorUsernameTaken; ?>";
    var errorPasswordNotMatch = "<?php echo $errorPasswordNotMatch; ?>";
    var errorEmailTaken = "<?php echo $errorEmailTaken; ?>";
    

    if (errorEmptyFirstName == true) {
        $("#signUp-first").addClass("input-error");

    }

    if (errorEmptyLastName == true) {
        $("#signUp-last").addClass("input-error");

    }

    if (errorEmptyEmail == true) {
        $("#signUp-email").addClass("input-error");

    }

    if (errorEmptyUsername == true) {
        $("#signUp-username").addClass("input-error");

    }

    if (errorEmptyPassword == true) {
        $("#signUp-password").addClass("input-error");

    }

    if (errorEmail == true){
        $("#signUp-email").addClass("input-error");
    }

    if (errorEmptyRePassword == true){
        $("#signUp-re-password").addClass("input-error");
    }

    if (errorEmpty == false && errorEmail == false && errorEmptyFirstName == false && errorEmptyLastName == false && errorEmptyEmail == false 
    && errorEmptyUsername == false && errorEmptyPassword == false && errorInvalidChar == false && errorUsernameTaken == false 
    && errorEmptyRePassword == false && errorPasswordNotMatch == false && errorEmailTaken == false ){
        $("#signUp-first, #signUp-last, #signUp-email, #signUp-username, #signUp-password, #signUp-re-password").val("");
    }
</script>

