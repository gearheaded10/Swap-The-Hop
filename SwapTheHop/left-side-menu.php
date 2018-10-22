 <?php
 include_once 'DBC.php';
 
 //get page variable if it exists
 if(isset($_GET['page'])){
     $page = $_GET['page'];
 }else{
     $page = 1;
 }
 ?>

 <h3> Filter Results </h3>
    <!-- Create form -->
    <form id="search-form" method="post" action="" >
    <table style="list-style-type: none;">
        <tr>
            <div class='form-group'>
                <label>State:</label> 
                <select class='form-control' id='state' name = "state">
                    <?php 
                        //make sql query and print results
                        $stateQuery = "SELECT * FROM states";
                        $stateQueryResult = mysqli_query($connect,$stateQuery);
                        // make while loop
                        while($stateQueryLoop=mysqli_fetch_assoc($stateQueryResult)){
                            if($stateQueryLoop['val'] == $_GET['State']){
                                echo '<option selected value='.$stateQueryLoop['val'].'>'.$stateQueryLoop['name'].'</option>';
                                
                            } else {
                                echo '<option value='.$stateQueryLoop['val'].'>'.$stateQueryLoop['name'].'</option>';
                            }

                        }
                        
                        echo '</select>';
                    ?>
            </div>
        </tr>
        <tr>
            <div class='form-group'>
                <label>City:</label>
                    <?php 
                        if(isset($_GET['State'])){
                            echo "<select class='form-control' id='City' name = 'City'>";
                            $stateVal = $_GET['State'];
                        } else {
                            echo "<select Disabled class='form-control' id='City' name = 'City'>";
                        }

                        // make default select option
                        echo "<option value=''> Select </option>";
                        //make sql query and print results
                        if(isset($_GET['State'])){
                            $check_1 = 1;
                            $cityQuery = "SELECT City FROM Beer_List WHERE State = '".$stateVal."'GROUP BY City";
                            $cityQueryResult = mysqli_query($connect,$cityQuery);
                            // make while loop
                            if(isset($_GET['State'])){
                                while($cityQueryLoop=mysqli_fetch_assoc($cityQueryResult)){
                                    if($cityQueryLoop['val'] == $_GET['City']){
                                        echo '<option selected value='.$cityQueryLoop['City'].'>'.$cityQueryLoop['City'].'</option>';
                                    } else {
                                        echo '<option value='.$cityQueryLoop['City'].'>'.$cityQueryLoop['City'].'</option>';
                                    }
                                }
                            }
                        }
                        echo '</select>';
                    ?>
            </div>
        </tr>
        <tr>
        
            <label> Brewery: </label>
            <select class='form-control' id='brewery' name = "brewery">
                <?php
                    $search_style_sql = "SELECT Brewery FROM Beer_List GROUP BY Brewery ";
                    $search_style_sql_result = mysqli_query($connect,$search_style_sql);
                    $search_style_sql_search_rows = mysqli_num_rows($search_style_sql_result);
                    
                    // make select option
                    echo "<option value=''>Select</option>";
                    
                    while($search_style_loop=mysqli_fetch_assoc($search_style_sql_result)){
                        if(preg_replace("/[\s_]/", "-", $search_style_loop['Brewery']) == $_GET['brewery']){
                            echo '<option selected value='.preg_replace("/[\s_]/", "-", $search_style_loop['Brewery']).'>'.$search_style_loop['Brewery'].'</option>';
                        } else{
                            echo '<option value='.preg_replace("/[\s_]/", "-", $search_style_loop['Brewery']).'>'.$search_style_loop['Brewery'].'</option>';
                        }
                    }
                ?>
            </select>
        </tr>
        <tr>
        </br>
            <label> Style: </label>
            <select class='form-control' id='style' name = "style">
                <?php
                    $search_style_sql_two = "SELECT beerType FROM Beer_List GROUP BY beerType ";
                    $search_style_sql_result_two = mysqli_query($connect,$search_style_sql_two);
                    $search_style_sql_search_rows_two = mysqli_num_rows($search_style_sql_result_two);
                    
                    // make select option
                    echo "<option value=''>Select</option>";
                    
                    while($search_style_loop_two=mysqli_fetch_assoc($search_style_sql_result_two)){
                        if($search_style_loop_two['beerType'] == $_GET['style']){
                            echo '<option selected value='.$search_style_loop_two['beerType'].'>'.$search_style_loop_two['beerType'].'</option>';
                        } else{
                            echo '<option value='.$search_style_loop_two['beerType'].'>'.$search_style_loop_two['beerType'].'</option>';
                        }

                    }
                ?>
            </select>
        </tr>
        </br>
            <label> ABV: </label>
            </br>
                <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
            <div id="slider-range"></div> <!-- placeholder for javascript -->
        </tr>
        <tr>
            </br>
             <label> IBU: </label>
            </br>
                <input type="text" id="bitterness" readonly style="border:0; color:#f6931f; font-weight:bold;">
            <div id="slider-range-IBU"></div> <!-- placeholder for javascript -->
        </tr>
        <tr>
            </br>
            <div class="form-group">
            <label> Keywords: </label>
            </br>
            <input type="text" id="keywords" class="form-control" name="keywords">
            </div>
        </tr>
        <tr>
            </br>
            <button class="btn btn-primary btn-block" id="search-submit" type="submit" name="search-submit" > Filter </button>
        </tr>
        <tr>
            </br>
            <button class="btn btn-secondary btn-block" id="search-reset" type="submit" name="search-reset" > Start Over </button>
        </tr>
        </table>
        <p class="message"> </p>
    </form>
    
    
   <!-- reference   <option id='1' value="">Select</option>
                    <option id='2' value="AL">Alabama</option>
                    <option id='3' value="AK">Alaska</option>
                    <option id='4' value="AZ">Arizona</option>
                    <option id='5' value="AR">Arkansas</option>
                    <option id='6' value="CA">California</option>
                    <option id='7' value="CO">Colorado</option>
                    <option id='8' value="CT">Connecticut</option>
                    <option id='9' value="DE">Delaware</option>
                    <option id='10' value="DC">District Of Columbia</option>
                    <option id='11' value="FL">Florida</option>
                    <option id='12' value="GA">Georgia</option>
                    <option id='13' value="HI">Hawaii</option>
                    <option id='14' value="ID">Idaho</option>
                    <option id='15' value="IL">Illinois</option>
                    <option id='16' value="IN">Indiana</option>
                    <option id='17' value="IA">Iowa</option>
                    <option id='18' value="KS">Kansas</option>
                    <option id='19' value="KY">Kentucky</option>
                    <option id='20' value="LA">Louisiana</option>
                    <option id='21' value="ME">Maine</option>
                    <option id='22' value="MD">Maryland</option>
                    <option id='23' value="MA">Massachusetts</option>
                    <option id='24' value="MI">Michigan</option>
                    <option id='25' value="MN">Minnesota</option>
                    <option id='26' value="MS">Mississippi</option>
                    <option id='27' value="MO">Missouri</option>
                    <option id='28' value="MT">Montana</option>
                    <option id='29' value="NE">Nebraska</option>
                    <option id='30' value="NV">Nevada</option>
                    <option id='31' value="NH">New Hampshire</option>
                    <option id='32' value="NJ">New Jersey</option>
                    <option id='33' value="NM">New Mexico</option>
                    <option id='34' value="NY">New York</option>
                    <option id='35' value="NC">North Carolina</option>
                    <option id='36' value="ND">North Dakota</option>
                    <option id='37' value="OH">Ohio</option>
                    <option id='38' value="OK">Oklahoma</option>
                    <option id='39' value="OR">Oregon</option>
                    <option id='40' value="PA">Pennsylvania</option>
                    <option id='41' value="RI">Rhode Island</option>
                    <option id='42' value="SC">South Carolina</option>
                    <option id='43' value="SD">South Dakota</option>
                    <option id='44' value="TN">Tennessee</option>
                    <option id='45' value="TX">Texas</option>
                    <option id='46' value="UT">Utah</option>
                    <option id='47' value="VT">Vermont</option>
                    <option id='48' value="VA">Virginia</option>
                    <option id='49' value="WA">Washington</option>
                    <option id='50' value="WV">West Virginia</option>
                    <option id='51' value="WI">Wisconsin</option>
                    <option id='52' value="WY">Wyoming</option> -->
    