<?php

$con = mysqli_connect('localhost','root','128029486','keras');




//$del_count = "TRUNCATE table word_total";
//mysqli_query($con,$del_count);





$last_run = mysqli_query($con,'SELECT * FROM last_script');
$result_last_run = mysqli_fetch_array($last_run);
$last_id = intval($result_last_run['answer_id']);
$last_usage = $result_last_run['answer'];
echo "Last Run : $last_usage | Last ID :  $last_id <br><br>";


$del_count = "TRUNCATE table word_total";
mysqli_query($con,$del_count);


$query_colname = mysqli_query($con,'SHOW columns FROM word_count;');
while($row_col = mysqli_fetch_assoc($query_colname)) {
  $col_name = $row_col['Field'];

  $query_sum_each = "select sum(tell), `its_cat` from word_count group by `its_cat`";
  $query_wordname = mysqli_query($con,$query_sum_each);
  while($row_col = mysqli_fetch_assoc($query_wordname)) {

      //echo "Column Name : ".$col_name." : ";
      if ($col_name != "id_primary_key" && $col_name != "its_cat") {

          $run_wordtotal = "INSERT INTO `word_total` (`id_primary_key`, `word_name`, `word_catalog`, `word_count`) VALUES (NULL, '$col_name', '$col_name', '$sum_insert');";

          mysqli_query($con,$run_wordtotal);
      }


  }//end while select *
}//end colname
echo "Done word_total";
echo $row_id;

//update last_usage
$update_last_usage = "UPDATE `last_script` SET `answer` = NOW(), `answer_id` = '$row_id' WHERE `last_script`.`id` = 1;";
mysqli_query($con,$update_last_usage);

// $query_count = mysqli_query($con,'SELECT * FROM word_count');


// while($row_to_count = mysqli_fetch_assoc($query_count)) {
//     $row_to_count['']



// }

?>
