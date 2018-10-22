 $( function() {
    var url_string = window.location.href
    var url = new URL(url_string);
    var ibuOne = url.searchParams.get("IBU1");
    var ibuTwo = url.searchParams.get("IBU2");
    var ibuOneInitial = document.getElementById('IBUInitialOne').getAttribute('data-info');
    var ibuTwoInitial = document.getElementById('IBUInitialTwo').getAttribute('data-info');
    //console.log(ibuOneInitial);
    //console.log(ibuTwoInitial);
    console.log(ibuOne); // percentage
    console.log(ibuTwo); // percentage
    
    if(ibuOne == null){
       ibuOne = ibuOneInitial;
    }else{
       // ibuOne = ((ibuTwoInitial)*ibuOne)
        console.log(ibuOne);
    }
    if(ibuTwo == null){
      ibuTwo = ibuTwoInitial;
    } else {
        //abvTwo = ((abvTwoInitial)*abvTwo)
        console.log(ibuTwo);
    }
    
    $( "#slider-range-IBU" ).slider({
      range: true,
      min: 0,
      max: ibuTwoInitial,
      values: [ ibuOne , ibuTwo ], // get values passed through URL
      slide: function( event, ui ) {
        $( "#bitterness" ).val( ui.values[ 0 ] + "  to " + ui.values[ 1 ] + " ");
      }
    });
    $( "#bitterness" ).val( $( "#slider-range-IBU" ).slider( "values", 0 ) +
      "  to " + $( "#slider-range-IBU" ).slider( "values", 1 ) +" " );

  } );
 