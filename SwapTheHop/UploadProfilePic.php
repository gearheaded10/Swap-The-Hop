<?php

// start user session
session_start();

// include databse file
include_once 'DBC.php';

// variables
$id = $_SESSION['user_id'];

// check if variable is set
if (isset($_POST['image'])){
    
    // get image data from croppie
    $data = $_POST['image'];

    // explode info from croppie to separate type and data
    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    
    // decode image to base 64
    $data = base64_decode($data);
    
    // create image name
    $imageName = "Profile".$id.'.png';
    
    // delete previous image if it exists
    if(!unlink("Pictures/".$imageName)){
        //echo "error replacing profile photo";
    } else{
        //echo "profile photo replaced";
    }
    
    // upload profile picture to server
    if(file_put_contents("Pictures/".$imageName, $data)){
          $defaultConfirmQuery = "SELECT default_img FROM profileimg WHERE userid=".$id.";";
          $defaultConfirmQueryResult = mysqli_query($connect,$defaultConfirmQuery);
          while ($DCQrows = mysqli_fetch_assoc($defaultConfirmQueryResult)){
                ?>
                    <script>
                        var defaultimg = "<?php echo $DCQrows['default_img'];?>";
                        console.log(defaultimg);
                    </script>
                <?php
            if($DCQrows['default_img'] === "1"){
             // change file in mysql database
                $PicChangeQuery = "UPDATE profileimg SET default_img = 0 WHERE userid = '".$id."';";
                if($ResultPicChangeQuery = mysqli_query($connect,$PicChangeQuery)){
                ?>
                    <script>
                        alert('success');
                    </script>
                <?php
                    
                };
            }else{
                
            };
          };
          ?>
            <script>
                window.location.reload();
                alert('profile picture has been updated');
            </script>
            <?php
    }else{
        ?>
        <script>
            window.location.reload();
            alert('failed to update profile picture');
        </script>
        <?php
    }
    
    // reload webpage
    ?>
    <script>
        window.location.reload();
    </script>
    <?php
    
    // end if statement
}
 
 // end php doc
?>
