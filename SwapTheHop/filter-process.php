<?php
if(isset($_POST['searchSubmit'])){
    $state = $_POST['state'];
    $city = $_POST['city'];
    $brewery = $_POST['brewery'];
    $style = $_POST['style'];
    $ABV_1 = $_POST['ABV_1'];
    $ABV_2 = $_POST['ABV_2'];
    $IBU_1 = $_POST['IBU_1'];
    $IBU_2 = $_POST['IBU_2'];
    $keywords = $_POST['keywords'];
    $page = $_POST['page'];
    $search = $_POST['searchSubmit'];
        
}
?>

<script type="text/javascript">
var state = "<?php echo $state; ?>";
var city = "<?php echo $city; ?>";
var brewery = "<?php echo $brewery; ?>";
var style = "<?php echo $style; ?>";
var ABV1 = "<?php echo $ABV_1; ?>";
var ABV2 = "<?php echo $ABV_2; ?>";
var IBU1 = "<?php echo $IBU_1; ?>";
var IBU2 = "<?php echo $IBU_2; ?>";
var keywords = "<?php echo $keywords; ?>";
var search = "<?php echo $search; ?>";
var url = "index.php?search=1";
var count = 0;


// create URL
// set state
if(state === ""){
    url = url;
} else {
    url = url + "&State=" + state;
    count = count +1;
}

// set city
if(city === ""){
    url = url;
} else {
    url = url + "&City=" + city;
    count = count +1;
}

// set brewery
if(brewery === ""){
    url = url;
} else {
    url = url + "&brewery=" + brewery;
    count = count +1;
}

// set style
if(style === ""){
    url = url;
} else {
    url = url + "&style=" + style;
    count = count +1;
}

// set ABV 1
if(ABV1 === ""){
    url = url;
} else{
    url = url + "&ABV1=" + ABV1;
    count = count +1;
}

// set ABV 2
if(ABV2 === ""){
    url = url;
} else{
    url = url + "&ABV2=" + ABV2;
    count = count +1;
}

// set IBU 1
if(IBU1 === ""){
    url = url;
} else{
    url = url + "&IBU1=" + IBU1;
    count = count +1;
}

// set IBU 2
if(IBU2 === ""){
    url = url;
} else{
    url = url + "&IBU2=" + IBU2;
    count = count +1;
}

if(keywords === ""){
    url = url;
} else{
    url = url + "&keywords=" + keywords;
    count = count +1;
}

url = url + "&count=" + count;

console.log(search);

// redirect to URL
if(search === 2){
    window.location.replace("index.php"); 
} else{
    window.location.replace(url); 
}
</script>