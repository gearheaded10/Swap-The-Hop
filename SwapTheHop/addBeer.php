<!-- Include Header-->
<?php
    include_once 'header.php';
?>
<!-- JAvascript for form processing -->
<script>
$(document).ready(function(){

    $(".beer-info-form").submit(function(event){
        event.preventDefault();
        var beerName =$("#beerName").val();
        var breweryName = $("#breweryName").val();
        var style = $("#style").val();
        var state = $("#state_AB").val();
        var city = $("#city").val();
        var abv = $("#abv").val();
        var ibu = $("#ibu").val();
        var addBeer = $("#addBeer").val();
        $(".form-error-message").load("addBeerDB.php", {
            beerName: beerName,
            breweryName: breweryName,
            style: style,
            state: state,
            city: city,
            abv: abv,
            ibu: ibu,
            addBeer:addBeer
        });
    });
});
</script>
<!-- Setup Bootstrap Styling -->
<div class='row'>
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <!-- create form for adding a beer -->
        <form class='beer-info-form' action='addBeerDB.php' method='POST'enctype="multipart/form-data">
            <div class='form-group'>  
                <label> Name of Beer <span style="color:red;">*</span>:</label>
                <input class='form-control' id='beerName' type='text' name='beerName'>
            </div>
            <div class='form-group'>
                <label>Brewery<span style="color:red;">*</span>:</label>
                <input class='form-control' id='breweryName' type='text' name='breweryName'>
            </div>
            <div class='form-group'>
                <label>Style<span style="color:red;">*</span>:</label>
                <input class='form-control' id='style' type='text' name='style'>
            </div>
            <div class='form-group'>
                <label>State<span style="color:red;">*</span>:</label>
                <select class='form-control' id='state_AB' name = "state">
                    <option value="">Select</option>
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District Of Columbia</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                </select>
            </div>
            <div class='form-group'>
                <label>City:</label>
                <input class='form-control' id='city' type='text' name='city'>
            </div>
            <div class='form-group'>
                <label>ABV:</label>
                <input class='form-control' id='abv' type='text' name='abv'>
            </div>
            <div class='form-group'>
                <label>IBU:</label>
                <input class='form-control' id='ibu' type='text' name='ibu'>
            </div>
            <div class='form-group'>
                <label>Upload an Image:</label>
                <!-- Button to Open the Modal -->
                <button type="button" class="btn btn-primary btn-sm center"  data-toggle="modal" data-target="#addBeerModal">
                  Add Picture
                </button>
            </div>
            <div class='form-group'>
                <input class="btn btn-primary btn-block" id='addBeer' type='submit' name='addBeer' value='Add Beer'>
            </div>
            <div class='form-group'>
                <p class='form-error-message'></p>
            </div>
          
        </form>
    </div>
    <div class="col-sm-4"></div>
</div>

<!-- The Modal -->
<div class="modal" id="addBeerModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Picture</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <input type="file" id="beer_image_upload" name="file">
        <div id="beer_uploaded_image"></div>
        <div id="beer_image_demo" style="width:350px; margin-top:30px"></div>
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



<!-- Include Footer -->
<?php
    include_once 'footer.php';
?>

<!-- Script for croppie -->
<script>
$( document ).ready(function() {

$image_crop = $('#beer_image_demo').croppie({
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
    
$('#beer_image_upload').on('change', function () {
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
        url:"UploadBeerPic.php",
        type: "POST",
        data:{"beer_image": response},
        success:function(data)
        {
          //$('#uploadimageModal').modal('hide');
          $('#beer_uploaded_image').html(data);
        }
      });
    });
  });
});  
</script>