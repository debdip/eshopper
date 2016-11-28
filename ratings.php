<html>
    <head>
        <style>
span.stars, span.stars span {
    display: block;
    background: url(stars.png) 0 -16px repeat-x;
    width: 80px;
    height: 16px;
}

span.stars span {
    background-position: 0 0;
}
    </style>
    <script>
  $.fn.stars = function() {
    return $(this).each(function() {
        // Get the value
        var val = parseFloat($(this).html());
        // Make sure that the value is in 0 - 5 range, multiply to get width
        var size = Math.max(0, (Math.min(5, val))) * 16;
        // Create stars holder
        var $span = $('<span />').width(size);
        // Replace the numerical value with stars
        $(this).html($span);
    });
}  

val = Math.round(val * 4) / 4; /* To round to nearest quarter */
val = Math.round(val * 2) / 2; /* To round to nearest half */


$(function() {
    $('span.stars').stars();
});



    </script>
    </head>
       
    
    <body>
  <span class="stars">4.8618164</span>
<span class="stars">2.6545344</span>
<span class="stars">0.5355</span>
<span class="stars">8</span>
    </body>
</html>