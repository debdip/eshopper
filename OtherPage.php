 <?php
   
    session_start();
    $_SESSION[100] = 'kamrul';
    
   include 'business_layer.php'; 
    $db=new business_layer();
    $k=0;
    $number_of_product = $db->get_number_of_product();
    for($j=1;$j<=$number_of_product;$j++){       
       if(!isset($_COOKIE[$j])){        
            $i=0;       
            for($i=1;$i<=$number_of_product;$i++){
                setcookie($i,0,time()+3600);
            }
            $total_cart=0;
            $flag1=0;
            header("location:OtherPage.php");
        }
        
    }
    if(!isset($flag1)) {
        
        if(isset($_GET['id'])){
           
            $id = $_GET['id'];
            $value = $_COOKIE[$id]+1;
            
            setcookie($id, $value, time()+3600);
            $k=1;
            header("location:OtherPage.php");
        }
        if(isset($_GET["rid"])){
            $id = $_GET["rid"];
            
            echo $_COOKIE[$id];
            $value = $_COOKIE[$id]-1;
            setcookie($id, $value, time()+3600);
            $k=1;
            header("location:OtherPage.php");
           
        
        }
       
            $total_cart = 0;
            for($i=1;$i<=$number_of_product;$i++){
                $total_cart = $_COOKIE[$i]+$total_cart;
            }
            
    }
    if(isset($_GET['cid'])){
        $cid = $_GET['cid'];
        $comp_prod = $db->get_product_name($cid);
        unset($_SESSION[$comp_prod]);
    }
    
        if(isset($_GET['comp_prod'])){
                $comp_id= $_GET['comp_prod'];
                $_SESSION[$comp_id] = 'ok'; 
    }
    
    
    if(isset($_COOKIE['customer_name'])){       
         $_SESSION['customer_name'] = $_COOKIE['customer_name'];
     }
    $x="some";
    if(array_key_exists('customer_name',$_SESSION) && !empty($_SESSION['customer_name'])){ 
        $log_status = $_SESSION['customer_name'];
        $xml= $db->search_item($log_status);
        $x = $xml->product->profile_pic;
     }
    else
        $log_status = "sign in";
    
    if(isset($_POST["price"])){
        $flag = 1;
       
        $price = $_POST["price"];
        
        $xml=$db->getProduct_as_price($price);
        
        if(count($xml) > 0)
            $_SESSION['key'] = "price 10,000 to ".$price;
        else 
            $_SESSION['key'] = "";
        $name = $_SESSION['key'];
         
    }    
    else{
        if(isset($_POST["name"])){
             $_SESSION['key'] = $_POST["name"];                        
        }
        
        else if(isset ($_GET["name"])){
            $_SESSION['key'] = $_GET["name"];
        }
        $flag = 1;
        $name=$_SESSION['key'];
          if($name != ""){
                 $xml = $db->get_product_asSearch($name);    
                if(count($xml)== 0){
                     $name=$db->get_similar_product($name);
                     $xml = $db->get_product_asSearch($name);         
                     $flag = 0;
                }
            }
            
        }
    
        if($name == "") 
         $name = "no results found";
    
           
        
    
    


