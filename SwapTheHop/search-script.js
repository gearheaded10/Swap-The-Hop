 $(document).ready(function(){
     
    jQuery("#state").change(function () {
        $('#City').prop('disabled', false);
        var stateVal = $("#state").val();
        //var myJSON = JSON.stringify(stateVal);
        window.location = "index.php?search=1&State=" + stateVal;
        //$("#stateVal").html(" $stateVal=" + stateVal + "; ");
    });

    $("#search-reset").click(function(event){
        event.preventDefault();
        window.location.replace("index.php");
    });
    $("#search-submit").click(function(event){
        event.preventDefault(); // prevent default page action on event
        // set state variable
        var state = $("#state").val();
        // set city variable
        var city = $("#City").val();
        // set Brewery variable
        var brewery = $("#brewery").val();
        // set style variable
        var style = $("#style").val();
        // set abv variabes
        var ABV_1 = $( "#slider-range" ).slider( "values", 0 );
        var ABV_2 = $( "#slider-range" ).slider( "values", 1 );
        // set ibu variables
        var IBU_1 = $( "#slider-range-IBU" ).slider( "values", 0 );
        var IBU_2 = $( "#slider-range-IBU" ).slider( "values", 1 );
        // set keyword values
        var keywords = $("#keywords").val();
        keywords = keywords.replace(/\s+/g, '-').toLowerCase();
        // set page varible
        var page = "<?php echo $page; ?>";
        // set search variable
        var searchSubmit = $("#search-submit").val();
        var searchReset = $("#search-reset").val;
        
        // AJAX
        $(".message").load("filter-process.php", {
            state: state,
            city: city,
            brewery: brewery,
            style: style,
            ABV_1: ABV_1,
            ABV_2: ABV_2,
            IBU_1: IBU_1,
            IBU_2: IBU_2,
            keywords: keywords,
            page: page,
            searchSubmit: searchSubmit
        });
    });
});