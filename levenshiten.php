<?php
    $mysqli = new mysqli("localhost","root","","eshopping");
               // mysql_select_db("online_shopping_db",$con);
     
    $sql="SELECT * FROM product ";            
    $result = $mysqli->query($sql);
    if($result){
        $i = 0;
        while ($row = $result->fetch_assoc()) {
          $array[$i++] = $row["product_name"] ;
      // print_r($result);
    }
    }    
    
   else echo "error";
      echo "<br>";
      print_r($array);
    echo "<br>";
echo levenshtein("Hello World","ello World");
echo "<br>";
echo levenshtein("fruits","frut");
echo "<br>";
echo levenshtein("HelloWorld","HelloWorld");
echo "<br>";
echo levenshtein("Hello World","ello World",10,20,30);
    /* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<?php
// input misspelled word
$input = 'carrrot';

// array of words to check against
//$words  = array('apple','pineapple','banana','orange',
  //              'radish','carrot','pea','bean','potato');

// no shortest distance found, yet
$shortest = -1;

// loop through words to find the closest
foreach ($array as $arr) {

    // calculate the distance between the input word,
    // and the current word
    $lev = levenshtein($input, $arr);

    // check for an exact match
    if ($lev == 0) {

        // closest word is this one (exact match)
        $closest = $arr;
        $shortest = 0;

        // break out of the loop; we've found an exact match
        break;
    }

    // if this distance is less than the next found shortest
    // distance, OR if a next shortest word has not yet been found
    if ($lev <= $shortest || $shortest < 0) {
        // set the closest match, and shortest distance
        $closest  = $arr;
        $shortest = $lev;
    }
}

echo "Input word: $input\n";
if ($shortest == 0) {
    echo "Exact match found: $closest\n";
} else {
    echo "Did you mean: $closest?\n";
}

?>