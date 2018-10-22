<?php

// reroute if user tries to go here manually
if(isset($_POST['submit'])){
    
    $first = mysqli_real_escape_string($connect, $_POST['firstName']);
    $last = mysqli_real_escape_string($connect, $_POST['lastName']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    // create error variable
    $errorEmpty = false;
    $errorEmail = false;

    // error handlers
    // check if everything has been filled out and no empty fields
    if(empty($first) || empty($last) || empty($email) || empty($username) || empty($password)){
        echo "<span class='form-error'> Fill in all fields</span>";
        $errorEmpty = true;
    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<span class='form-error'> Write a valid E-mail address</span>";
            $errorEmail = true;
    }
    else {
               // create success message
               echo "<span class='form-success'> Success </span>";
    }
}  
else {
    echo "there was an error";
}

?>

<script> 
$("#signUp-first, #signUp-last, #signUp-email, #signUp-username, #signUp-password").removeClass("input-error")
    var errorEmpty = "<? echo $errorEmpty; ?>";
    var errorEmail = "<? echo $errorEmail; ?>";

    if (errorEmpty == true) {
        $("#signUp-first, #signUp-last, #signUp-email, #signUp-username, #signUp-password").addclass("input-error");
    }

    if (errorEmail == true){
        $("#signUp-email").addclass("input-error");
    }

    if (errorEmpty == false && errorEmail == false){
        $("#signUp-first, #signUp-last, #signUp-email, #signUp-username, #signUp-password").val("");
    }
</script>