<?php


class dbhelper{
         
        private $mysqli;
	private $servername = "localhost";
	private $username = "root";
	private $password = "";
	
	public function __construct() {
		$this->mysqli = new mysqli($this->servername,"root","","eshopping");

                
        }
        function get_rating($id){
            $query = "SELECT rating_number, FORMAT((total_points / rating_number),1) as average_rating FROM post_rating WHERE post_id = '$id' AND status = 1";
            $result = $this->mysqli->query($query);
            //$result = $db->query($query);
            $ratingRow = $result->fetch_assoc();
            return $ratingRow;
        }
        function update_product($product_name , $xml){
            $check = 1;
            foreach ($xml->children() as $child)
                {
                  
                    $column = $child->getName();
                    $sql="UPDATE product
                        SET $column = '$child'
                        WHERE product_name = '$product_name' ";
                    
                
                    $result = $this->mysqli->query($sql);
                    if($result == FALSE)
                        $check = 0;
                        if($column == 'brand_name')
                            $column = 'brand';
                    $sql="UPDATE computer
                        SET $column = '$child'
                        WHERE product_name = '$product_name' ";
                    $result = $this->mysqli->query($sql);
                    if($result == FALSE)
                        $check = 0;
                }    
                if($check = 1)
                        echo 'data updated succesfully';
                 else 
                     echo 'failed to update data!!'; 
                            
        }
        
        function update_product1($product_name , $xml){
           
            $check = 1;
            foreach ($xml->children() as $child)
                {
                  
                    $column = $child->getName();
                    $sql="UPDATE product
                        SET $column = '$child'
                        WHERE product_name = '$product_name' ";
                    
                
                    $result = $this->mysqli->query($sql);
                    if($result == FALSE)
                        $check = 0;
                        if($column == 'brand_name')
                            $column = 'brand';
                    $sql="UPDATE tv
                        SET $column = '$child'
                        WHERE product_name = '$product_name' ";
                    $result = $this->mysqli->query($sql);
                    if($result == FALSE)
                        $check = 0;
                }    
                if($check = 1)
                        echo 'data updated succesfully';
                 else 
                     echo 'failed to update data!!'; 
                            
        }        
        
        
        function delete_product($product_name){
            $sql = "DELETE FROM product
                WHERE product_name='$product_name' ";
            $result = $this->mysqli->query($sql);
            $sql = "DELETE FROM computer
                WHERE product_name='$product_name' ";
            $result = $this->mysqli->query($sql);
            $sql = "DELETE FROM tv
                WHERE product_name='$product_name' ";
            $result = $this->mysqli->query($sql);
        }
        
        
        function add_computer($xml){
            print_r($xml);
            $product_name = $xml->product_name;
            $path = $xml->path;
            $price = $xml->price;
            $rank = $xml->rank;
            $brand_name = $xml->brand_name;
            $category_name = $xml->category_name;
            $Processor = $xml->Processor;
            $clock_speed = $xml->clock_speed;
            $cache = $xml->cache;
            $display_size = $xml->display_size;
            $display_type = $xml->display_type;
            $ram = $xml->ram;
            $ram_type = $xml->ram_type;
            $storage = $xml->storage;
            $graphics_chipset = $xml->graphics_chipset;
            
            
            $sql = "INSERT INTO product ( product_name,path,price,rank,brand_name,category_name) VALUES ( '$product_name','$path','$price','$rank','$brand_name','$category_name')";
            $result = $this->mysqli->query($sql);
            if($result == FALSE)
                echo 'failed to insert data';
            else
                echo 'inserted succesfully';
                
            $sql1 = "INSERT INTO computer ( product_name,price,brand,Processor,clock_speed,cache,display_size,display_type,ram,ram_type,storage,graphics_chipset) VALUES ( '$product_name','$price','$brand_name','$Processor','$clock_speed','$cache','$display_size','$display_type','$ram','$ram_type','$storage','$graphics_chipset')";
            $result1 = $this->mysqli->query($sql1);
                if($result1 == FALSE)
                        echo 'failed to insert data';
                    else
                        echo 'inserted succesfully';
                
        }
        
