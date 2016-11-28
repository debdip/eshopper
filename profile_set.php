<?php
include 'data_layer_acces.php'; 
$db=new dbhelper();
$s='kamrul';
function get_item($s){
    $xml= $db->search_item($log_status);
    return $xml;
    echo 'kamrul';
}

?>