?>
<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
        
    <title> E-Shopper</title>
   
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
	
	
	.show
	{
		font-family:tahoma;
		padding:10px; 
		border:1px #CDCDCD dashed;
                background-color:white;
		font-size:15px; 
                width:50%;
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
        padding-top:0px;
        font-size:22px;
        color:blue;
        
        border-radius: 4px ;
        box-sizing: border-box;
        background-repeat:no-repeat;
        background-position:center;outline:0;
        margin-left:100px;
        
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
            width: 70px;
            height: 70px;
            border-radius: 60%;
            background-repeat: no-repeat;
            background-position: center center;
            background:green;
            background-size: cover;
            font-size:30px;
            text-align:center;
            color:#fff;

          }

          .one {
            background-image:  url(<?php echo $x; ?>);  
            
          }    
      
       
        
         input[type=submit] {
               
               border: 1px solid #ccc;
               color: white;
               background-color:#550c6b;
               border-color:black;
               
               background-repeat: no-repeat;
               background-size: 17px 17px;
               height:43px;
         }
         
         .button {
                background-color: #4CAF50;
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
            }
       input[type=button]{
                color:orange;
                background-color: white;
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
        #container {
            height: 4px;
            width: 40px;
            position: relative;
          }
          #image {
            position: absolute;
            left: 0;
            top: 0;
          }
          #text {
            z-index: 100;
            position: absolute;
            color:orange;
            font-size: 24px;
            font-weight: bold;
            
            left: 26px;
            top:0px;
          }
          #text2 {
            z-index: 100;
            position: absolute;
            color:orange;
            font-size: 14px;
           
            
            left: 2px;
            top:25px;
          }
           #text3 {
            z-index: 100;
            position: absolute;
            color:orange;
            font-size: 14px;
            
            
            left: 4px;
            top:30px;
          }
          
          
     cart{
            background: none repeat scroll 0 0 white;
            border: 5px solid #DFDFDF;
            color: orange;
            font-size: 13px;
            height: 500px;
            width: 500px;
            letter-spacing: 1px;
            line-height: 30px;
            margin: 5px;
            position: relative;
            text-align: left;
            
            top: 5px;
            left:-400px;
            display:none;
            padding:0 20px;
            overflow:scroll;

        }
        compare1{
            background: none repeat scroll 0 0 white;
            border: 5px solid #DFDFDF;
            color: orange;
            font-size: 14px;
            height: 700px;
            width: 700px;
            letter-spacing: 1px;
            line-height: 30px;
            margin: 5px;
            position: relative;
            text-align: left;
            
            top: 5px;
            left:-500px;
            display:none;
            padding:0 20px;
            overflow:scroll;

        }
         compare2{
            background: none repeat scroll 0 0 white;
            border: 5px solid #DFDFDF;
            color: orange;
            font-size: 13px;
            height: 900px;
            width: 1200px;
            letter-spacing: 1px;
            line-height: 30px;
            margin: 5px;
            position: relative;
            text-align: left;
            
            top: 5px;
            left:-800px;
            display:none;
            padding:0 20px;
            overflow:scroll;

        }      
        
        
        
        

        p2{
            left: 1000px;

            float:left;
            position:relative;
            cursor:pointer;
        }
         p3{
            left: 1000px;

            float:left;
            position:relative;
            cursor:pointer;
        }
        
        
       p4{
            left: 1000px;

            float:left;
            position:relative;
            cursor:pointer;
        }

        p2:hover cart{
            display:block;
        }
        
        p3:hover compare1{
            display:block;
        }
        
        p4:hover compare2{
            display:block;
        }
        
        
        #t1 {
    
            tab-size: 4;
        }

        table#t01 tr:nth-child(even) {
            background-color: #eee;
        }
        table#t01 tr:nth-child(odd) {
           background-color:#fff;
        }
        table#t01 th	{
             padding:0 12px 0 12px;
            background-color: whitesmoke;
            color: green;
        }
        table#t01 td	{
             padding:0 10px 0 10px;
            background-color: white;
            color: black;
        }
        select{
          background-color:#041a33;
            color:whitesmoke;
            margin-top:13px;
            font-size:20px;
        }
    </style>

</head><!--/head-->

