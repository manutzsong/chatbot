<?php

$con = mysqli_connect('localhost','root','128029486','keras');




//$del_count = "TRUNCATE table word_total";
//mysqli_query($con,$del_count);







$pre_query = "SELECT * FROM `answer` WHERE 1";
$query = mysqli_query($con,$pre_query);



 $del_count = "TRUNCATE table word_total";
mysqli_query($con,$del_count);
$del_count = "TRUNCATE table word_count";
mysqli_query($con,$del_count);

$row_id = "";
while($row = mysqli_fetch_assoc($query)) { 
    $row_id = $row['id'];
    $row_answer = $row['answer'];

    //Add id to database

    $add_id = "INSERT INTO `word_count` (`id_primary_key`) VALUES ('$row_id') ON DUPLICATE KEY UPDATE `id_primary_key` = `id_primary_key`";
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
        $set_query = "SELECT count(*) AS count_result FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='keras' AND TABLE_NAME = 'word_count' AND COLUMN_NAME = `$seperate_word`";
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



$query_colname = mysqli_query($con,'SHOW COLUMNS FROM word_count');
while($row_col = mysqli_fetch_assoc($query_colname)) { 
    $col_name = $row_col['Field'];
    //echo "Column Name : ".$col_name." : ";
    if ($col_name != "id_primary_key") {
        $sum_col = mysqli_query($con,"Select SUM($col_name) AS count_total FROM word_count");
        
        $sum_result= mysqli_fetch_array($sum_col);
        //echo $sum_result['count_total'];
        $sum_insert = $sum_result['count_total'];
    
        $run_wordtotal = "INSERT INTO `word_total` (`id_primary_key`, `word_name`, `word_count`) VALUES (NULL, '$col_name', '$sum_insert');";

        mysqli_query($con,$run_wordtotal);
    }

    
}
echo "Done word_total";
echo $row_id;



// $query_count = mysqli_query($con,'SELECT * FROM word_count');


// while($row_to_count = mysqli_fetch_assoc($query_count)) { 
//     $row_to_count['']



// }

?>