

<?php
ini_set('max_execution_time', 300);

$con = mysqli_connect('localhost','root','128029486','keras');


$del_count = "TRUNCATE table word_prob";
mysqli_query($con,$del_count);

$stat_count = 0;

//get total words from whole training
$get_count_total = "SELECT count(*) as count_total FROM information_schema.columns WHERE table_name = 'word_count'";
$query_above = mysqli_query($con,$get_count_total);
$get_count_total= mysqli_fetch_array($query_above);
$count_total_pre = intval($get_count_total['count_total']);
$count_total = $count_total_pre - 2;

echo "Total words : " . $count_total;

$query_total_cat = mysqli_query($con,'SELECT * FROM word_count_total');
while ($row = mysqli_fetch_assoc($query_total_cat)) {
    $its_cat = $row['word'];
    $its_count = $row['count'];
    echo "<br> Start : $its_cat <br>";
    $insert_query = "INSERT INTO `word_prob` (`id_primary_key`, `its_cat`) VALUES (NULL, '$its_cat');";
    mysqli_query($con,$insert_query);
    $query_cat = mysqli_query($con,'SELECT * FROM `word_total`');
    while($row_cat = mysqli_fetch_assoc($query_cat)) {//start count each catalog count
        
        $count_word = $row_cat['word_count'];
        $count_word_name = $row_cat['word_name'];
        $count_word_cat = $row_cat['word_catalog'];

        if ($count_word_cat == $its_cat) {

            $plus_above = intval($count_word) + 1;
            $div_below = intval($its_count) + $count_total;

            $calc_result = $plus_above / $div_below;
            //echo $calc_result;
            //echo $count_word_name;
            //echo "<br><br>";
           

            $set_query = "SELECT count(*) AS count_result FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='keras' AND TABLE_NAME = 'word_prob' AND COLUMN_NAME = '$count_word_name'";
            $query_word_count = mysqli_query($con,$set_query);
            $get_count= mysqli_fetch_array($query_word_count);

            $count_if = $get_count['count_result'];

            if ($count_if == 0) {
                echo "Starting";
                //Drop Col
                //$drop_col = "ALTER TABLE word_count DROP COLUMN $seperate_word;";
                //mysqli_query($con,$drop_col);
                //Create Col
                $query_alter = "ALTER TABLE word_prob ADD COLUMN `$count_word_name` DECIMAL(18,12) DEFAULT 0";
                mysqli_query($con,$query_alter);


                //Update Value
                $query_update = "UPDATE `word_prob` SET `$count_word_name` = '$calc_result' WHERE `word_prob`.`its_cat` = '$its_cat';";
                mysqli_query($con,$query_update);
                echo "Add word : ".$count_word_name . " with probability [ $calc_result ] <br>";

                $stat_count += 1;

            }// if
            else {
                
                $query_update = "UPDATE `word_prob` SET `$count_word_name` = '$calc_result' WHERE `word_prob`.`its_cat` = '$its_cat';";
                mysqli_query($con,$query_update);
                echo "Update word : ".$count_word_name . " with probability [ $calc_result ] <br>";
                $stat_count+=1;

            }//end else
            


        }

        

        
    }//end word_total
}//end word_counT_total


echo "End with total $stat_count words";
?>