<body>
    
    
	<header id="header" style="background-color:#041a33">			
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
                                                    <a href="homepage.php"><img src="images/home/logo.jpg" height="90px" width="90px"/></a>
						</div>						
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
                                                        <li><a href="homepage.php"style="background-color:#041a33;margin-top: 19px;"><font color="whitesmoke" size="4.5px">home</font></a></li>
                                                        <li>
                                                           <?php 
                                                           if(isset($_SESSION['admin'])){
                                                               if($_SESSION['admin']=='admin1'){
                                                           ?>
                                                            <select name="action" onchange="location = this.value;" >
                                                                    <option selected="true" disabled>admin mode</option>
                                                                    <option value="admin1.php?action=add_comp" >add new computer</option>
                                                                    <option value="admin1.php?action=add_tv" >add new tv</option>
                                                                    <option value="admin1.php?action=update_comp" >update computer</option>
                                                                    <option value="admin1.php?action=update_tv" >update tv</option>
                                                                    <option value="admin1.php?action=delete" >delete product</option>
                                                                   
                                                                </select>
                                                              <?php 
                                                               }
                                                               else {
                                                               ?>
                                                             <select name="action" onchange="location = this.value;">
                                                                    <option selected="true" disabled>admin mode</option>
                                                                    <option value="homepage.php?action=status" >Update Order Status</option>
                                                                    <option value="homepage.php?action=order" >delete Order</option>
                                                                   
                                                                </select>
                                                            <?php
                                                              }
                                                           }?>
                                                                
                                                            
                                                        </li> 
                                                           <li>
                                                            <select name="compare" onchange="location=this.value;">
                                                                <option selected="true" disabled>Compare</option>
                                                                <option value="compare.php?computer=ok" >Computer</option>
                                                                <option value="compare.php?tv=ok" >TV</option>
                                                                   
                                                            </select>
                                                        </li>  
                                                                                                                    
                                                         
                                                            
                                                            
                                                                    <li style="margin-right: 30px;" >
                                                                         <div id="container">
                                                                            
                                                                             <img id="image" style="top:5px;height: 45px;width: 45px;" src="images/home/cart.jpg" alt="" />Cart
                                                                           <p2 id="text"><?php echo $total_cart; ?> 
                                                                               <cart>
                                                                                   Your Cart<br>
                                                                                    <?php
                                                                                      for($j=1;$j<=$number_of_product;$j++){
                                                                                                if($_COOKIE[$j] > 0){
                                                                                                $check = 1;
                                                                                                } 
                                                                                       }
                                                                                       if(isset($check)){
                                                                                     ?>
                                                                                       
                                                                                       <a href="OrderPage.php?id=<?php echo $j;?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><font color="orange">Order</font></a>
                                                                                     
                                                                                          <?php  for($j=1;$j<=$number_of_product;$j++){
                                                                                                if($_COOKIE[$j] > 0){
                                                                                                    $xml2=$db->search_product_info($j);
                                                                                                    if($xml2!='null'){
                                                                                                        $price = $xml2->product->price*$_COOKIE[$j];
                                                                                                        echo '<pre id=t1>'.$xml2->product->product_name."    price:".$price."$   items: ".$_COOKIE[$j].'<form action="OtherPage.php" method="get"><input type ="hidden" name="rid" value="'.$j.'"><input type ="submit" name="remove" value="remove"></form>'.'</pre>'.'<hr>';
                                                                                                    }

                                                                                                }

                                                                                                                                                            
                                                                                            }
                                                                                            
                                                                                    
                                                                                    }
                                                                                    
                                                                                    ?>
                                                                               </cart></p2>
                                                                        </div>
                                                            </li><!--cart.html-->
                                                                <?php 
                                                                
                                                                if($x=="null"){
                                                                 $s=  substr($log_status,0,1);
                                                                 echo '<div class="user">'.$s.'</div>';
                                                                 $_SESSION["status"]="logged in";
                                                                 $log_status="logout";
                
                                                                 
                                                                }
                                                                else if($x!="some"){
                                                                    echo '<div class="user one"> </div>' ;
                                                                    $_SESSION["status"]="logged in";
                                                                    $log_status="logout";
                                  
                                                                }
                                                              
                                                                ?>
                                                               <li><?php if($log_status == 'logout'){ ?>
                                                                    <a href="signin.php" style="background-color:#041a33;margin-top: 19px;"><i class="fa fa-lock"></i><font color="whitesmoke" size=5px;>log out</font></a></li>
                                                                <?php } else { ?>
                                                                    <li><a href="signin.php" style="background-color:#041a33;margin-top: 19px;"><i class="fa fa-lock"></i><font color="whitesmoke" size=5px;>log in</font></a></li>
                                                                <?php } ?> 
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-10">	   
                                            
                                                 <form method="post" action="OtherPage.php">
                                                     
                                                     <input type="search" name="name" class="search_keyword" id="search_keyword_id" autocomplete="off" placeholder="search product" />                      
                                                     <input type="submit" name="submit"   style="width:10%;" value="search">
                                                         <div id="result"></div>
                                                     
                                                    </form>                                                   
                                        </div>
				</div>
			</div>
		</div><!--/header-middle-->
                
                  
	</header><!--/header--> 
	
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default">
								<div class="panel-heading">
                                                                    <h4 class="panel-title"><a href="OtherPage.php?name=laptop"><font color="orange">laptop</font></a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
                                                                    <h4 class="panel-title"><a href="OtherPage.php?name=notebook"><font color="orange">notebook</font></a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
                                                                    <h4 class="panel-title"><a href="OtherPage.php?name=tv"><font color="orange">television</font></a></h4>
								</div>
							</div>
							
							<div class="panel panel-default">
								<div class="panel-heading">
                                                                    <h4 class="panel-title"><a href="OtherPage.php?name=desktop"><font color="orange">Desktop</font></a></h4>
								</div>
							</div>
							
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Brands</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
                                                                    <li><a href="OtherPage.php?name=hp"> <span class="pull-right"></span><font color="orange">hp</font></a></li>
                                                                    <li><a href="OtherPage.php?name=dell"> <span class="pull-right"></span><font color="orange">dell</font></a></li>
                                                                    <li><a href="OtherPage.php?name=apple"> <span class="pull-right"></span><font color="orange">apple</font></a></li>
                                                                    <li><a href="OtherPage.php?name=toshiba"> <span class="pull-right"></span><font color="orange">toshiba</font></a></li>
                                                                    <li><a href="OtherPage.php?name=samsung"> <span class="pull-right"></span><font color="orange">samsung</font></a></li>
                                                                    <li><a href="OtherPage.php?name=asus"> <span class="pull-right"></span><font color="orange">asus</font></a></li>
                                                                    <li><a href="OtherPage.php?name=walton"> <span class="pull-right"></span><font color="orange">walton</font></a></li>
								</ul>
							</div>
						</div><!--/brands_products-->
						
								
						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well text-center">
                                                            <form action="OtherPage.php" method="post">
                                                                <input type="number" name="price" class="span2" value="" data-slider-min="10000" data-slider-max="200000" data-slider-step="10000" data-slider-value="[10000]" id="sl2" ><br />
								 <b class="pull-left">$10000</b> <b class="pull-right">$200000</b>
                                                                 <button type="submit"  class="button" >ok</button>
                                                            </form>
                                                         </div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<!--img src="images/home/shipping.jpg" alt="" /-->
						</div><!--/shipping-->
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center"><br><?php                 
                                                                                    if($flag == 0)
                                                                                    echo '<a href="OtherPage.php?name='.$name.' " > '.'<font color=#635866 size=5px> '.'Did you mean   '.'</font>' .'<i>'.'<font size=5px>'.$name.'</font>'.'</i>'.'</a>';    
                                                                                    else echo $name; ?> </h2>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
                                                                                   <?php
                                                                                  if($name != "no results found"){
                                                                                        $n =(int) ceil(count($xml)/3);
                                                                                        for($i=0;$i<$n;$i++){
                                                                                            $img =$xml->product[$i]->path;                                                                                                                                                                                               
                                                                                            echo '<img src ="'.$img.'">';                                                                                   
                                                                                            echo '<font color=red>'.$xml->product[$i]->price .'</font>'.'/=';             
                                                                                            echo nl2br("\n");
                                                                                            echo '<font color=blue size=3px>'.$xml->product[$i]->product_name.'</font>';

                                                                                            //echo nl2br('<details> <summary>details</summary><p>"'.$xml->product[$i]->configuration.'"</p> </details>'); 
                                                                                            $name_1 = $xml->product[$i]->product_name;
                                                                                            if($xml->product[$i]->category_name != 'tv'){
                                                                                                $xml_1 = $db->get_computer_configuration($name_1);

                                                                                            ?>
                                                                                                <details style="color:black;font-size: 17px;">

                                                                                                <?php
                                                                                                echo 'brand :'.$xml_1->product->brand.'<br>';
                                                                                                echo 'processor : '.$xml_1->product->Processor.'<br>';
                                                                                                echo 'clock_speed:'.$xml_1->product->clock_speed.'<br>';
                                                                                                echo 'cache:'.$xml_1->product->cache.'<br>';
                                                                                                echo 'display_type:'.$xml_1->product->display_type.'<br>';
                                                                                                echo 'display_size:'.$xml_1->product->display_size.'<br>';
                                                                                                echo 'ram : '.$xml_1->product->ram.'<br>';
                                                                                                echo 'ram_type : '.$xml_1->product->ram_type.'<br>';
                                                                                                echo 'storage: '.$xml_1->product->storage.'<br>';
                                                                                                echo 'graphics: '.$xml_1->product->graphics_chipset.'<br>';

                                                                                                ?>
                                                                                                </details> 
                                                                                                <?php }
                                                                                            else{
                                                                                              $xml_1 = $db->get_tv_configuration($name_1);
                                                                                              ?>
                                                                                            <details style="color:black;font-size: 17px;">
                                                                                                <?php
                                                                                                echo 'brand : '.$xml_1->product->brand.'<br>';
                                                                                                echo 'display_size : '.$xml_1->product->display_size.'<br>';
                                                                                                echo 'monitor : '.$xml_1->product->monitor;
                                                                                                ?>
                                                                                            </details>
                                                                                            <?php
                                                                                           }
                                                                                           ?>

                                                                                            <a href="OtherPage.php?id=<?php echo $xml->product[$i]->product_id;?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a> 
                                                                                            <a href="OtherPage.php?comp_prod=<?php echo $xml->product[$i]->product_name;?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to Compare</a> 
                                                                                            <br>
                                                                                                   <?php
                                                                                                $id = $xml->product[$i]->product_id;
                                                                                                $ratingRow = $db->get_rating($id);
                                                                                                $n = $ratingRow['average_rating'];
                                                                                                 echo 'Ratings: ';
                                                                                                for($l=1;$l<=$n;$l++){
                                                                                                    ?><img src="images/star_highlight.png" style="height:18px;width: 18px;"><?php
                                                                                                }

                                                                                                for($l2=$l;$l2<=5;$l2++){
                                                                                                    ?><img src="images/star_full.png" style="height:20px;width: 20px;"><?php
                                                                                                }
                                                                                                if($log_status != 'sign in'){
                                                                                                     ?>
                                                                                                     <br><a href="index.php?id= <?php echo $xml->product[$i]->product_id;?> ">Rate it</a>
                                                                                                 <?php
                                                                                                   }    
                                                                                                
                                                                                                
                                                                                        }
                                                                                  } 
                                                                                  ?>
                                                                                </div>										
								</div>
								
							</div>
						</div>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
                                                                                    <?php
                                                                                     if($name != "no results found"){
                                                                                            $n = (int) ceil(count($xml)/3);
                                                                                            $m = (int)  ceil(2*(count($xml)/3));

                                                                                          for($i=$n;$i<$m;$i++){
                                                                                                $img =$xml->product[$i]->path;                                                                                                                                                                                               
                                                                                                echo '<img src ="'.$img.'">';                                                                                   
                                                                                                echo '<font color=red>'.$xml->product[$i]->price.'</font>'.'/=';

                                                                                               echo '<font color=blue size=3px>'.$xml->product[$i]->product_name.'</font>';
                                                                                                //echo '<details> <summary>details</summary><p>"'.$xml->product[$i]->configuration.'"</p> </details>';
                                                                                              $name_1 = $xml->product[$i]->product_name;
                                                                                              if($xml->product[$i]->category_name != 'tv'){
                                                                                                        $xml_1 = $db->get_computer_configuration($name_1);
                                                                                                   //print_r($xml_1);
                                                                                                   //echo nl2br('<details> <summary>details</summary><p>"'.$xml_1->product->product_name.'"</p> </details>');

                                                                                                   ?>
                                                                                                    <details style="color:black;font-size: 17px;">

                                                                                                        <?php
                                                                                                        echo 'brand :'.$xml_1->product->brand.'<br>';
                                                                                                        echo 'processor : '.$xml_1->product->Processor.'<br>';
                                                                                                        echo 'clock_speed:'.$xml_1->product->clock_speed.'<br>';
                                                                                                        echo 'cache:'.$xml_1->product->cache.'<br>';
                                                                                                        echo 'display_type:'.$xml_1->product->display_type.'<br>';
                                                                                                        echo 'display_size:'.$xml_1->product->display_size.'<br>';
                                                                                                        echo 'ram : '.$xml_1->product->ram.'<br>';
                                                                                                        echo 'ram_type : '.$xml_1->product->ram_type.'<br>';
                                                                                                        echo 'storage: '.$xml_1->product->storage.'<br>';
                                                                                                        echo 'graphics: '.$xml_1->product->graphics_chipset.'<br>';

                                                                                                        ?>
                                                                                                    </details > 
                                                                                                   <?php }
                                                                                                  else{
                                                                                                      $xml_1 = $db->get_tv_configuration($name_1);
                                                                                                      ?>
                                                                                                    <details style="color:black;font-size: 17px;">
                                                                                                        <?php
                                                                                                        echo 'brand : '.$xml_1->product->brand.'<br>';
                                                                                                        echo 'display_size : '.$xml_1->product->display_size.'<br>';
                                                                                                        echo 'monitor : '.$xml_1->product->monitor;
                                                                                                        ?>
                                                                                                    </details>
                                                                                                    <?php
                                                                                                   }
                                                                                                   ?>                                                                                          
                                                                                                         <a href="OtherPage.php?id=<?php echo $xml->product[$i]->product_id;?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a> 
                                                                                                          <a href="OtherPage.php?comp_prod=<?php echo $xml->product[$i]->product_name;?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to Compare</a> 
                                                                                                          <br> <?php 
                                                                                                                              $id = $xml->product[$i]->product_id;
                                                                                                            $ratingRow = $db->get_rating($id);
                                                                                                            $n = $ratingRow['average_rating'];
                                                                                                             echo 'Ratings: ';
                                                                                                            for($l=1;$l<=$n;$l++){
                                                                                                                ?><img src="images/star_highlight.png" style="height:18px;width: 18px;"><?php
                                                                                                            }

                                                                                                            for($l2=$l;$l2<=5;$l2++){
                                                                                                                ?><img src="images/star_full.png" style="height:20px;width: 20px;"><?php
                                                                                                            }
                                                                                                            if($log_status != 'sign in'){
                                                                                                                 ?>
                                                                                                                 <br><a href="index.php?id= <?php echo $xml->product[$i]->product_id;?> ">Rate it</a>
                                                                                                             <?php
                                                                                                               }


                                                                                          }
                                                                                     }
                                                                                   ?>
										
									</div>
									
								</div>
								
							</div>
						</div>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
                                                                                    <?php
                                                                                    if($name != "no results found"){
                                                                                        $n =(int) ceil(2*(count($xml)/3));
                                                                                        for($i= $n;$i<count($xml);$i++){
                                                                                            $img =$xml->product[$i]->path;                                                                                                                                                                                               
                                                                                            echo '<img src ="'.$img.'">';                                                                                   
                                                                                            echo '<font color=red>'.$xml->product[$i]->price .'<font>'.'/=';
                                                                                             echo '<font color=red size=3px>'.$xml->product[$i]->product_name.'</font>';
                                                                                            //echo nl2br('<details> <summary>details</summary><p>"'.$xml->product[$i]->configuration.'"</p> </details>');
                                                                                            $name_1 = $xml->product[$i]->product_name;
                                                                                         if($xml->product[$i]->category_name != 'tv'){
                                                                                             $xml_1 = $db->get_computer_configuration($name_1);

                                                                                        ?>
                                                                                         <details style="color:black;font-size: 17px;">

                                                                                             <?php
                                                                                             echo 'brand :'.$xml_1->product->brand.'<br>';
                                                                                             echo 'processor : '.$xml_1->product->Processor.'<br>';
                                                                                             echo 'clock_speed:'.$xml_1->product->clock_speed.'<br>';
                                                                                             echo 'cache:'.$xml_1->product->cache.'<br>';
                                                                                             echo 'display_type:'.$xml_1->product->display_type.'<br>';
                                                                                             echo 'display_size:'.$xml_1->product->display_size.'<br>';
                                                                                             echo 'ram : '.$xml_1->product->ram.'<br>';
                                                                                             echo 'ram_type : '.$xml_1->product->ram_type.'<br>';
                                                                                             echo 'storage: '.$xml_1->product->storage.'<br>';
                                                                                             echo 'graphics: '.$xml_1->product->graphics_chipset.'<br>';

                                                                                             ?>
                                                                                         </details> 
                                                                                        <?php }
                                                                                       else{
                                                                                           $xml_1 = $db->get_tv_configuration($name_1);
                                                                                           ?>
                                                                                         <details style="color:black;font-size: 17px;">
                                                                                             <?php
                                                                                             echo 'brand : '.$xml_1->product->brand.'<br>';
                                                                                             echo 'display_size : '.$xml_1->product->display_size.'<br>';
                                                                                             echo 'monitor : '.$xml_1->product->monitor;
                                                                                             ?>
                                                                                         </details>
                                                                                         <?php
                                                                                        }
                                                                                        ?>                                                                                         
                                                                                             <a href="OtherPage.php?id=<?php echo $xml->product[$i]->product_id;?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                                                             <a href="OtherPage.php?comp_prod=<?php echo $xml->product[$i]->product_name;?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to Compare</a>
                                                                                             <br>
                                                                                       <?php
                                                                                    $id = $xml->product[$i]->product_id;
                                                                                    $ratingRow = $db->get_rating($id);
                                                                                    $n = $ratingRow['average_rating'];
                                                                                     echo 'Ratings: ';
                                                                                    for($l=1;$l<=$n;$l++){
                                                                                        ?><img src="images/star_highlight.png" style="height:18px;width: 18px;"><?php
                                                                                    }
                                                                                   
                                                                                    for($l2=$l;$l2<=5;$l2++){
                                                                                        ?><img src="images/star_full.png" style="height:20px;width: 20px;"><?php
                                                                                    }
                                                                                    if($log_status != 'sign in'){
                                                                                         ?>
                                                                                         <br><a href="index.php?id= <?php echo $xml->product[$i]->product_id;?> ">Rate it</a>
                                                                                     <?php
                                                                                       }
                                                                                    }
                                                                                }
                                                                                   ?>
									</div>
									
								</div>
								
							</div>
						</div>
						
						
					</div><!--features_items-->														
				</div>
			</div>
		</div>
	</section>
	
		
	
	<script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.scrollUp.min.js"></script>
        <script src="js/price-range.js"></script>
        <script src="js/jquery.prettyPhoto.js"></script>
       <script src="js/main.js"></script>
 
</body>
</html>


?>