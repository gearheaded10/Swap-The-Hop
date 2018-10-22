 $( function() {
    var url_string = window.location.href
    var url = new URL(url_string);
    var abvOne = url.searchParams.get("ABV1");
    var abvTwo = url.searchParams.get("ABV2");
    var abvOneInitial = document.getElementById('ABVInitialOne').getAttribute('data-info');
    var abvTwoInitial = document.getElementById('ABVInitialTwo').getAttribute('data-info');
    console.log(abvOneInitial);
    console.log(abvTwoInitial);
    console.log(abvOne); // percentage
    console.log(abvTwo); // percentage
    
    if(abvOne == null){
        abvOne = abvOneInitial;
    }else{
        //abvOne = ((abvTwoInitial)*abvOne)
        console.log(abvOne);
    }
    if(abvTwo == null){
      abvTwo = abvTwoInitial;
    } else {
        //abvTwo = ((abvTwoInitial)*abvTwo)
        console.log(abvTwo);
    }
    
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: abvTwoInitial,
      values: [ abvOne , abvTwo ], // get values passed through URL
      slide: function( event, ui ) {
        $( "#amount" ).val( ui.values[ 0 ] + " % to " + ui.values[ 1 ] + "%");
      }
    });
    $( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) +
      " % to " + $( "#slider-range" ).slider( "values", 1 ) +"%" );

  } );
 