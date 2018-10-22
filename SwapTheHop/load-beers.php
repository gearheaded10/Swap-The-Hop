 <?php
    // get variables passed along
    $ABV_1 = $POST['ABV_1'];
    $ABV_2 = $POST['ABV_2'];
    $ABV_3 = $POST['ABV_3'];
    $ABV_4 = $POST['ABV_4'];
    $ABV_5 = $POST['ABV_5'];
    $ABV_6 = $POST['ABV_6'];
    $ABV_7 = $POST['ABV_7'];
    $ABV_8 = $POST['ABV_8'];
    $ABV_9 = $POST['ABV_9'];
    $ABV_10 = $POST['ABV_10'];
    $ABV_11 = $POST['ABV_11'];
    
    echo $ABV_1;
    
            // make variable to control number of results shown
            $perPage = 10 ; // change this later to be variable
            
            // find total number of rows in the bee list
            $sql_2 = "SELECT * FROM Beer_List ORDER BY Id ASC;";
            $query = mysqli_query($connect,$sql_2);
            $queryCheck = mysqli_num_rows($query);
            //$totalRows = $queryCheck[0]; // returns total number of rows
            $totalPages = ceil($queryCheck/$perPage);
            
            // find current page from url
            if(isset($_GET['page'])){
                $curPage = intval($_GET['page']);
            }else {
                $curPage = 1;
            }
            
            // Calculate the starting row for what is returned
            $start = abs(($curPage-1)*$perPage);
        
        
            if($queryCheck > 0){
        
                // --------------------
                //make a table of beers
                // --------------------
                // Second databse request
                $queryTwo = "SELECT * FROM Beer_List WHERE ORDER By Id ASC LIMIT $start, $perPage";
                $queryResultTwo = mysqli_query($connect,$queryTwo);
                
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
            }
        ?>