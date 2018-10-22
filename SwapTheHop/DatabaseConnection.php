<?php
// establish connection with database
$connect = mysqli_connect('localhost', 'root', '', 'Swap_The_Hop');

if (mysqli_connect_error()){
    die("Connection failed".mysqli_connect_error());
} else{
    echo "success";
}
?>