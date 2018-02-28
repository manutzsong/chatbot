<?php
ini_set('max_execution_time', 300);
$con = mysqli_connect('localhost','root','128029486','keras');




//$del_count = "TRUNCATE table word_total";
//mysqli_query($con,$del_count);





$last_run = mysqli_query($con,'SELECT * FROM last_script');
$result_last_run = mysqli_fetch_array($last_run);
$last_id = intval($result_last_run['answer_id']);
$last_usage = $result_last_run['answer'];
echo "Last Run : $last_usage | Last ID :  $last_id <br><br>";

$pre_query = "SELECT * FROM `answer`";
$query = mysqli_query($con,$pre_query);

//if (mysqli_num_rows($query)==0) {
//    echo "BREAK no new record !";
//    exit();

 //};
$del_count = "TRUNCATE table word_count";
mysqli_query($con,$del_count);

$del_count = "TRUNCATE table word_total";
mysqli_query($con,$del_count);

$del_count = "TRUNCATE table word_prob";
mysqli_query($con,$del_count);


$row_id = "";
while($row = mysqli_fetch_assoc($query)) {
    $row_id = $row['id'];
    $row_cat = $row['catalog'];
    $row_answer = $row['answer'];

    //Add id to database

    //$add_id = "INSERT INTO `word_count` (`id_primary_key`, `its_cat`) VALUES (`$row_id`, `$row_cat`) ON DUPLICATE KEY UPDATE `id_primary_key` = `id_primary_key`";
    $add_id = "INSERT INTO `word_count` (`id_primary_key`, `its_cat`) VALUES ('$row_id', '$row_cat');";
    mysqli_query($con,$add_id);
    echo $row_id . "<br>";


    //*** SPLIT WORD OCCUR HEREEEEEEEEEE **//

    // Make lower case
    $row_answer_lower = strtolower($row_answer);
    //Filter out all weird sign and split with space
    $array_answer = preg_split('/((^\p{P}+)|(\p{P}*\s+\p{P}*)|(\p{P}+$))/', $row_answer_lower, -1, PREG_SPLIT_NO_EMPTY);
    //$array_answer = explode(" ", $row_answer);
    echo "Array = ";
    print_r($array_answer);
    echo "<br>";

    foreach ($array_answer as $seperate_word) {
        //$query_word_count = "SET @query = (SELECT IF((SELECT COUNT(1) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA=database() AND TABLE_NAME = 'word_count' AND COLUMN_NAME = '$seperate_word')=0, CONCAT('ALTER TABLE word_count ADD COLUMN $seperate_word int DEFAULT 0'), 'UPDATE word_count SET $seperate_word = $seperate_word+1 WHERE id = 1;')); PREPARE st FROM @query; EXECUTE st;";
        $set_query = "SELECT count(*) AS count_result FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='keras' AND TABLE_NAME = 'word_count' AND COLUMN_NAME = '$seperate_word'";
        $query_word_count = mysqli_query($con,$set_query);
        $get_count= mysqli_fetch_array($query_word_count);

        $count_if = $get_count['count_result'];







        if ($count_if == 0) {

            //Drop Col
            //$drop_col = "ALTER TABLE word_count DROP COLUMN $seperate_word;";
            //mysqli_query($con,$drop_col);
            //Create Col
            $query_alter = "ALTER TABLE word_count ADD COLUMN `$seperate_word` int DEFAULT 0";
            mysqli_query($con,$query_alter);
            //Update Value
            $query_update = "UPDATE word_count SET `$seperate_word` = `$seperate_word`+1 WHERE id_primary_key = $row_id;";
            mysqli_query($con,$query_update);
            echo "Add word : ".$seperate_word;



        }
        else {
            $query_update = "UPDATE word_count SET `$seperate_word` = `$seperate_word`+1 WHERE id_primary_key = $row_id;";
            mysqli_query($con,$query_update);
            echo "Update word : ".$seperate_word;


        }

        //if (!next($seperate_word)){
        //   Select SUM(red) FROM word_count
        //}

        echo "<br>";
    }//end foreach loop



} //end while loop

$query_colname = mysqli_query($con,'SHOW columns FROM word_count;');
while($row_col = mysqli_fetch_assoc($query_colname)) {
  $col_name = $row_col['Field'];

  $query_sum_each = "select sum(`$col_name`) as each_count, `its_cat` from word_count group by `its_cat`";
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
