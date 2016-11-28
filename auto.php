
 <?php
    session_start();
 
    include 'data_layer_acces.php'; 
    $db=new dbhelper();
    $x="some";
    if(array_key_exists('customer_name',$_SESSION) && !empty($_SESSION['customer_name'])){ 
        $log_status = $_SESSION['customer_name'];
        $xml= $db->search_item($log_status);
        $x = $xml->product->profile_pic;
     }
    else
        $log_status = "log in";
         
    $db=new dbhelper();
    $xml=$db->get_popular_product();
    


?>

<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
        
    <title>Home | E-Shopper</title>
   
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
  
    <script type="text/javascript" src="//code.jquery.com/jquery-1.8.0.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $(".search_keyword").keyup(function() 
            { 
                var search_keyword_value = $(this).val();
                var dataString = 'search_keyword='+ search_keyword_value;
                if(search_keyword_value!='')
                {
                    $.ajax({
                        type: "POST",
                        url: "search.php",
                        data: dataString,
                        cache: false,
                        success: function(html)
                            {
                                $("#result").html(html).show();
                            }
                    });
                }
                return false;    
            });

            $("#result").live("click",function(e){
                var $clicked = $(e.target);
                var $name = $clicked.find('.country_name').html();	
                var decoded = $("<div/>").html($name).text();
                $('#search_keyword_id').val(decoded);
            });

            $(document).live("click", function(e) { 
                var $clicked = $(e.target);
                if (! $clicked.hasClass("search_keyword")){
                    $("#result").fadeOut(); 
                }
            });

            $('#search_keyword_id').click(function(){
                $("#result").fadeIn();
            });
            });
            </script>
</script>
    <style>
     
       	.web{
		font-family:tahoma;
		size:12px;
		top:10%;
		border:1px solid #CDCDCD;
		border-radius:10px;
		padding:10px;
		width:38%;
		margin:auto;
	}
	
	#result
	{
		position:absolute;
		width:320px;
		display:none;
		margin-top:-1px;
		border-top:0px;
		overflow:hidden;
		border:1px #CDCDCD solid;
		background-color: white;
	}
	.show
	{
		font-family:tahoma;
		padding:10px; 
		border-bottom:1px #CDCDCD dashed;
		font-size:15px; 
	}
	.show:hover
	{
		background:#364956;
		color:#FFF;
		cursor:pointer;
	} 
    input[type=search]{
        width:480px;height:49px; border:3px solid black;
        padding-left:48px;
        padding-top:1px;
        font-size:22px;
        color:blue;
        border-color: orange;
        border-radius: 4px ;
        box-sizing: border-box;
        background-repeat:no-repeat;
        background-position:center;outline:0;
        }

        input[type=search]::-webkit-search-cancel-button{
            position:relative;
            right:20px;  

            -webkit-appearance: none;
            height: 20px;
            width: 20px;
            border-radius:10px;
            background: red;
        }  
     .user {
            display: inline-block;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-repeat: no-repeat;
            background-position: center center;
            background:green;
            background-size: cover;
            font-size:30px;
            text-align:center;
            color:#fff;

          }

          .one {
            
          }    
      
       
        
         input[type=submit] {
               width: 6%;
               border: 1px solid #ccc;
               color: blueviolet;
               border-color: white;
               
               background-repeat: no-repeat;
               background-size: 80px 60px;
               height:49px;
         }
               
       
         .container-2 .icon{
               position: absolute;
               top: 50%;
               margin-left: 17px;
               margin-top: 17px;
               z-index: 1;
               color: #4f5b66;
             }
       
        body {
            background-color:white;
        }
    </style>

</head>
 
<body>
    <form method="post" action="OtherPage.php">
                                            
          <input type="search" class="search_keyword" id="search_keyword_id" placeholder="search product"  />                      
                <input type="submit" name="submit" id="submit" value="S">
            <div id="result"></div>
                                                    
    </form>  
    
    
    
    
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script> 
   
</body>
</html>
 
