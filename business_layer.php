<?php
    include '/opt/lampp/htdocs/Eshopper/data_layer_acces.php'; 
    require 'PHPMailerAutoload.php';
    
class business_layer{
         
          private $db;

       
	public function __construct() {	
           
            $this->db=new dbhelper();
        }
        function get_rating($id){
            $ratingRow=$this->db->get_rating($id);
            return $ratingRow;
        }
        
        function add_computer($xml){
           $this->db->add_computer($xml);
        }
        function  add_tv($xml){
            $this->db->add_tv($xml);
        }
        
        function  get_all_productname(){
           $xml=$this->db->get_all_productname();
           return $xml;
        }
        function  set_order($xml){
            $this->db->set_order($xml);
        }
        
        function get_tv_configuration($product_name){
            $xml = $this->db->get_tv_configuration($product_name);
            return $xml;
        }
        
         function get_computer_configuration($product_name){
             $xml = $this->db->get_computer_configuration($product_name);
             return $xml;
         }
        
        function  search_product_for_compare($id){
            $xml = $this->db->search_product_for_compare($id);
            return $xml;
        }
        function get_product_name($id){
            $name = $this->db->get_product_name($id);
            return $name;
        }
                
        function search_product_info($id){
            $xml = $this->db->search_product_info($id);
            return $xml;
        }
        function  get_number_of_product(){
            
            $number_of_product=$this->db->get_number_of_product();
            return $number_of_product;
        }
        function send_mail($email){
                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->SMTPSecure = 'ssl';
                $mail->SMTPAuth = true;
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465;
                $mail->Username = 'kamrulhasan1920@gmail.com';
                $mail->Password = 'password';
                $mail->setFrom('kamrulhasan1920@gmail.com');
                $mail->addAddress($email );
                $mail->Subject = 'Verification code';
                $mail->Body =rand();
                $_SESSION['code'] = $mail->Body;
                //send the message, check for errors
                if (!$mail->send()) {
                    echo "ERROR: " . $mail->ErrorInfo;
                } else {
                    echo 'ok';
                }            
        }
        function get_all_product($search_keyword){
            $xml = $this->db->get_all_product($search_keyword);
            return $xml;
        }
        function add_customer($xml){
            
             $status = $this->db->add_customer($xml); 
             return $status;    
        }
        function match_customer($xml){
            $xml = $this->db->match_customer($xml);
            return $xml;
        }
        function search_item($term){
            $xml = $this->db->search_item($term);
            return $xml;
        }
        function get_product_asSearch($name){
           $xml = $this->db->get_product_asSearch($name);
           return $xml;
       }
        function get_similar_product($h){
            $match = $this->db->get_similar_product($h);
            return $match;
        }
        function getProduct_as_price($price){
          $xml = $this->db->getProduct_as_price($price);
          return $xml;
       }
       function get_popular_product(){
          $xml = $this->db->get_popular_product();
          return $xml;           
       }
       function addProduct($xml){
           $this->db->addProduct($xml);
       }
       function update_product($product_name , $xml){
           $this->db->update_product($product_name,$xml);
       }
      function update_product1($product_name , $xml){
           $this->db->update_product1($product_name,$xml);
       }
       function delete_product($product_name){
           $this->db->delete_product($product_name);
       }
       
      
}
?>