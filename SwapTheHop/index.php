<?php
// include header
include_once 'header.php';
?>

<!-- start bootstrap styling for beer table -->
<div class="row">
    <div class="col-sm-2 center">
    <?php
       include_once "left-side-menu.php";
     ?>
    </div>
    <!-- Center Content-->
    <div class="col-sm-8"> <!-- start col 2 bootstrap-->
        <?php
            include_once "beer-table.php";
        ?>
    </div> <!-- end col 2 bootstrap -->
    
    <!-- Right side Content-->
    <div class="col-sm-2"> <!-- start col 3 bootstrap -->
    </div> <!-- end col 3 bootstrap -->
</div> <!-- end bootsrtap row -->
    
<!-- Include Footer -->
<?php
    include_once 'footer.php';
?>

<!--+++++++++++++++++++++++++++++++++++++++++++++++ -->

<!-- make / include scripts scripts-->
<!-- <script src="checkbox-fn.js"></script>

<!-- Script for table row clicking function -->
<script>
//jQuery
$(document).ready(function($) {
    $(".beerTableRow").click(function() {
        window.location = $(this).data("href");
    });
});
</script>

<!--
<script>
var sel1 = document.querySelector('#ABV-1');
var sel2 = document.querySelector('#ABV-2');
var options2 = sel2.querySelectorAll('option');
var compVal = sel2.selectedIndex;
//var val = [];
//var start =0;

function giveSelection(selValue) {
    console.log(selValue);
    console.log(sel2.selectedIndex);
  //sel2.innerHTML = '';
  if(selValue > compVal){
      sel2.selectedIndex = selValue;
      
  }
  //for(var i = 0; i < options2.length; i++) {
   // if(options2[i].dataset.option >= selValue) {
    //  sel2.appendChild(options2[i]);
   //   val[start] = options2[i];
   //   start++;
  //  }
 // }
  //sel2.selectedIndex = val[1];
}

</script>
-->

