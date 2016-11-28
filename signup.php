<?php
    session_start();
     
    include 'business_layer.php';
    $db = new business_layer();
    if(array_key_exists('status',$_SESSION) && !empty($_SESSION['status'])){ 
        session_destroy();
        header("location:homepage.php");
     }
     if(isset($_POST['submit_to_back'])){
         unset($_SESSION['xml']);
     
         //header("location:signup.php");
     }
    /*if(array_key_exists('customer_name',$_SESSION)){
        header("location:homepage.php");
        
    }*/
    
     if( isset($_POST["submit"])){
         $_SESSION['n'] = $_POST["customer_name"];
         // setcookie('n', $_POST["customer_name"], time()+3600);
         // $_POST["customer_name"];
     }
    //if(isset($_SESSION['n']))
        //echo $_COOKIE['n'];
     
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login | i-Shopper</title>
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
     input[type=submit]{
         background-color: orange;
     }
            
       .user {
            display: inline-block;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
          }
          .one {
                background-image: url('http://placehold.it/350x150');
              }
              img {
                border-radius: 8px;
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
                                    <li><a href="login.php" class="active"><i class="fa fa-lock"></i> Login</a></li>
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
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
                               
                                <?php
                                 if(isset($_SESSION['xml'])&& !isset($_POST["submit_for_finally"]) && !isset($_GET["submit"])){
                                       if(isset($_POST["submit_for_delete"])){
                                           unset($_SESSION["img_src"]);
                              
                                           header("location:signup.php");
                                       }
                                       
                                       if(isset($_POST["submit_for_img"])){
                                                        $target_dir = "uploads/";
                                                       $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                                                       $uploadOk = 1;
                                                       $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                                                       // Check if image file is a actual image or fake image
                                                       if(isset($_POST["submit"])) {
                                                           $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                                                           if($check !== false) {
                                                               //echo "File is an image - " . $check["mime"] . ".";
                                                               $uploadOk = 1;
                                                           } else {
                                                               echo "File is not an image.";
                                                               $uploadOk = 0;
                                                           }
                                                       }
                                                       // Check if file already exists
                                                      /* if (file_exists($target_file)) {
                                                           echo "Sorry, file already exists.";
                                                           $uploadOk = 0;
                                                       }*/
                                                       // Check file size
                                                       if ($_FILES["fileToUpload"]["size"] > 500000) {
                                                           echo "Sorry, your file is too large.";
                                                           $uploadOk = 0;
                                                       }
                                                       // Allow certain file formats
                                                       if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                                                       && $imageFileType != "gif" ) {
                                                           echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                                           $uploadOk = 0;
                                                       }
                                                       // Check if $uploadOk is set to 0 by an error
                                                       if ($uploadOk == 0) {
                                                           echo "Sorry, your file was not uploaded.";
                                                       // if everything is ok, try to upload file
                                                       } else {
                                                           if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                                               echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                                                           } else {
                                                               echo "Sorry, there was an error uploading your file.";
                                                           }
                                                       }
                                                       $img_src="uploads/".$_FILES["fileToUpload"]["name"];                                         
                                                       $_SESSION["img_src"]=$img_src;
                                                     ?><!--img src="<?php// echo $img_src;?>" alt="" --> 
                                                           <div class="user" style="background-image:url(<?php echo $img_src;?>)"></div>
                                                     <?php
                                         }
                                        else if(array_key_exists('img_src',$_SESSION)&& !empty($_SESSION['img_src'])){
                                                $img_src=$_SESSION["img_src"];

                                             ?> <!--img src="<?php// echo $img_src;?>" alt="" width="400" height="300"--> 
                                                 <div class="user" style="background-image:url(<?php echo $img_src;?>)"></div>
                                        <?php }
                                         else{
                                               echo'<div class="user one"></div>';
                                        } 
                                       ?>
                                           <?php 
                                           if(isset($_POST["submit_for_img"])){ ?>
                                           
                                             <form method="post"action="">
                                                   <input type="submit" name="submit_for_delete" value="delete this image">
                                               </form>
                                            <?php  
                                           }
                                           else {
                    
                                            ?>
                                        
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    Select image to upload:
                                                    <input type="file" name="fileToUpload" id="fileToUpload"><br>
                                                    <input type="submit" value="Upload Image" name="submit_for_img">
                                                </form>       

                                                    
                                           <?php }
                                           $myXMLData = $_SESSION['xml'];
                                           $xml =simplexml_load_string($myXMLData) or die("Error: Cannot create object");
                                           ?>
                                             
                                                <form action="" method="post" enctype="multipart/form-data">                                                                                                        
                                                    <input type="submit" value=" Sign Up Finally" name="submit_for_finally">
                                                </form>       
                                             <?php ?>
                                             <form action="" method="post" enctype="multipart/form-data">
                                                 <input type ="hidden" name="customer_name" value="<?php echo $xml->customer_name; ?>">
                                                 <input type ="hidden" name="email" value="<?php echo $xml->email; ?>" >
                                                 <input type ="hidden" name ="password" value="<?php echo $xml->password; ?>" >
                                                 <input type ="hidden" name ="dob" value="<?php echo $xml->dob; ?>" >
                                                 <input type ="submit" name="submit_to_back" value="back">
                                             </form>
                                           
                                         
                                       	</div><!--/login form-->
				</div>
				
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
                                            
                                            
                                            
                                            
                            <?php }
                            
                               else if(isset($_POST["submit_for_finally"]) || isset($_GET["submit"])){
                                   
                                   $myXMLData=$_SESSION["xml"];
                                   
                                    if(!isset($_GET["submit"])){
                                        $xml=  simplexml_load_string($myXMLData) or die("Error: Cannot create object");
                                        $email = $xml->email;
                                        $db->send_mail($email);
                                    ?>
                                            
                                        <h2> A verification code has been sent to you . Give this code to verify your email id</h2>
                                        <form action=" " method="get" enctype="multipart/form-data">
                                              <input type = "text" name="code"  >
                                             <input type ="hidden" name="xml" value="<?php echo $myXMLData; ?>" >
                                              <input type="submit" name="submit" >
                                        </form>
                                                 
                                   <?php
                                   }
                                   else{
                                       unset($_SESSION['xml']);
                                       if($_GET["code"] == $_SESSION["code"]){ 
                                            $myXMLData = $_GET["xml"];
                                            $xml=  simplexml_load_string($myXMLData) or die("Error: Cannot create object");
                                            if(array_key_exists('img_src',$_SESSION)){
                                                 $img_src=$_SESSION["img_src"];
                                                $xml->profile_pic=$img_src;
                                            }
                                            $status = $db->add_customer($xml);
                                            
                                            if($status ==1)  { 
                                                
                                                $_SESSION['customer_name'] = $_SESSION["name"];  
                                                    ?>
                                                     <h2>your account succesfully created.</h2> 
                                                    <a href="homepage.php">click here to go homepage</a>
                                                   <?php }
                                            else if ($status == 0)
                                                echo 'error';  
                                        }
                                        else {
                                            echo 'your verification is failed';
                                        }
                                                  
                                    
                                    }
                                    
                             }
                            
                            else{
                                     if( isset($_POST["submit"])){
                                                    
                                                    $customer_name = $_POST["customer_name"];
                                                    $xml = $db->search_item($customer_name);
                                                    if($_POST["password"] != $_POST["repassword"] || $xml !='null')
                                                        $f = 1;
                                                    else 
                                                        $f = 0;
                                      }
                                      else $f=1;
                                                   
                                                  
                                                if($f==1){
                                                        ?>
                                                        <h2>New User Signup!</h2>
                                                        <form action="" method="post" enctype="multipart/form-data">
                                                            <input type="text" name="customer_name" placeholder="Name" required <?php if(isset($_POST["customer_name"])){ ?> value= <?php echo $_POST["customer_name"];}  ?>  />
                                                            <?php if(isset($xml) ){ if($xml != 'null')  echo '<font color=red >'.'<i>'."this name is already used".'</i>'.'</font>'.'<br>' ; echo '<br>'; } ?> 
                                                            <input name="email" type="text" placeholder="something@something.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required <?php if(isset($_POST["email"])){ ?> value= <?php echo $_POST["email"]; } ?>  > 
                                                            <input type="password"  name="password" placeholder="Password" required  title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" />
                                                            at least one number and one uppercase and lowercase letter, and at least 8 or more characters

                                                            <br> <input type="password"  name="repassword" placeholder="retype your Password" required />  
                                                           <?php if(isset($_POST["repassword"])){
                                                               if($_POST["password"] != $_POST["repassword"]){
                                                               echo '<font color=red >'.'<i>'."this  passwords do not match".'</i>'.'</font>'.'<br>' ;
                                                               echo '<br>';
                                                               }
                                                           } ?>
                                                            Male<input  id= radio type="radio" name="gender" value="male" required /> <br>
                                                            Female<input id=radio type="radio" name="gender" value="female" required/><br>
                                                            Other<input id=radio type="radio" name="gender" value="other" required><br> 
                                                            date of birth(before 2005!)<input name="dob" type ="date" max="2005-01-01" required <?php if(isset($_POST["dob"])){ ?> value="<?php echo $_POST['dob'];}?>""/>
                                                            <br>
                                                           Country
                                                           <select id=select name="country"  > <br>
                                                                <option value="Afghanistan">Afghanistan</option>
                                                                <option value="Albania">Albania</option>
                                                                <option value="Algeria">Algeria</option>
                                                                <option value="American Samoa">American Samoa</option>
                                                                <option value="Andorra">Andorra</option>
                                                                <option value="Angola">Angola</option>
                                                                <option value="Anguilla">Anguilla</option>
                                                                <option value="Antartica">Antarctica</option>
                                                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                                <option value="Argentina">Argentina</option>
                                                                <option value="Armenia">Armenia</option>
                                                                <option value="Aruba">Aruba</option>
                                                                <option value="Australia">Australia</option>
                                                                <option value="Austria">Austria</option>
                                                                <option value="Azerbaijan">Azerbaijan</option>
                                                                <option value="Bahamas">Bahamas</option>
                                                                <option value="Bahrain">Bahrain</option>
                                                                <option value="Bangladesh " selected >Bangladesh</option>
                                                                <option value="Barbados">Barbados</option>
                                                                <option value="Belarus">Belarus</option>
                                                                <option value="Belgium">Belgium</option>
                                                                <option value="Belize">Belize</option>
                                                                <option value="Benin">Benin</option>
                                                                <option value="Bermuda">Bermuda</option>
                                                                <option value="Bhutan">Bhutan</option>
                                                                <option value="Bolivia">Bolivia</option>
                                                                <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
                                                                <option value="Botswana">Botswana</option>
                                                                <option value="Bouvet Island">Bouvet Island</option>
                                                                <option value="Brazil">Brazil</option>
                                                                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                                                                <option value="Bulgaria">Bulgaria</option>
                                                                <option value="Burkina Faso">Burkina Faso</option>
                                                                <option value="Burundi">Burundi</option>
                                                                <option value="Cambodia">Cambodia</option>
                                                                <option value="Cameroon">Cameroon</option>
                                                                <option value="Canada">Canada</option>
                                                                <option value="Cape Verde">Cape Verde</option>
                                                                <option value="Cayman Islands">Cayman Islands</option>
                                                                <option value="Central African Republic">Central African Republic</option>
                                                                <option value="Chad">Chad</option>
                                                                <option value="Chile">Chile</option>
                                                                <option value="China">China</option>
                                                                <option value="Christmas Island">Christmas Island</option>
                                                                <option value="Cocos Islands">Cocos (Keeling) Islands</option>
                                                                <option value="Colombia">Colombia</option>
                                                                <option value="Comoros">Comoros</option>
                                                                <option value="Congo">Congo</option>
                                                                <option value="Congo">Congo, the Democratic Republic of the</option>
                                                                <option value="Cook Islands">Cook Islands</option>
                                                                <option value="Costa Rica">Costa Rica</option>
                                                                <option value="Cota D'Ivoire">Cote d'Ivoire</option>
                                                                <option value="Croatia">Croatia (Hrvatska)</option>
                                                                <option value="Cuba">Cuba</option>
                                                                <option value="Cyprus">Cyprus</option>
                                                                <option value="Czech Republic">Czech Republic</option>
                                                                <option value="Denmark">Denmark</option>
                                                                <option value="Djibouti">Djibouti</option>
                                                                <option value="Dominica">Dominica</option>
                                                                <option value="Dominican Republic">Dominican Republic</option>
                                                                <option value="East Timor">East Timor</option>
                                                                <option value="Ecuador">Ecuador</option>
                                                                <option value="Egypt">Egypt</option>
                                                                <option value="El Salvador">El Salvador</option>
                                                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                                <option value="Eritrea">Eritrea</option>
                                                                <option value="Estonia">Estonia</option>
                                                                <option value="Ethiopia">Ethiopia</option>
                                                                <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
                                                                <option value="Faroe Islands">Faroe Islands</option>
                                                                <option value="Fiji">Fiji</option>
                                                                <option value="Finland">Finland</option>
                                                                <option value="France">France</option>
                                                                <option value="France Metropolitan">France, Metropolitan</option>
                                                                <option value="French Guiana">French Guiana</option>
                                                                <option value="French Polynesia">French Polynesia</option>
                                                                <option value="French Southern Territories">French Southern Territories</option>
                                                                <option value="Gabon">Gabon</option>
                                                                <option value="Gambia">Gambia</option>
                                                                <option value="Georgia">Georgia</option>
                                                                <option value="Germany">Germany</option>
                                                                <option value="Ghana">Ghana</option>
                                                                <option value="Gibraltar">Gibraltar</option>
                                                                <option value="Greece">Greece</option>
                                                                <option value="Greenland">Greenland</option>
                                                                <option value="Grenada">Grenada</option>
                                                                <option value="Guadeloupe">Guadeloupe</option>
                                                                <option value="Guam">Guam</option>
                                                                <option value="Guatemala">Guatemala</option>
                                                                <option value="Guinea">Guinea</option>
                                                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                                                <option value="Guyana">Guyana</option>
                                                                <option value="Haiti">Haiti</option>
                                                                <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
                                                                <option value="Holy See">Holy See (Vatican City State)</option>
                                                                <option value="Honduras">Honduras</option>
                                                                <option value="Hong Kong">Hong Kong</option>
                                                                <option value="Hungary">Hungary</option>
                                                                <option value="Iceland">Iceland</option>
                                                                <option value="India">India</option>
                                                                <option value="Indonesia">Indonesia</option>
                                                                <option value="Iran">Iran (Islamic Republic of)</option>
                                                                <option value="Iraq">Iraq</option>
                                                                <option value="Ireland">Ireland</option>
                                                                <option value="Israel">Israel</option>
                                                                <option value="Italy">Italy</option>
                                                                <option value="Jamaica">Jamaica</option>
                                                                <option value="Japan">Japan</option>
                                                                <option value="Jordan">Jordan</option>
                                                                <option value="Kazakhstan">Kazakhstan</option>
                                                                <option value="Kenya">Kenya</option>
                                                                <option value="Kiribati">Kiribati</option>
                                                                <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
                                                                <option value="Korea">Korea, Republic of</option>
                                                                <option value="Kuwait">Kuwait</option>
                                                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                                <option value="Lao">Lao People's Democratic Republic</option>
                                                                <option value="Latvia">Latvia</option>
                                                                <option value="Lebanon">Lebanon</option>
                                                                <option value="Lesotho">Lesotho</option>
                                                                <option value="Liberia">Liberia</option>
                                                                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                                                <option value="Liechtenstein">Liechtenstein</option>
                                                                <option value="Lithuania">Lithuania</option>
                                                                <option value="Luxembourg">Luxembourg</option>
                                                                <option value="Macau">Macau</option>
                                                                <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
                                                                <option value="Madagascar">Madagascar</option>
                                                                <option value="Malawi">Malawi</option>
                                                                <option value="Malaysia">Malaysia</option>
                                                                <option value="Maldives">Maldives</option>
                                                                <option value="Mali">Mali</option>
                                                                <option value="Malta">Malta</option>
                                                                <option value="Marshall Islands">Marshall Islands</option>
                                                                <option value="Martinique">Martinique</option>
                                                                <option value="Mauritania">Mauritania</option>
                                                                <option value="Mauritius">Mauritius</option>
                                                                <option value="Mayotte">Mayotte</option>
                                                                <option value="Mexico">Mexico</option>
                                                                <option value="Micronesia">Micronesia, Federated States of</option>
                                                                <option value="Moldova">Moldova, Republic of</option>
                                                                <option value="Monaco">Monaco</option>
                                                                <option value="Mongolia">Mongolia</option>
                                                                <option value="Montserrat">Montserrat</option>
                                                                <option value="Morocco">Morocco</option>
                                                                <option value="Mozambique">Mozambique</option>
                                                                <option value="Myanmar">Myanmar</option>
                                                                <option value="Namibia">Namibia</option>
                                                                <option value="Nauru">Nauru</option>
                                                                <option value="Nepal">Nepal</option>
                                                                <option value="Netherlands">Netherlands</option>
                                                                <option value="Netherlands Antilles">Netherlands Antilles</option>
                                                                <option value="New Caledonia">New Caledonia</option>
                                                                <option value="New Zealand">New Zealand</option>
                                                                <option value="Nicaragua">Nicaragua</option>
                                                                <option value="Niger">Niger</option>
                                                                <option value="Nigeria">Nigeria</option>
                                                                <option value="Niue">Niue</option>
                                                                <option value="Norfolk Island">Norfolk Island</option>
                                                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                                <option value="Norway">Norway</option>
                                                                <option value="Oman">Oman</option>
                                                                <option value="Pakistan">Pakistan</option>
                                                                <option value="Palau">Palau</option>
                                                                <option value="Panama">Panama</option>
                                                                <option value="Papua New Guinea">Papua New Guinea</option>
                                                                <option value="Paraguay">Paraguay</option>
                                                                <option value="Peru">Peru</option>
                                                                <option value="Philippines">Philippines</option>
                                                                <option value="Pitcairn">Pitcairn</option>
                                                                <option value="Poland">Poland</option>
                                                                <option value="Portugal">Portugal</option>
                                                                <option value="Puerto Rico">Puerto Rico</option>
                                                                <option value="Qatar">Qatar</option>
                                                                <option value="Reunion">Reunion</option>
                                                                <option value="Romania">Romania</option>
                                                                <option value="Russia">Russian Federation</option>
                                                                <option value="Rwanda">Rwanda</option>
                                                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
                                                                <option value="Saint LUCIA">Saint LUCIA</option>
                                                                <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
                                                                <option value="Samoa">Samoa</option>
                                                                <option value="San Marino">San Marino</option>
                                                                <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
                                                                <option value="Saudi Arabia">Saudi Arabia</option>
                                                                <option value="Senegal">Senegal</option>
                                                                <option value="Seychelles">Seychelles</option>
                                                                <option value="Sierra">Sierra Leone</option>
                                                                <option value="Singapore">Singapore</option>
                                                                <option value="Slovakia">Slovakia (Slovak Republic)</option>
                                                                <option value="Slovenia">Slovenia</option>
                                                                <option value="Solomon Islands">Solomon Islands</option>
                                                                <option value="Somalia">Somalia</option>
                                                                <option value="South Africa">South Africa</option>
                                                                <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
                                                                <option value="Span">Spain</option>
                                                                <option value="SriLanka">Sri Lanka</option>
                                                                <option value="St. Helena">St. Helena</option>
                                                                <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
                                                                <option value="Sudan">Sudan</option>
                                                                <option value="Suriname">Suriname</option>
                                                                <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
                                                                <option value="Swaziland">Swaziland</option>
                                                                <option value="Sweden">Sweden</option>
                                                                <option value="Switzerland">Switzerland</option>
                                                                <option value="Syria">Syrian Arab Republic</option>
                                                                <option value="Taiwan">Taiwan, Province of China</option>
                                                                <option value="Tajikistan">Tajikistan</option>
                                                                <option value="Tanzania">Tanzania, United Republic of</option>
                                                                <option value="Thailand">Thailand</option>
                                                                <option value="Togo">Togo</option>
                                                                <option value="Tokelau">Tokelau</option>
                                                                <option value="Tonga">Tonga</option>
                                                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                                <option value="Tunisia">Tunisia</option>
                                                                <option value="Turkey">Turkey</option>
                                                                <option value="Turkmenistan">Turkmenistan</option>
                                                                <option value="Turks and Caicos">Turks and Caicos Islands</option>
                                                                <option value="Tuvalu">Tuvalu</option>
                                                                <option value="Uganda">Uganda</option>
                                                                <option value="Ukraine">Ukraine</option>
                                                                <option value="United Arab Emirates">United Arab Emirates</option>
                                                                <option value="United Kingdom">United Kingdom</option>
                                                                <option value="United States">United States</option>
                                                                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                                                <option value="Uruguay">Uruguay</option>
                                                                <option value="Uzbekistan">Uzbekistan</option>
                                                                <option value="Vanuatu">Vanuatu</option>
                                                                <option value="Venezuela">Venezuela</option>
                                                                <option value="Vietnam">Viet Nam</option>
                                                                <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                                                                <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
                                                                <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
                                                                <option value="Western Sahara">Western Sahara</option>
                                                                <option value="Yemen">Yemen</option>
                                                                <option value="Yugoslavia">Yugoslavia</option>
                                                                <option value="Zambia">Zambia</option>
                                                                <option value="Zimbabwe">Zimbabwe</option>
                                                            </select>             

                                                           <br>

                                                            <br>


                                                                <button type="submit" name="submit" class="btn btn-default">Signup</button><br>

                                                        </form>
                                                        <?php 
                                                 }
                                                else{
                                                   
                                                        if(array_key_exists('img_src',$_SESSION))
                                                                   $img_src=$_SESSION["img_src"];
                                                              else
                                                                  $img_src = "null";
                                                                  
    
                                                           
                                                        $_SESSION["name"] = $customer_name=$_POST["customer_name"];
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
                                                       $_SESSION['xml']=$myXMLData;
                                                       
                                                       header("location:signup.php");
                                                }
                                                  
                                 }
                                                                  
                                            
                                          ?>
					</div><!--/sign up form-->
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