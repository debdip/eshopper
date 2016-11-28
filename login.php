<?php
    session_start();
    include 'business_layer.php';
    $db = new business_layer();
    if(array_key_exists('status',$_SESSION) && !empty($_SESSION['status'])){ 
        session_destroy();
        header("location:homepage.php");
     }

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login | E-Shopper</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
 <style>
     input[type=file]{
         background-color: orange;
         height: 25;
         width: 25;
     }
   
    </style>
    
  
    
</head><!--/head-->

<body>
    <header id="header"><!--header-->
            <div class="header-top"><!--header-top-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="logo pull-left">
                                <a href="homepage.php"><img src="images/home/logo.png" alt="" /></a>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="shop-menu pull-right">
                                <ul class="nav navbar-nav">
                                    <li><a href="homepage.php"><img src="images/home.jpg" height="30px" width="30px" ><font color="orange">homepage</font></a></li>
                                    <li><a href="signup.php" class="active"><i class="fa fa-lock"></i> sign up</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header-top-->
    </header><!--/header-->
	
	<header id="header"><!--middle-->
            <div class="header-top">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-1">
					<div class="login-form"><!--login form-->
                                            
						<h2>Login to your account</h2>
                                                <form action="login.php" method ="get">
                                                    <input type="text" name="customer_name" placeholder="Name" required />
                                                    <input type="password" name="password" placeholder="Password" required />
							<span>
								<input type="checkbox" class="checkbox" name="checkbox"> 
								Keep me signed in
							</span>
                                                        
							<button type="submit" name="submit" class="btn btn-default">Login</button>
						</form>
                                            
                                                <?php
                                                    if(isset($_GET["submit"])){
                                                            $customer_name=$_GET["customer_name"];
                                                           $password=$_GET["password"];
                                                           $myXMLData = 
                                                               "<?xml version='1.0' encoding='UTF-8'?>
                                                               <customer>
                                                                   <customer_name>$customer_name</customer_name>
                                                                   <password>$password</password>
                                                               </customer>
                                                               ";
                                                            $xml=  simplexml_load_string($myXMLData) or die("Error: Cannot create object");     
                                                          $ss= $db->match_customer($xml);
                                                           if($ss != "null"){  
                                                                 $_SESSION['customer_name'] = $customer_name;
                                                                 if($ss->product->admin=='admin1'){
                                                                     $_SESSION['admin'] = 'admin1';
                                                                     
                                                                 }
                                                                 else if($ss->product->admin=='admin2'){
                                                                     $_SESSION['admin'] = 'admin2';
                                                                 }
                                                                if(isset($_GET["checkbox"])){
                                                                    setcookie('customer_name',$customer_name,time()+3600);
                                                                    if(isset($_SESSION['admin']))
                                                                         setcookie('admin',$_SESSION['admin'],time()+3600);
                                                                    
                                                                    
                                                                } 
                                                                 header("location:homepage.php");


                                                           }
                                                           else
                                                               header ("location:login.php?msg=error");
                                                           
                                                       }
                                                       
                                                      else if (isset ($_GET["msg"]) )
                                                          echo '<font color=red >'.'<i>'."Wrong user name or password".'</i>'.'</font>';
                                                     
                                                       
                                                           
                                                        
                                                    
                                                ?>
					</div><!--/login form-->
				</div>
				<div class="col-sm-3">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
                                           
                                                
                                            <a href="signup.php"><h2><font color=red>New User! Signup</font></h2></a>
                                               
					</div>
				</div>
			</div>
		</div>
            </div>
	</header><!--/form-->
	
	
	
  
    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>