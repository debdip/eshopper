<?php

  session_start();
    include 'business_layer.php';
    $db = new business_layer();
    if(array_key_exists('status',$_SESSION) && !empty($_SESSION['status'])){ 
        session_destroy();
        if(isset($_COOKIE["customer_name"])){
             setcookie('customer_name',$customer_name,time()-3600);
               if(isset($_COOKIE['admin']))
                  setcookie('admin',$_SESSION['admin'],time()-3600);
                                                                    
                                                                    
            } 
        header("location:homepage.php");
     }

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    
    <style>
    input[type=text], select {
    width: 75%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
   
    box-sizing: border-box;
    color: #272513;
}

 
input[type=password], select {
    width: 75%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
   
    box-sizing: border-box;
    
}


input[type=submit] {
    width: 25%;
    background-color: orange;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
input [type=checkbox]{
    height: 20px;
    width: 20px;
}

input[type=submit]:hover {
    background-color: #45a049;
}    
    div {
        margin-left: 10cm;
        margin-right: 10cm;
        margin-top: 1cm;
        border-radius: 5px;
        background-color: #6ae68d;
        padding: 40px;
    }
    #img1{
        margin-left: 30cm;
    }
    #img2{
        margin-left: 15cm;
        
    }
    #text{
        margin-left: 33cm;
    }
    a{
        text-decoration: none;
    }
    </style>
    <body>
    
        <a href="homepage.php"><img id="img2" src="images/home/logo.png" alt="" /></a>
        
       
        
        <div>
            <h1><font color="orange">Sign In</font></h1>
        
        <form  name = "signin" action="signin.php" method="get">
     <input type="text" name="customer_name" placeholder="Name" required />
     <input type="password" name="password" placeholder="Password" required /><br>
							
        <input type="checkbox" class="checkbox" name="checkbox"> 
       Keep me signed in
       <input type="submit" name ="submit" placeholder="sign in">
							
     </form>
            <a href="signup.php" ><font face="URW Chancery L" size="7px" color="#b82587">New user? signup here</font></a>
        </div>
        
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
                                                               header ("location:signin.php?msg=error");
                                                           
                                                       }
                                                       
                                                      else if (isset ($_GET["msg"]) )
                                                          echo '<font color=red >'.'<i>'."Wrong user name or password".'</i>'.'</font>';        
        ?>
       
    </body>
    
</html>

