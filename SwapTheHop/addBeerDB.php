<?php

if(isset($_POST['addBeer'])){
    // Include database connection to Swap the Hop
    include_once 'DBC.php';

    // create variables to store
    $name = mysqli_real_escape_string($connect, $_POST['beerName']);
    $brewery = mysqli_real_escape_string($connect, $_POST['breweryName']);
    $style = mysqli_real_escape_string($connect, $_POST['style']);
    $state = mysqli_real_escape_string($connect, $_POST['state']);
    $city = mysqli_real_escape_string($connect, $_POST['city']);
    //$abv = mysqli_real_escape_string($connect, $_POST['abv']);
    //$ibu = mysqli_real_escape_string($connect, $_POST['ibu']);
    $abv = $_POST['abv'];
    $ibu = $_POST['ibu'];
    
    // make variables
    // create error variable
    $error_name = false;
    $error_brewery = false;
    $error_style = false;
    $error_state = false;

    // Check if all fields have been entered
    if (empty($name) || empty($brewery) || empty($style) || empty($state) ){
        echo '<span class="form-error-message"> Fill in all required fields</span>';
        
         // check if beer name is empty
        if(empty($name)){
            $error_name = true;
        }
        // check if brewery name is empty
        if(empty($brewery)){
            $error_brewery = true;
        }
        // check if style is empty
        if(empty($style)){
            $error_style = true;
        }
        // check if state has been entered
        if(empty($state)){
            $error_state = true;
        }
        
    }else{
        // check if beer name and brewery are already in database
        $sql_query = "SELECT * FROM Beer_List WHERE beerName ='$name' AND Brewery='$brewery'";
        $query_result = mysqli_query($connect,$sql_query);
        $query_result_row_count = mysqli_num_rows($query_result);
        if ($query_result_row_count>0){
            echo '<span class="form-error-message">Beer already exists</span>';
        }else{
            if(empty($city)){
                $city = "N/A";
            }
            if(empty($abv)){
                $abv = 0;
            }
            if(empty($ibu)){
                $ibu=0;
            }
            //copy info to database if no errors
            $sql_query_insert = "INSERT INTO Beer_List
            VALUES (null,'$name','$brewery','$style','$state','$city',$abv,$ibu)";
            $sql_query_insert_action = mysqli_query($connect,$sql_query_insert);
            $sql_query_insert_action_rows = mysqli_affected_rows($connect);
            if ($sql_query_insert_action_rows >0){
                echo "<span class='form-success'> Success </span>";}
            else{
                echo "error";
            }

            
            // write code to upload a pic
            //$file = $_FILES['file']; // gets info from file
        
            //$fileName = $_FILES['file']['name'];
            //$fileTmpName = $_FILES['file']['tmp_name'];
            //$fileSize = $_FILES['file']['size'];
            //$fileError = $_FILES['file']['error'];
            //$fileType = $_FILES['file']['type'];
        
            //$fileExt = explode('.',$fileName);
            //$fileActualExt = strtolower(end($fileExt));
        
            //$allowed = array('jpg', 'jpeg', 'png');
        
            //if (in_array($fileActualExt, $allowed)){
               // if ($fileError === 0){
                  //  if($fileSize < 100000){
                   //     $fileNameNew = uniqid('', true).".".$fileActualExt;
                    //    $fileDestination = 'uploads/'.$fileNameNew;
                    //    move_uploaded_file($fileTempName, $fileDestination);
                     //   header("location: index.php?uploadsuccess");
        
        
                   // }else{
                     //   echo "<span class='form-error-message'>Your file is too big</span>";
                  //  }
               // }else{
                 //   echo "<span class='form-error-message'>There was an error uploading your file</span>";
               // }
        
            //}else{
               // echo "<span class='form-error-message'>You cannot upload files of this type</span>";
            //}
        //}
    }
}
}


?>
<script> 
$("#beerName, #breweryName, #style, #state").removeClass("input-error")
    var error_name = "<?php echo $error_name; ?>";
    var error_brewery = "<?php echo $error_brewery; ?>";
    var error_style = "<?php echo $error_style; ?>";
    var error_state = "<?php echo $error_state; ?>";
    
    if (error_name == true) {
        $("#beerName").addClass("input-error");

    }

    if (error_brewery == true) {
        $("#breweryName").addClass("input-error");

    }

    if (error_style == true) {
        $("#style").addClass("input-error");

    }

    if (error_state == true) {
        $("#state").addClass("input-error");

    }

    if (error_name == false && error_brewery == false && error_style == false && error_state == false){
        $("#beerName, #breweryName, #style, #state").val("");
    }
</script>

