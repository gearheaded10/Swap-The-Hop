<?php
// establish connection with database
$connect = mysqli_connect('localhost', 'root', '', 'swap_the_hop_users');

if (mysqli_connect_error()){
    die("Connection failed".mysqli_connect_error());
} else{
    echo "";
}
?>