        function  add_tv($xml){
            $product_name = $xml->product_name;
            $path = $xml->path;
            $price = $xml->price;
            $rank = $xml->rank;
            $brand_name = $xml->brand_name;
            $category_name = $xml->category_name;
            $display_size = $xml->display_size;
            $monitor = $xml->monitor;
             $sql = "INSERT INTO product ( product_name,path,price,rank,brand_name,category_name) VALUES ( '$product_name','$path','$price','$rank','$brand_name','$category_name')";
             $result = $this->mysqli->query($sql);
            if($result == FALSE)
                echo 'failed to insert data';
            else
                echo 'inserted succesfully';
            $sql ="INSERT INTO tv ( product_name,brand,price,display_size,monitor) VALUES ( '$product_name','$brand_name','$price','$display_size','$monitor')";
            $result = $this->mysqli->query($sql);
            if($result == FALSE)
                echo 'failed to insert data';
            else
                echo 'inserted succesfully';            
            
            
        }
                
        function  set_order($xml){
            $product_name=$xml->product_name;
            $item = $xml->item;
            $cost = $xml->cost;
            $customer_name = $xml->customer_name;
            $full_name = $xml->full_name;
            $address = $xml->address;
            $city = $xml->city;
            $state = $xml->state;
            $zip = $xml->zip;
            $credit_card = $xml->credit_card;
            $phone_number = $xml->phone_number;
            $country = $xml->country;
            $preference = $xml->preference;
            $security_code = $xml->security_code;
            //print_r($xml);
           // $sql =" INSERT INTO 'order_table' (product_name,item,cost,customer_name,full_name,address,city,state,zip,credit_card,phone_number,country,preference,security_code)
             //     VALUES ('$product_name','$item','$cost','$customer_name','$full_name','$address,$city','$state','$zip','$credit_card','$phone_number','$country','$preference','$security_code') ";
            $sql = "INSERT INTO order_table ( product_name, item, cost, customer_name, full_name, address, city, state, zip, credit_card, phone_number, country, preference, security_code) VALUES ( '$product_name', '$item', '$cost', '$customer_name', '$full_name', '$address', '$city', '$state', '$zip', '$credit_card', '$phone_number', '$country', '$preference', '$security_code')";
            //$sql = "INSERT INTO `order_table` (`order_id`, `product_name`, `item`, `cost`, `customer_name`, `full_name`, `address`, `city`, `state`, `zip`, `credit_card`, `phone_number`, `country`, `preference`, `security_code`) VALUES (NULL, '$product_name', '$item', '$cost, '$customer_name', '$full_name', '$address','$city',''$state, '$zip', '$credit_card', '$phone_number', '$country', '$preference', '$security_code') ";
            
            $result = $this->mysqli->query($sql);
            if($result == FALSE)
                echo 'Failed to insert data';
            
            
        }
                
        
        
        
        function get_tv_configuration($product_name){
            $query = "SELECT * FROM tv WHERE product_name='$product_name' ";
            $result = $this->mysqli->query($query);
            
            if($result->num_rows > 0){
               $xml = '<item>';
                while($row = $result->fetch_assoc()){
                 $xml = $xml.'<product>';
                    foreach($row as $key=>$val){
			$xml=$xml."<$key>$val</$key>";
                    }
                    $xml = $xml.'</product>';
                 }
                 $xml = $xml.'</item>';
            
                 $xml=simplexml_load_string($xml);
                
                 return $xml;
            }
        }
                
