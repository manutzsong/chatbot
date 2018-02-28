

<?php

$con = mysqli_connect('localhost','root','128029486','keras');


$query_colname = mysqli_query($con,'SHOW columns FROM word_count;');
while($row_col = mysqli_fetch_assoc($query_colname)) {
  $col_name = $row_col['Field'];

  $query_sum_each = "select sum($col_name) as each_count, `its_cat` from word_count group by `its_cat`";
  $query_wordname = mysqli_query($con,$query_sum_each);

  while($row_count_each = mysqli_fetch_assoc($query_wordname)) {

      echo "Column Name : ".$col_name." : " . "<br>";

      if ($col_name != "id_primary_key" && $col_name != "its_cat") {
          $each_cat = $row_count_each['each_count'];
          $each_cat_name = $row_count_each['its_cat'];
          $run_wordtotal = "INSERT INTO `word_total` (`id_primary_key`, `word_name`, `word_catalog`, `word_count`) VALUES (NULL, '$col_name', '$each_cat_name', '$each_cat');";

          mysqli_query($con,$run_wordtotal);


          echo $each_cat . "<br>";
      }


  }//end while select *
}//end colname


?>
