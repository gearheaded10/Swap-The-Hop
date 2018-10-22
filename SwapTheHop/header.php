<!-- Close the Body of the HTML document -->

<?php
// make sure a session is running if user is logged in
session_start();

// include database connection
include_once "DBC.php";
?>
<!-- Start Header Document -->
<!DOCTYPE html>
<html lang="en"> <!-- set language to english for bootstrap -->
<!-- Define the head of the HTML document -->
<head>
    <!-- make title of page -->
    <title>Swap The Hop || Home </title>
    <!-- make character set -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- croppie -->
    <script src="Croppie/croppie.js"></script> 
    <link rel="stylesheet" href="Croppie/croppie.css" />
    <!-- ajax script for filter function-->
    <script src="search-script.js"></script>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>   
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
     <!-- style sheet to over ride bootstrap-->
    <link rel = "stylesheet" type ="text/css" href="Bootstrap-Override-Stylesheet.css?v=<?=time();?>"> 
    <!-- script UI for slider -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Include slider.js -->
    <script src="slider.js"> </script>
    <!-- Include IBU_slider.js -->
    <script src="IBU_Slider.js"> </script>
    <!-- Include Whitespace convert -->
    <script src="whitespaceconvert.js"></script>


</head>

<!-- ------------------------------------  -->
<!-- Define the Body of the HTML document  -->
<!-- ------------------------------------  -->

<body>
    <!-- start div to create 100% height -->
<div class="sth-overall-container">
    <div class="sth-main">

    <!-- create Navigation Bar -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <!-- Create Header Text -->
                <a class="navbar-brand" href="index.php">Swap The Hop</a>
            </div>
            <div class="navbar-header ml-auto">
                    <!-- Create Nav Bar Button for Mobile-->
                    <button class="navbar-toggler hidden-sm-up" data-toggle="collapse" data-target="#myNavBar"><i class="fas fa-bars"></i></button>
            </div>
            <div class="collapse navbar-collapse"  id="myNavBar">
                <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="addBeer.php">Add <i class="fas fa-beer"></i> <!-- Beer icon --></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Contact</a>
                    </li>
                    <li>
                        <a class="nav-link" href="#">
                            <i class="fas fa-shopping-cart"></i> <!-- shopping cart icon -->
                            &nbsp; Cart
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-no-decoration" data-toggle="dropdown" href=""><span class="caret"></span>&nbsp;Profile &nbsp;<i class="fas fa-user"></i></a>
                        <ul class="dropdown-menu">
                            <li>
                                <!--<a class="text-no-decoration" href="#">   -->   
                                    <?php
                                    // include login page for user login handling
                                    echo "<div class='login'>";
                                        include_once "loginpage.php";
                                    echo "</div>";
                                    ?>
                                <!--</a>-->
                            </li>
                        </ul>
                    </li>
                </ul>
                <form class="navbar-form ml-auto">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                    <div class="input-group-prepend">
                        <button class="btn btn-secondary" type="button">Search</button>
                    </div>
                </div> 
                </form>        
            </div>
        </div>
    </nav>
    <!-- create large banner -->
    <!--<div class="jumbotron jumbotron-fluid">
    </div>-->


        <!-- start bootstrap styling -->
        <section class="main-container"> <!-- create section--> 
            <div class="container-fluid">

                <?php
                            // inbclude login page for user login handling
                            echo "<div style='text-decoration:none;'class='login'>";
                                include_once "loginpage.php";
                            echo "</div>";
                            ?>