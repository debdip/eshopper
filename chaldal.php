<?php
$customer_name=$_POST["customer_name"];
$password=$_POST["password"];
$email = $_POST["email"];
$dob=$_POST["dob"];
$myXMLData = 
    "<?xml version='1.0' encoding='UTF-8'?>
    <customer>
    <customer_name>$customer_name</customer_name>
    <from>Jani</from>
    <heading>Reminder</heading>
    <body>Don't forget me this weekend!</body>
    </note>";
?>