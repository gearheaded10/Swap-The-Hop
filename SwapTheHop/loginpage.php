<?php
    if (isset($_SESSION['user_id'])){ //check that user id is set
        // include pic database

        // make div element for section
        echo "<div class='menu-profile-container center'>";
        // make head text
        echo '<h2 class="display-4">'.$_SESSION["user_username"].'</h2>';
        // display welcome info and link to user page
        // display user profile image
        $id_login = $_SESSION['user_id'];
            $sql_img_login = "SELECT * FROM profileimg WHERE userid='$id_login'";
            $result_img_login = mysqli_query($connect, $sql_img_login);
            while ($rowImg_login = mysqli_fetch_assoc($result_img_login)){
                echo "<div>";
                    if ($rowImg_login['default_img'] == 0){
                        $ext_login = $rowImg_login['ext'];
                        echo "<img class='Beer-Table-Pic img-circle' src='Pictures/Profile".$id_login.".png'>";
                    } else{
                        echo "<img class='Beer-Table-Pic img-circle' src='uploads/profiledefault.png'>";
                    }
                echo "</div>";
            }
        // welcome user
                echo '<table>';
                echo '<tr style="margin: 20px ; padding: 20px ;"><td style="margin: 10px ; padding: 10px ;"><Form action="userPage.php" method="POST" >';
                    echo '<button style=" display: inline-block;" class="btn btn-success" name="profileButton" >Profile</button>';
                echo '</form></td>';
                echo '<td style="margin: 10px ; padding: 10px ;"><Form action="includes/logout.inc.php" method="POST" >';
                    echo '<button style=" display: inline-block;" type="submit" class="btn btn-success" name="logoutButton" >Logout</button>';
                echo '</form></td></tr>';
                echo '</table>';
        echo "</div>";

    } else {
        // overall container
        echo "<div class='menu-profile-container center'>";
        // create title
        echo '<h2 class="display-4">Login</h2>';
        // if they are not signed in then prompt them to sign in
        echo '<form action="includes/login.inc.php" method="POST">';
        echo '<ul style="list-style-type: none;">';
            echo '<li class="ul-spacing"><input type="text" name="username" placeholder="username/e-mail"></li>';
            echo '<li class="ul-spacing"><input type="password" name="password"placeholder="password"></li>';
            echo '<li class="ul-spacing"><button class="loginButton btn btn-success" type="submit" name="submitLogin">Login</button></li>';
        echo '<li class="ul-spacing"><a  href="signup.php">Sign Up</a></li>'; // prompt to sign up 
        echo '</ul>';
        echo '</form>';
        echo "</div>";
        echo "</div>";
    }
