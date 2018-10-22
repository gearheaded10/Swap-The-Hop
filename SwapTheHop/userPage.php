<?php
// include header
include_once 'header.php';

// check if user is set
if (isset($_SESSION['user_id'])){

    // Start page
    ?>
    <!-- Bootsrtap start-->
    <!-- make Title of page -->
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4 bg-secondary">
        <div style = "margin: 10px ; padding: 10px ;">
        <?php echo "<div class='sth-header bg-secondary'> <h3 class='h3 text-center'> ".$_SESSION['user_username']." </h3> </div>" ;?>
            <?php
                // load profile pic
                // make variables
                $id = $_SESSION['user_id'];
                $sql_img = "SELECT * FROM profileimg WHERE userid='$id'";
                $result_img = mysqli_query($connect, $sql_img);
                while ($rowImg = mysqli_fetch_assoc($result_img)){
                    echo "<div class=''>";
                        if ($rowImg['default_img'] === '0'){
                            echo "<img class='sth-user-page-pic' src='Pictures/Profile".$id.".png'>";
                        } else{
                            echo "<img class='sth-user-page-pic' src='uploads/profiledefault.png'>";
                            //echo $rowImg['default_img'];
                        }
                        echo "<h5 class='center'>".$_SESSION['user_first']." ".$_SESSION['user_last']."</h5>";
                    echo "</div>";
                }

            ?>
            
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary btn-sm center"  data-toggle="modal" data-target="#myModal">
          Change Profile Picture
        </button>
        
        <!-- end column -->
        </div>
        <div class="col-sm-4"></div>
    <div> <!-- end row -->      

    <?php

} else{
    echo "you are not logged in";
}
?>


<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Change Profile Picture</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <input type="file" id="image_upload" name="file">
        <div id="uploaded_image"></div>
        <div id="image_demo" style="width:350px; margin-top:30px"></div>
        <!--<div id='default-foto' class='hidden'></div> -->
        <button class="crop_image" type="submit" >submit</button>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



<script>
$( document ).ready(function() {

$image_crop = $('#image_demo').croppie({
    //url: $("#default-foto").html() ,
        viewport: {
            width: 250,
            height: 250,
            type: 'square'
        },
        boundary: {
            width: 300,
            height: 300
        }
    });
    
$('#image_upload').on('change', function () {
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
});
$('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      $.ajax({
        url:"UploadProfilePic.php",
        type: "POST",
        data:{"image": response},
        success:function(data)
        {
          //$('#uploadimageModal').modal('hide');
          $('#uploaded_image').html(data);
        }
      });
    });
  });
});  
</script>