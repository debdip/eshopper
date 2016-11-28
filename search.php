 <?php
 session_start();
   include 'business_layer.php';
   $bs = new business_layer();
    if(isset($_POST['search_keyword']))
    {
        $str = $_POST['search_keyword'];
        $search_keyword = trim($str);
 
        $xml = $bs->get_all_product($search_keyword);
       
 
	$bold_search_keyword = '<strong>'.$search_keyword.'</strong>';
	$count = count($xml);
        $i = 0;
        if($count > 0){ 
            if($count>=5)
                $count=3;
            for($i=0;$i<$count;$i++){
                $suggestion = $xml->product[$i]->name;           
                 
                echo '<a href="OtherPage.php?name='.$suggestion.' "><div class="show" align="center">'.str_ireplace($search_keyword,$bold_search_keyword,$suggestion).'</div></a>';       
               
            }
        }
        
      /*  if($rows_returned > 0){
            while($rowCountries = $resCountries->fetch_assoc()) 
            {		
                echo '<div class="show" align="left"><span class="country_name">'.str_ireplace($search_keyword,$bold_search_keyword,$rowCountries['category']).'</span></div>'; 	
            }
        }else{
            echo '<div class="show" align="left">No matching records.</div>'; 	
        }
       
       */
    }	
