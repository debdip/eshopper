<?php
    session_start();
    include 'business_layer.php'; 
    $db=new business_layer();
    
   // print_r($ratingRow);
    $number_of_product = $db->get_number_of_product();
        $i=0;
    if(isset($_GET['cid'])){
        $cid = $_GET['cid'];
        $comp_prod = $db->get_product_name($cid);
        unset($_SESSION[$comp_prod]);
    }
    if(isset($_GET['comp_prod'])){
                $comp_prod= $_GET['comp_prod'];
                $_SESSION[$comp_prod] = 'ok'; 
    }
    
?>

<htm>
      <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
       
    
    <head>
        <style>
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
          #img2{
             margin-left: 15cm;
             margin-top: 15px;
        
        }
        th{
            border: 2px solid black;
            border-collapse: collapse;
            background-color:#afdbbf;
            padding: 10px;
        }
    table, td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 10px;
    }
    tr:hover{background-color:#d8ffff}

        </style>
    </head>
    <body>
        <a href="homepage.php"><img id="img2" src="images/home/logo.png" alt="" height="60px" width="150px" /></a><br><br>
        <?php if(isset($_GET['computer'])){ ?>
            
                    <compare2>
                        <font size="20px">Computer compare list</font>
                                                                                      
                                                                                      
                                                                                             <table  style="width:50%">
                                                                                                    <tr>
                                                                                                        <th></th>
                                                                                                      <th>name</th>
                                                                                                      <th>brand</th>
                                                                                                      <th>price</th>
                                                                                                      <th>processor</th>
                                                                                                      <th>clock speed</th>
                                                                                                      <th>cache</th>
                                                                                                      <th>display size</th>
                                                                                                      <th>display type</th>
                                                                                                      <th>RAM</th>
                                                                                                      <th>RAM type</th>
                                                                                                      <th>Storage</th>
                                                                                                      <th>Graphics</th>
                                                                                                      <th></th>

                                                                                                    </tr>
                                                                                                 <?php
                                                                                                 for($j=1;$j<=$number_of_product;$j++){
                                                                                                     $comp_prod = $db->get_product_name($j);
                                                                                                     if(isset($_SESSION[$comp_prod])){
                                                                                                        
                                                                                                         if($_SESSION[$comp_prod] == 'ok'){
                                                                                                             
                                                                                                             $xml_comp = $db->get_computer_configuration($comp_prod);
                                                                                                             
                                                                                                             //$n=  count($xml_comp);
                                                                                                             if(count($xml_comp)>0){
                                                                                                                 ?>
                                                                                                                 <tr>
                                                                                                                     <td><a href="compare.php?id=<?php echo $j;?> & computer=ok " class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><font color="green">Add to cart</font></a></td>
                                                                                                                     <td><?php echo $xml_comp->product->product_name; ?></td>
                                                                                                                    <td><?php echo $xml_comp->product->brand; ?></td>
                                                                                                                    <td><?php echo $xml_comp->product->price; ?></td>
                                                                                                                    <td><?php echo $xml_comp->product->Processor; ?></td>
                                                                                                                    <td><?php echo $xml_comp->product->clock_speed; ?></td>
                                                                                                                    <td><?php echo $xml_comp->product->cache; ?></td>
                                                                                                                    <td><?php echo $xml_comp->product->display_size; ?></td>
                                                                                                                    <td><?php echo $xml_comp->product->display_type; ?></td>
                                                                                                                    <td><?php echo $xml_comp->product->ram; ?></td>
                                                                                                                    <td><?php echo $xml_comp->product->ram_type; ?></td>
                                                                                                                    <td><?php echo $xml_comp->product->storage; ?></td>
                                                                                                                    <td><?php echo $xml_comp->product->graphics_chipset; ?></td>
                                                                                                                    <td><a href="compare.php?cid=<?php echo $j;?> & computer=ok" class="btn btn-default add-to-cart"><font color="red">Remove</font></a></td>
                                                                                                                </tr>
                                                                                                 
                                                                                                                 <?php
                                                                                                             }
                                                                                                             
                                                                                                             
                                                                                                         }
                                                                                                     }
                                                                                                 }
                                                                                                 ?>
                                                                                                 
                                                                                             </table>
                                                                                                                       
                                                                                </compare2>
                                                                           
        <?php } else{ ?>
    
    
               
                                                                               <compare1><font size="20px">Computer compare list</font>
                                                                                   
                                                                                       <table  style="width:100%">  
                                                                                               <tr>
                                                                                                <th></th>    
                                                                                               <th>name</th>
                                                                                               <th>brand</th>
                                                                                               <th>price</th>
                                                                                               <th>display size</th>
                                                                                               <th>display type</th>
                                                                                               <th></th>
                                                                                               
                                                                                           </tr>
                                                                                               <?php
                                                                                          for($j=1;$j<=$number_of_product;$j++){
                                                                                              $comp_prod = $db->get_product_name($j);
                                                                                              if(isset($_SESSION[$comp_prod])){
                                                                                                  if($_SESSION[$comp_prod] == 'ok'){
                                                                                                        $xml_comp = $db->get_tv_configuration($comp_prod);
                                                                                                                    
                                                                                              if(count($xml_comp)>0){
                                                                                                  
                                                                                              ?>
                                                                                               <tr> 
                                                                                                   <td><a href="compare.php?id=<?php echo $j;?> & tv=ok" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><font color="orange">Add to cart</font></a></td>    
                                                                                                <td><?php echo $xml_comp->product->product_name; ?></td>
                                                                                                <td><?php echo $xml_comp->product->brand; ?></td>
                                                                                                <td><?php echo $xml_comp->product->price; ?></td>
                                                                                                <td><?php echo $xml_comp->product->display_size; ?></td>
                                                                                                <td><?php echo $xml_comp->product->monitor; ?></td>
                                                                                                <td><a href="compare.php?cid=<?php echo $j;?> & tv=ok" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><font color="orange">Remove</font></a></td>
                                                                                           </tr>
                                                                                               
                                                                                               <?php
                                                                                                             }
                                                                                                     }
                                                                                              }
                                                                                        }
                                                                                               
                                                                                               
                                                                                       ?>
                                                                                       </table>
                                                                                         
                                                                                </compare1>
                                                                          
        <?php } ?>
        
        
    </body>
</htm>