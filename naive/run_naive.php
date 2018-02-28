

<?php

$con = mysqli_connect('localhost','root','128029486','keras');





//get total words from whole training
$get_count_total = "SELECT sum(count) as count_total FROM `word_count_total`";
$query_above = mysqli_query($con,$get_count_total);
$get_count_total= mysqli_fetch_array($query_above);
$count_total = intval($get_count_total['count_total']);

echo "Total words : " . $count_total;


$query_cat = mysqli_query($con,'SELECT * FROM `word_count_total`');
while($row_cat = mysqli_fetch_assoc($query_cat)) {//start count each catalog count
  $count_each_cat = $row_cat['count'];


  //Run through only match catagory
  $select_match = $row_cat['word'];
  echo "CURRENTLY RUN ON : " . $select_match;







  //start anmother loop
  $query_colname = mysqli_query($con,'SHOW columns FROM word_count;');
  while($row_col = mysqli_fetch_assoc($query_colname)) {//start select col name
    $what_col = $row_col['Field'];
    if ($what_col != "id_primary_key" && $what_col != "its_cat") {//start if
      $query_sum_each = "select sum(`$what_col`) as each_count,`id_primary_key`,`its_cat` from word_count group by `id_primary_key`";
      $query_wordname = mysqli_query($con,$query_sum_each);
      //start another loop
      while($row_count_each = mysqli_fetch_assoc($query_wordname)) {

          $each_count = $row_count_each['each_count'];
          $group_id = $row_count_each['id_primary_key'];

          $group_name = $row_count_each['its_cat'];

          if ($group_name == $select_match) { // Select only match

            //check if it's key or not


            //echo $group_name;

            //Add new row
            //$add_new_row = "INSERT INTO `word_prob` (`id_primary_key`, `its_cat`) VALUES ('$group_id', '$group_name');";
            //mysqli_query($con,$add_new_row);


            $set_query = "SELECT count(*) AS count_result FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='keras' AND TABLE_NAME = 'word_prob' AND COLUMN_NAME = '$group_name'";
            $query_word_count = mysqli_query($con,$set_query);
            $get_count= mysqli_fetch_array($query_word_count);

            $count_if = $get_count['count_result'];


            //calc naive HEREEEEEEEEEE

            $each_plus1 = intval($each_count) + 1;

            $total_divider = $count_total + $count_each_cat;

            $result_prob = $each_plus1 / $total_divider;

            echo "The id : " . $group_id . "<br>";
            echo "The word is : " . $what_col . "<br>";
            echo "Result " . $result_prob;
            echo "<br><br>";



            //end calc

            if ($count_if == 0) {
                echo "Starting";
                //Drop Col
                //$drop_col = "ALTER TABLE word_count DROP COLUMN $seperate_word;";
                //mysqli_query($con,$drop_col);
                //Create Col
                $query_alter = "ALTER TABLE word_prob ADD COLUMN `$what_col` DECIMAL(18,12) DEFAULT 0";
                mysqli_query($con,$query_alter);


                //Update Value
                $query_update = "UPDATE word_prob SET `$what_col` = $result_prob WHERE id_primary_key = $group_id;";
                mysqli_query($con,$query_update);
                echo "Add word : ".$seperate_word . "<br>";



            }// if
            else {
                $query_update = "UPDATE word_prob SET `$what_col` = $result_prob WHERE id_primary_key = $group_id;";
                mysqli_query($con,$query_update);
                echo "Update word : ".$seperate_word . "<br>";


            }//end else



          }
      }//end while select *
    }//end col name select
  }//end if
}//end word_count_total

?>
