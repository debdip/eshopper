<?php
include ("data_layer_acces.php");
$db=new dbhelper();
session_start();

if($_POST["flag"]=="signup"){
             $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);               
                      $uploadOk = 1;              
            }

 
           
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
                    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                
            
            $img_src="uploads/".$_FILES["fileToUpload"]["name"];


    
    
        $customer_name=$_POST["customer_name"];
        $password=$_POST["password"];
        $email = $_POST["email"];
        $dob=$_POST["dob"];
        $gender = $_POST["gender"];
        $country=$_POST["country"];

        $myXMLData = 
            "<?xml version='1.0' encoding='UTF-8'?>
            <customer>
                <customer_name>$customer_name</customer_name>
                <password>$password</password>
                <email>$email</email>
                <dob>$dob</dob>
                <gender>$gender</gender>
                <country>$country</country>
                <profile_pic>$img_src</profile_pic>
            </customer>
            ";

        $xml=  simplexml_load_string($myXMLData) or die("Error: Cannot create object");
        $status = $db->add_customer($xml);
        if($status ==1){   
            $_SESSION['customer_name'] = $customer_name;  
           
            header("location:homepage.php");
        }
        else
            header ("location:login.html");                
    }
    if($_POST["flag"] == "login"){       
        $customer_name=$_POST["customer_name"];
        $password=$_POST["password"];
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
           // $name = $ss->customer->customer_name;
            
            $_SESSION['customer_name'] = $customer_name;
           // $GLOBALS["profile"] = $ss->product->profile_picture;
            header("location:homepage.php");
         
            
        }
        else
            header ("location:login.html");
    }

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

