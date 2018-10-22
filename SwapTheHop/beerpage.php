<?php
    // Include Header
    include_once 'header.php';
    // include database connection
    include_once 'DBC.php';
    // create ID variable
    $id = $_GET['beerID'];

    //create bootstrap layout
    ?>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <table class="table">
                <tr>
                    <th>Name</th>
                    <th>Brewery</th>
                    <th>Style</th>
                    <th>State</th>
                    <th>City</th>
                    <th>ABV</th>
                    <th>IBU</th>
                </tr>
            <?php
            // mysql database data grab
                $sql = "SELECT * FROM Beer_List WHERE Id='$id'";
                $result = mysqli_query($connect, $sql);
                $resultCheck = mysqli_num_rows($result);
        
                // Fetch all data from row returned
                while ($rows = mysqli_fetch_assoc($result)){
                    echo '<tr><td>'.$rows['beerName'].'</td>';
                    echo '<td>'.$rows['Brewery'].'</td>';
                    echo '<td>'.$rows['beerType'].'</td>';
                    echo '<td>'.$rows['State'].'</td>';
                    echo '<td>'.$rows['City'].'</td>';
                    echo '<td>'.$rows['ABV'].'</td>';
                    echo '<td>'.$rows['IBU'].'</td></tr>';
                }
        
                ?>
            </table>
        </div>
        <div class="col-sm-2"></div>
    </div>
        <img src='Pictures/GPPaleAle.png' alt='Good People Pale Ale' style='width:100px;height:150px;'>
        <?

?>


<?

    // Include Footer 

    include_once 'footer.php';
?>
