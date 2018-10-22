<?php
// establish connection with database
$conn_Pic_Db = mysqli_connect('localhost', 'root', '', 'swap_the_hop_profile_pic');

if (mysqli_connect_error()){
    die("Connection failed".mysqli_connect_error());
} else{
    echo "";
}
?>