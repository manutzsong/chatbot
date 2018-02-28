<?php


$con = mysqli_connect('localhost','root','128029486','keras');

//$receive_text = $_POST['rec_text'];
$receive_text = "tell me dude wtf";

$row_answer_lower = strtolower($receive_text);
$re = '/(?<=[a-zA-z])\s+(?=\d)/'; //Regex
$text_regex = preg_replace($re,"",$row_answer_lower);
//Filter out all weird sign and split with space
$array_answer = preg_split('/((^\p{P}+)|(\p{P}*\s+\p{P}*)|(\p{P}+$))/', $text_regex, -1, PREG_SPLIT_NO_EMPTY);






//print_r($array_answer);
$data = array(); //create new array
foreach ($array_answer as $value) {
    $query_count = "SELECT word_count, word_catalog FROM `word_total` WHERE word_name = '$value'";
    $run_query = mysqli_query($con,$query_count);
    //word not found in DB
    //print_r(mysqli_fetch_object($run_query));


    //check if not exist

    //init value 0 for not exist word

    $word_count_init = 0;
    if (mysqli_num_rows($run_query) == 0) {
        //get catalog
        $run_select_cat = "SELECT `word_catalog` FROM `word_total` GROUP BY word_catalog";
        $run_select_cat = mysqli_query($con,$run_select_cat);
        while ($row_count = mysqli_fetch_assoc($run_select_cat)) {
            $what_cat = $row_count['word_catalog'];
            array_push($data, 
                array("word_cat" => "$what_cat",
                "word_data" => array(
                    "word" => "$value",
                    "word_count" => "$word_count")
                
                )
            
                );//end arrayp ush

        }//end while



    }//end not exist check
    else {
        while ($row = mysqli_fetch_assoc($run_query)) {
            $what_cat = $row['word_catalog'];
            $what_count = $row['word_count'];

            array_push($data, 
            array("word_cat" => "$what_cat",
            "word_data" => array(
                "word" => "$value",
                "word_count" => "$what_count")
            
            )
        
            );


        }
    }//else if its exist



    //while ($row = mysqli_fetch_assoc($run_query)) {
    //    echo $row['word_catalog'];
    //}//end while
}

print_r($data);
?>