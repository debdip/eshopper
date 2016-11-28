<?php
include_once 'data_layer_acces.php';
$db = new dbhelper();
$mysqli = new mysqli("localhost","root","","eshopping");
if(isset($_POST['name']))
{
$name=trim($_POST['name']);
$xml = $db->get_all_product($name);
//$query2 =  mysqli_query($mysqli,"SELECT * FROM product WHERE product_name LIKE '$name%'");
//$query4 =  mysqli_query($mysqli,"SELECT * FROM product WHERE product_name LIKE '%$name%'");
echo "<ul>";
//while($query3=mysqli_fetch_array($query2,MYSQLI_ASSOC))
$count = count($xml);
$i = 0;

while($i<$count)
{
?>
<li onclick='fill("<?php echo $xml->product[$i]->product_name; ?>")'><?php echo $xml->product[$i]->product_name ?></li>
$i++;
<?php
}
}
?>
</ul>