        function get_computer_configuration($product_name){
            //echo $product_name;
            //$product_name = "HP-Pavilion-15-AB030TU";
            $query = "SELECT * FROM computer WHERE product_name='$product_name' ";
            //$query = "SELECT * FROM computer";
                   
            $result = $this->mysqli->query($query);
            if($result->num_rows > 0){
               $xml = '<item>';
                while($row = $result->fetch_assoc()){
                 $xml = $xml.'<product>';
                    foreach($row as $key=>$val){
			$xml=$xml."<$key>$val</$key>";
                    }
                    $xml = $xml.'</product>';
                 }
                 $xml = $xml.'</item>';
            
                 $xml=simplexml_load_string($xml);
                 //echo 'kamrul';
                 return $xml;
            }
            
        }
                
        
        function search_product_info($id){
            $query = "SELECT product_name,price,path FROM product WHERE product_id='$id'";
            $result = $this->mysqli->query($query);
            if($result->num_rows > 0){
               $xml = '<item>';
                while($row = $result->fetch_assoc()){
                 $xml = $xml.'<product>';
                    foreach($row as $key=>$val){
			$xml=$xml."<$key>$val</$key>";
                    }
                    $xml = $xml.'</product>';
                 }
                 $xml = $xml.'</item>';
                 $xml=simplexml_load_string($xml);
            
                 return $xml;
            }
            else {
                return 'null';
            }
        }
        function get_product_name($id){
            $query = "SELECT product_name FROM product WHERE product_id='$id'";
            $result = $this->mysqli->query($query);
            $name="";
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    foreach($row as $key=>$val){
			$name = $val;
                    }
                }
            }
            return $name;
        }
        
        function search_product_for_compare($id){
            $query = "SELECT * FROM product WHERE product_id='$id'";
            $result = $this->mysqli->query($query);
            if($result->num_rows > 0){
               $xml = '<item>';
                while($row = $result->fetch_assoc()){
                 $xml = $xml.'<product>';
                    foreach($row as $key=>$val){
			$xml=$xml."<$key>$val</$key>";
                    }
                    $xml = $xml.'</product>';
                 }
                 $xml = $xml.'</item>';
                 $xml=simplexml_load_string($xml);
            
                 return $xml;
            }           
        }
        
        function  get_number_of_product(){
            $query = "SELECT product_id FROM product";
            $result = $this->mysqli->query($query);
            $number_of_product = $result->num_rows;
            return $number_of_product;
        }
                
        
        function add_customer($xml){
            $check = count($xml);
             
                $customer_name = $xml->customer_name;
                $password1 = $xml->password;
                $email = $xml->email;
                $dob = $xml->dob;
                $gender = $xml->gender;
                $country = $xml->country;
                $profile_pic=$xml->profile_pic;
                
                $password= md5( $password1);
                $salt = sha1(md5($password));
                $salt1 = 'dysziujeh';
                $password = md5($password.$salt.$customer_name.$salt1);
                
                $sql = "INSERT INTO customer_info (customer_name,password,email,dob,gender,country,profile_pic)
                  VALUES ('$customer_name','$password','$email','$dob','$gender','$country','$profile_pic')";

                $result = $this->mysqli->query($sql);
                if($result == FALSE){
                    echo 'failed to insert'; 
                    return 0;
                     
                }
                else 
                    return 1;                
        }
        function match_customer($xml){
            $customer_name = $xml->customer_name;
            $password1 = $xml->password; 
            $password = md5( $password1);                                        
            $salt = sha1(md5($password));
            $salt1 = 'dysziujeh';
            $password = md5($password.$salt.$customer_name.$salt1);
            
            $query = "SELECT * FROM customer_info WHERE customer_name ='$customer_name' AND password='$password' ";
            $result = $this->mysqli->query($query);      
            if($result->num_rows > 0){
               $xml = '<item>';
                while($row = $result->fetch_assoc()){
                 $xml = $xml.'<product>';
                    foreach($row as $key=>$val){
			$xml=$xml."<$key>$val</$key>";
                    }
                    $xml = $xml.'</product>';
                 }
                 $xml = $xml.'</item>';
                 $xml=simplexml_load_string($xml);
            
                 return $xml;
            }
            
            else 
                return 'null' ;
            
        }
       
                
        function search_item($term){
            $query = "SELECT * FROM customer_info WHERE customer_name ='$term' ";
            $result = $this->mysqli->query($query);      
            if($result->num_rows > 0){
               $xml = '<item>';
                while($row = $result->fetch_assoc()){
                 $xml = $xml.'<product>';
                    foreach($row as $key=>$val){
			$xml=$xml."<$key>$val</$key>";
                    }
                    $xml = $xml.'</product>';
                 }
                 $xml = $xml.'</item>';
                 $xml=simplexml_load_string($xml);
                 
                 return $xml;
            }
            
            else 
                return 'null' ;
  
             
        }
        function  get_all_productname(){
            $query = "SELECT product_id,product_name,category_name,path FROM product";
            $result = $this->mysqli->query($query);
              $xml = '<item>';
                
                    
                    while($row = $result->fetch_assoc()){
                    $xml = $xml.'<product>';
			foreach($row as $key=>$val){
				$xml=$xml."<$key>$val</$key>";
                        }
                    $xml = $xml.'</product>';
                    }
                 
                 $xml = $xml.'</item>';
                $xml=simplexml_load_string($xml) ;
                return $xml;
                 
        }
                function get_all_product($search_keyword){
            
                $query = "SELECT product_name FROM product WHERE product_name LIKE '$search_keyword%'";
                 $query2 = "SELECT category_name FROM category WHERE category_name LIKE '$search_keyword%'";
		 $query3 = "SELECT brand_name FROM brand WHERE brand_name LIKE '$search_keyword%'";
		 $query4 = "SELECT product_name FROM product WHERE product_name LIKE '%$search_keyword%' AND product_name NOT LIKE '$search_keyword%'  ";
                 $query5 = "SELECT category_name FROM category WHERE category_name LIKE '%$search_keyword%' AND category_name NOT LIKE '$search_keyword%' ";
		 $query6 = "SELECT brand_name FROM brand WHERE brand_name LIKE '%$search_keyword%' AND brand_name NOT LIKE '$search_keyword%' ";
                 $result = $this->mysqli->query($query);
                 $result2 = $this->mysqli->query($query2);
                 $result3 = $this->mysqli->query($query3);
                 $result4 = $this->mysqli->query($query4);
                 $result5 = $this->mysqli->query($query5);
                 $result6 = $this->mysqli->query($query6);
		
                 $xml = '<item>';
                { 
                    
                    while($row = $result3->fetch_assoc()){
                    $xml = $xml.'<product>';
			foreach($row as $key=>$val){
				$xml=$xml."<name>$val</name>";
                        }
                    $xml = $xml.'</product>';
                 }                    
                    
                 while($row = $result2->fetch_assoc()){
                    $xml = $xml.'<product>';
			foreach($row as $key=>$val){
				$xml=$xml."<name>$val</name>";
                        }
                    $xml = $xml.'</product>';
                 }            
                    
                 while($row = $result->fetch_assoc()){
                    $xml = $xml.'<product>';
			foreach($row as $key=>$val){
				$xml=$xml."<name>$val</name>";
                        }
                    $xml = $xml.'</product>';
	
                 }
                   
                    while($row = $result6->fetch_assoc()){
                    $xml = $xml.'<product>';
			foreach($row as $key=>$val){
				$xml=$xml."<name>$val</name>";
                        }
                    $xml = $xml.'</product>';
                 }   
                      while($row = $result5->fetch_assoc()){
                    $xml = $xml.'<product>';
			foreach($row as $key=>$val){
				$xml=$xml."<name>$val</name>";
                        }
                    $xml = $xml.'</product>';
                 } 
                 while($row = $result4->fetch_assoc()){
                    $xml = $xml.'<product>';
			foreach($row as $key=>$val){
				$xml=$xml."<name>$val</name>";
                        }
                    $xml = $xml.'</product>';
                 }                    
        
                }   
                 $xml = $xml.'</item>';
                 $xml=simplexml_load_string($xml) ;
                
                 return $xml;            
        }
        
        function get_product_asSearch($name){
            $query1 = "SELECT category_name FROM product WHERE product_name = '$name'  ";
            $query2 = "SELECT brand_name FROM product WHERE product_name = '$name'  ";
            $result1 = $this->mysqli->query($query1);
            $result2 = $this->mysqli->query($query2);
            $f1 = $f2 = 0;
            if(mysqli_num_rows($result1) > 0){
                while($row = $result1->fetch_assoc()){
                    foreach($row as $key=>$val){
                     $query3 = "SELECT * FROM product WHERE category_name = '$val'  ";
                     $result3 = $this->mysqli->query($query3);
                     $f1=1;
                    }
                }
                
            }
            if(mysqli_num_rows($result2) > 0){
                while($row = $result2->fetch_assoc()){
                    foreach($row as $key=>$val){
                     $query4 = "SELECT * FROM product WHERE brand_name = '$val'  ";
                     $result4 = $this->mysqli->query($query4);
                     $f2=1;
                    }
                }               
            }  
            if($f1==1){
		 $xml = '<item>';
                 while($row = $result3->fetch_assoc()){
                    $xml = $xml.'<product>';
			foreach($row as $key=>$val){
				$xml=$xml."<$key>$val</$key>";
                        }
                    $xml = $xml.'</product>';
                 }
                if($f2 == 1){
                     while($row = $result4->fetch_assoc()){
                        $xml = $xml.'<product>';
                            foreach($row as $key=>$val){
                            	$xml=$xml."<$key>$val</$key>";
                            }
                         $xml = $xml.'</product>' ;                        
                    }
                }            
            $xml = $xml.'</item>';            
            $xml=simplexml_load_string($xml) or die("Error: Cannot create object");               
            return $xml;
           }
           if($f1 == 0 && $f2 == 0){
               $query5 = "SELECT * FROM product WHERE brand_name='$name' ";
		$result5 = $this->mysqli->query($query5) ;
                if(mysqli_num_rows($result5) > 0){
                    $xml = '<item>' ;
                    while($row = $result5->fetch_assoc()){
                        $xml = $xml.'<product>';
                            foreach($row as $key=>$val){
                                    $xml=$xml."<$key>$val</$key>";
                            }
                        $xml = $xml.'</product>';

                     }
                     $xml = $xml.'</item>';
                     $xml=simplexml_load_string($xml) or die("Error: Cannot create object");
                  return $xml; 
                }
                else{
                    $query5 = "SELECT * FROM product WHERE category_name='$name' ";
                     $result5 = $this->mysqli->query($query5) ;
                         $xml = '<item>' ;
                         while($row = $result5->fetch_assoc()){
                             $xml = $xml.'<product>';
                                 foreach($row as $key=>$val){
                                         $xml=$xml."<$key>$val</$key>";
                                 }
                             $xml = $xml.'</product>';

                          }
                          $xml = $xml.'</item>';
                          $xml=simplexml_load_string($xml) ;
                       return $xml; 
                }
           }                                                       
        
       }
       function get_similar_product($h){
           $min = 9999;
            $query = "SELECT product_name FROM product ";
            $result = $this->mysqli->query($query);
             while($row = $result->fetch_assoc()){
                 $str=$row["product_name"];
                 
                $dist=levenshtein($str, $h);
                if($min > $dist){ 
                    $min = $dist;
                    $match=$str;
                    
                }
                
             }
            
            $query = "SELECT category_name FROM category ";
            $result = $this->mysqli->query($query);
             while($row = $result->fetch_assoc()){
                $str=$row["category_name"];                 
                $dist=levenshtein($str, $h);
                if($min > $dist){ 
                    $min = $dist;
                    $match=$str;
                    
                }
                
             }                         
           $query = "SELECT brand_name FROM brand ";
            $result = $this->mysqli->query($query);
             while($row = $result->fetch_assoc()){
                $str=$row["brand_name"];                 
                $dist=levenshtein($str, $h);
                if($min > $dist){ 
                    $min = $dist;
                    $match=$str;
                    
                }
                
             }                  
             
              return $match;
       }
       function getProduct_as_price($price){
           $query = "SELECT * FROM product WHERE price <= '$price' ";
            $result = $this->mysqli->query($query);
 		 $xml = '<item>';
                 while($row = $result->fetch_assoc()){
                    $xml = $xml.'<product>';
			foreach($row as $key=>$val){
				$xml=$xml."<$key>$val</$key>";
                        }
                    $xml = $xml.'</product>';
	
                 }
                 $xml = $xml.'</item>';
                 $xml=simplexml_load_string($xml);           
                 return $xml;
       }
               
        function get_popular_product(){
		 $query = "SELECT * FROM product ";
		 $result = $this->mysqli->query($query);
		 $xml = '<item>';
                 while($row = $result->fetch_assoc()){
                    $xml = $xml.'<product>';
			foreach($row as $key=>$val){
				$xml=$xml."<$key>$val</$key>";
                        }
                    $xml = $xml.'</product>';
	
                 }
                 $xml = $xml.'</item>';
                 $xml=simplexml_load_string($xml) or die("Error: Cannot create object");
                 $s = count($xml);
                 
                 for($i=0;$i<count($xml);$i++) {
                     $array[$i]=$xml->product[$i]->product_id;
                     $rank[$i]=$xml->product[$i]->rank;
                 }
                 
                for($i=0;$i<$s;$i++){
                    for($j=0;$j<$s-1;$j++){
                        $m=$rank[$j];
                    
                        $n=$rank[$j+1];                                               
                         if($m<"$n"){                            
                             $temp = $array[$j];
                             $array[$j]=$array[$j+1];
                             $array[$j+1] = $temp;
                             $temp = $rank[$j];
                             $rank[$j]=$rank[$j+1];
                             $rank[$j+1] = $temp;                    
                         }
                    }                 
                }
            $i=$rank[5];
            
            $query = "SELECT * FROM product WHERE rank >= $i ";
                
            $result = $this->mysqli->query($query); 
            if(!$result)                          
                echo 'error to query';
             $xml2 = '<item>';
                 while($row = $result->fetch_assoc()){
                    $xml2 = $xml2.'<product>';
			foreach($row as $key=>$val){
				$xml2=$xml2."<$key>$val</$key>";
                        }
                    $xml2 = $xml2.'</product>';
	
                 }
                 $xml2 = $xml2.'</item>';
               
                 $xml2=simplexml_load_string($xml2) or die("Error: Cannot create object");
                 return $xml2;
        }
        
        
        
 
        
        function new_shopping_cart($customer_id,$xml){
            
            $check = count($xml);
            for($i = 0;$i<count($xml);$i++){ 
                $value1 = $xml->cart_item[$i]->product_id;
                $value2 = $xml->cart_item[$i]->quantity;
                $sql = "INSERT INTO shoppingcart (product_id,customer_id,quantity)
                        VALUES ('$value1','$id','$value2')";
                $result = $this->mysqli->query($sql);
                if($result == 0)
                    $check = 0;
            }
                if($check != 0)
                    echo $check.' data insertd succesfully';
                else 
                    echo 'failed to insert data!!';
                
        }
        function update_shopping_cart($customer_id, $xml){
             $check = 0;
            for($i = 0;$i<count($xml);$i++){ 
                $product_id = $xml->cart_item[$i]->product_id;
                $quantity = $xml->cart_item[$i]->quantity;
                echo $product_id;
                    $sql="UPDATE shoppingcart
                        SET quantity = '$quantity'
                        WHERE customer_id = '$customer_id' AND product_id = '$product_id' ";
                
                    $result = $this->mysqli->query($sql);
                    if($result == TRUE)
                        $check++;
                            
                }    
                if($check == count($xml))
                        echo 'data updated succesfully';
                 else 
                        echo 'can not update data!!';                
        }
                
        
        
        
         function get_product_details($product_id){
		 $query = "SELECT * FROM product WHERE product_id = '$product_id' ";
		 $result = $this->mysqli->query($query);
		 $xml = '<item>';
                 while($row = $result->fetch_assoc()){
                    $xml = $xml.'<product>';
			foreach($row as $key=>$val){
				$xml=$xml."<$key>$val</$key>";
                        }
                    $xml = $xml.'</product>';
	
                 }
                 $xml = $xml.'</item>';
                 $xml=simplexml_load_string($xml) or die("Error: Cannot create object");
            return $xml;
	}
        function get_all_categories($category_id){
            $query= "SELECT * FROM catagory WHERE category_id = '$category_id' ";
		 $result = $this->mysqli->query($query);
                 
		  $xml = '<item>';
                 while($row = $result->fetch_assoc()){
                    $xml = $xml.'<product>';
			foreach($row as $key=>$val){
				$xml=$xml."<$key>$val</$key>";
                        }
                    $xml = $xml.'</product>';
	
                 }
                 $xml = $xml.'</item>';
                 $xml=simplexml_load_string($xml) or die("Error: Cannot create object");
             
                 return $xml;
            
        }
                
        function get_category_details($tablename,$category_id){
            $query= "SELECT * FROM $tablename WHERE category_id = '$category_id' ";
		 $result = $this->mysqli->query($query);
                 
		  $xml = '<item>';
                 while($row = $result->fetch_assoc()){
                    $xml = $xml.'<product>';
			foreach($row as $key=>$val){
				$xml=$xml."<$key>$val</$key>";
                        }
                    $xml = $xml.'</product>';
	
                 }
                 $xml = $xml.'</item>';
                 $xml=simplexml_load_string($xml) or die("Error: Cannot create object");
             
                 return $xml;
            
            
        }
        function get_shopping_cart($user_id){
		 $query = "SELECT * FROM shoppingcart WHERE customer_id = '$user_id' ";
		 $result = $this->mysqli->query($query);
		 $xml = '<item>';
                 while($row = $result->fetch_assoc()){
                    $xml = $xml.'<product>';
			foreach($row as $key=>$val){
				$xml=$xml."<$key>$val</$key>";
                        }
                    $xml = $xml.'</product>';
	
                 }
                 $xml = $xml.'</item>';
                 $xml=simplexml_load_string($xml) or die("Error: Cannot create object");
            return $xml;            
        }
        

}