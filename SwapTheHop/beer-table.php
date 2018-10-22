<?php 
    include_once "DBC.php";
?>
<div class="table-responsive" style="padding: 20px">
<div class="table-responsive" style="padding: 10px;border-radius: 10px; border: 2px solid #CECECE;">
    <!-- Show list of beers -->
    <h2 style='text-align: center;'>Beer list</h2>
    <!-- Start Table --> 
    <table class="table table-hover table-responsive text-center">
    <!-- Make Table Head -->
        <thead>
            <tr>
                <th>Pic:</th>
                <th>Name:</th>
                <th>Brewery:</th>
                <th>Style:</th>
                <th>State:</th>
                <th>City:</th>
                <th>ABV:</th>
                <th>IBU:</th>
            </tr>
        </thead>
        <!-- End Table Head -->
        <?php
            ////////////////////////////////////////////////
            ///////// .  Values to send to Slider.js ///////
            ////////////////////////////////////////////////
            
            // get min and max ABV values    
            $initialABV = "SELECT * FROM Beer_List WHERE ABV =  ( SELECT MIN(ABV) FROM Beer_List )";
            $initialMinABVquery = mysqli_query($connect,$initialABV);
            $initialMinABVqueryRows = mysqli_num_rows($initialMinABVquery);
           
            // show rows
            $abvOnerows = mysqli_fetch_array($initialMinABVquery);
         
            // send initial ABV two information to slider.js
            echo "<div id='ABVInitialOne' data-info='".$abvOnerows['ABV']."' ></div>";
            
            // ABV two variable to pass to slider.js
            $initialABVtwo = "SELECT * FROM Beer_List WHERE ABV =  ( SELECT MAX(ABV) FROM Beer_List )";;
            $initialMaxABVquery = mysqli_query($connect,$initialABVtwo);
            
            // show rows
            $abvTworows = mysqli_fetch_array($initialMaxABVquery);
            // send initial ABV two information to slider.js
            echo "<div id='ABVInitialTwo' data-info='".$abvTworows['ABV']."' ></div>";
            
            ////////////////////////////////////////////////////
            ///////// .  End Values to send to Slider.js ///////
            ////////////////////////////////////////////////////
            
            ////////////////////////////////////////////////
            ///////// .  Values to send to IBU_Slider.js ///////
            ////////////////////////////////////////////////
            
            // get min and max ABV values    
            $initialIBU = "SELECT * FROM Beer_List WHERE IBU =  ( SELECT MIN(IBU) FROM Beer_List )";
            $initialMinIBUquery = mysqli_query($connect,$initialIBU);
            $initialMinIBUqueryRows = mysqli_num_rows($initialMinIBUquery);
           
            // show rows
            $ibuOnerows = mysqli_fetch_array($initialMinIBUquery);
         
            // send initial ABV two information to slider.js
            echo "<div id='IBUInitialOne' data-info='".$ibuOnerows['IBU']."' ></div>";
            
            // ABV two variable to pass to slider.js
            $initialIBUtwo = "SELECT * FROM Beer_List WHERE IBU =  ( SELECT MAX(IBU) FROM Beer_List )";
            $initialMaxIBUquery = mysqli_query($connect,$initialIBUtwo);
            
            // show rows
            $ibuTworows = mysqli_fetch_array($initialMaxIBUquery);
            // send initial ABV two information to slider.js
            echo "<div id='IBUInitialTwo' data-info='".$ibuTworows['IBU']."' ></div>";
            
            ////////////////////////////////////////////////////
            ///////// .  End Values to send to IBU_Slider.js ///////
            ////////////////////////////////////////////////////
    
            // make variable to control number of results shown
            $perPage = 10 ; // change this later to be variable
            
            // find if page variable is set, if so store page number , if not start page number at 1
            if(isset($_GET['page'])){
                $curPage = $_GET['page'];
            }else{
                $curPage = 1;
            }
            
            // make count variable
            $count = $_GET['count'];
            $countCarryover = $_GET['count'];
            
            ////////////////////////////////////////////////
            
            // add together search terms
            if(isset($_GET['search'])){
                $queryOne = "SELECT * FROM Beer_List WHERE ";
                $URL = "?search=".$_GET['search'];
                if(isset($_GET['State'])){
                    if($_GET['State'] == ""){
                        $state = "";
                        $queryOne .= ""; // build search
                        $URL .= "".$state ; // builds url
                    }else{
                        $state = $_GET['State'];
                        $queryOne .= "State = '$state'"; // build search
                        $URL .= "&State=".$state ; // builds url
                        // add AND if count >1
                        if(isset($count) && $count > 1){
                            $queryOne .= " AND ";
                            $count = $count -1;
                        }
                    }
                }
                if(isset($_GET['City'])){
                    if($_GET['City'] == ""){
                        $city = "";
                        $queryOne = $queryOne;
                        $URL = $URL;
                    } else {
                        $city = $_GET['City'];
                        $queryOne .= "City = '$city'"; // build search
                        $URL = "&City=".$city; // builds url
                        if(isset($count) && $count > 1){
                            $queryOne .= " AND ";
                            $count = $count -1;
                        }
                    }
                }
                if(isset($_GET['brewery'])){
                    if($_GET['brewery'] == ""){
                        $brewery = "";
                        $queryOne .= ""; // build search
                        $URL .= "".$brewery ; // builds url
                    }else{
                        $brewery = $_GET['brewery'];
                        $brewery = preg_replace("/[-]/", " ", $brewery);
                        $queryOne .= "brewery = '$brewery'"; // build search
                        $URL .= "&brewery=".$brewery ; // builds url
                        if(isset($count) && $count > 1){
                            $queryOne .= " AND ";
                            $count = $count -1;
                        }
                    }
                }
                if(isset($_GET['style'])){
                    if($_GET['style'] == ""){
                        $style = "";
                        $queryOne .= ""; // build search
                        $URL .= "".$style ; // builds url
                    }else{
                        $style = $_GET['style'];
                        $queryOne .= "beerType = '$style'"; // build search
                        $URL .= "&style=".$style ; // builds url
                        if(isset($count) && $count > 1){
                            $queryOne .= " AND ";
                            $count = $count -1;
                        }
                    }
                }
                if(isset($_GET['ABV1'])){
                    $abv1 = intval($_GET['ABV1']);
                    $queryOne .= "ABV BETWEEN $abv1"; // build search
                    $URL .= "&ABV1=".$abv1 ; // buils url
                    if(isset($count) && $count > 1){
                            $queryOne .= " AND ";
                            $count = $count -1;
                    }
                }
                if(isset($_GET['ABV2'])){
                    $abv2 = intval($_GET['ABV2']);
                    $queryOne .= "$abv2" ;
                    $URL .= "&ABV2=".$abv2.""; // buils url
                     if(isset($count) && $count > 1){
                            $queryOne .= " AND ";
                            $count = $count -1;
                        }
                }
                if(isset($_GET['IBU1'])){
                    $ibu1 = intval($_GET['IBU1']);
                    $queryOne .= "IBU BETWEEN $ibu1";
                    $URL .= "&IBU1=".$ibu1.""; 
                     if(isset($count) && $count > 1){
                            $queryOne .= " AND ";
                            $count = $count -1;
                        }
                }
                if(isset($_GET['IBU2'])){
                    $ibu2 = intval($_GET['IBU2']);
                    $queryOne .= " $ibu2 ";
                    $URL .= "&IBU2=".$ibu2.""; 
                     if(isset($count) && $count > 1){
                            $queryOne .= " AND ";
                            $count = $count -1;
                        }
                }
                if(isset($_GET['keywords']) && $_GET['keywords'] !== ""){
                    $keywords = $_GET['keywords'];
                    $keywords = preg_replace("/[-]/", " ", $keywords);
                    $queryOne .= "(Id LIKE '%".$keywords."%' OR beerName LIKE '%".$keywords."%' OR Brewery LIKE '%".$keywords."%' OR beerType LIKE '%".$keywords."%' OR State LIKE '%".$keywords."%' OR City LIKE '%".$keywords."%' OR ABV LIKE '%".$keywords."%' OR IBU LIKE '%".$keywords."%')";
                    $URL .= "&keywords=".$keywords."";
                }
                if(isset($_GET['count'])){
                    $URL .= "&count=" + $countCarryover;
                }
            }else{
                $queryOne = "SELECT * FROM Beer_List ORDER BY id ASC";
                $URL = "";
            }
            
            // echo query
            echo $queryOne; // figure out how to display search result for state as option selected
            
            // print out count
            echo $count;
            
            
            
            // Calculate the starting row for what is returned
            $start = abs(($curPage-1)*$perPage);
       
            // first database query
            $queryOne = $queryOne."";
            $queryResultOne = mysqli_query($connect, $queryOne);
            $queryRows = mysqli_num_rows($queryResultOne);
            
             // Second databse request
            $queryTwo = "".$queryOne." LIMIT $start, $perPage;";
            $queryResultTwo = mysqli_query($connect,$queryTwo);
            $queryCheck = mysqli_num_rows($queryResultTwo);
            
            // calculate total number of pages
            $totalPages = ceil($queryRows/$perPage);
            
            // URL Final
            if(isset($_GET['search'])){
               $URL .= "&"; 
            }else{
                $URL .= "?";
            }
        
            if($queryCheck > 0){
        
                // --------------------
                //make a table of beers
                // --------------------
    
                //<div id="beer-search">
                
                // make while loop to get beers from table
                while($rows = mysqli_fetch_assoc($queryResultTwo)){
                    echo '<tr class="beerTableRow" data-href="beerpage.php?beerID='.$rows['Id'].'"><td>';
                    echo '<img class="Beer-Table-Pic img-circle" src="Pictures/GPPaleAle.png" alt="Good People Pale Ale" ></td><td>';
                    echo ''.$rows['beerName'].'</td><td>';
                    echo ''.$rows['Brewery'].'</td><td>';
                    echo ''.$rows['beerType'].'</td><td>';
                    echo ''.$rows['State'].'</td><td>';
                    echo ''.$rows['City'].'</td><td>';
                    echo ''.$rows['ABV'].'</td><td>';
                    echo ''.$rows['IBU'].'</td>';
                    echo '</tr>';
                   
                 }
                 
                 ////////////////////////////////////////////////////
                 // make system for page selection
                 ////////////////////////////////////////////////////
                 
                 // * make code for if only one page exists. cannot have a nextbutton
                 
                 // make nav selection class
                 echo '<div class="nav-selection">';
                 
                 if($curPage == 1){ // list the following if on first page ( start)
                     for($i=1;$i<=$totalPages;$i++){ // make a for loop to show all available pages
                        if($i == $curPage){
                            echo '<a class="btn btn-primary disabled" role="button" href="'.$URL.'page='.$i.'"><b>'.$i.'</b></a>&nbsp'; // if current page then disable button
                        }else{
                            echo '<a class="btn btn-primary" role="button" href="'.$URL.'page='.$i.'"><b>'.$i.'</b></a>&nbsp'; // make all individual page buttons
                        }
                     }
                     if($totalPages > 1){
                     echo '<a class="btn btn-primary" role="button" href="'.$URL.'page='.($curPage+1).'"><b> Next </b></a>&nbsp'; // make next button only
                    }
                 }else if($curPage > 1){ // (end first segment) (start second) if current page is greater than the first page then check if its the last page or not
                     if($curPage == $totalPages){ // if current page is the last page then show the following
                        echo '<a class="btn btn-primary" role="button" href="'.$URL.'page='.($curPage-1).'"><b> Prev </b></a>&nbsp'; // make button for previous page only
                        for($i=1;$i<=$totalPages;$i++){
                            if($i == $curPage){
                                echo '<a class="btn btn-primary disabled" role="button" href="'.$URL.'page='.$i.'"><b>'.$i.'</b></a>&nbsp'; // if current page then disable button
                            }else{
                                echo '<a class="btn btn-primary" role="button" href="'.$URL.'page='.$i.'"><b>'.$i.'</b></a>&nbsp';
                            }

                        }                         
                     }else{ // if the current page is neither the first or last then display the following
                         echo '<a class="btn btn-primary" role="button" href="'.$URL.'page='.($curPage-1).'"><b> Prev </b></a>&nbsp'; // make button for previous page
                         for($i=1;$i<=$totalPages;$i++){
                             if($i == $curPage){
                                 echo '<a class="btn btn-primary disabled" role="button" href="'.$URL.'page='.$i.'"><b>'.$i.'</b></a>&nbsp'; // if current page then disable button
                             }else{
                                echo '<a class="btn btn-primary" role="button" href="'.$URL.'page='.$i.'"><b>'.$i.'</b></a>&nbsp';
                             }
                         }
                         echo '<a class="btn btn-primary" role="button" href="'.$URL.'page='.($curPage+1).'"><b> Next </b></a>&nbsp'; // make next button
                     }
                 }
                 
                 // end nav selection class
                 echo '</div>';
            } else{
                echo '<tr class="beerTableRow"> <td> No Results </td></tr>';
            }
        ?>
        <!-- End Table-->
        
    </table>
    <div class="content-center">

    </div>
</div>
</div> <!-- end style of 10 px padding-->