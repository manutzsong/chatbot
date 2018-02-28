<?php


$con = mysqli_connect('localhost','root','128029486','keras');

//$receive_text = $_POST['rec_text'];
$receive_text = "could you please tell me about english 1 course ?";

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
    print_r(mysqli_fetch_object($run_query));
    echo "<br><br><br>";
    if (mysqli_num_rows($run_query)==0) {
        $run_select_cat = "SELECT `word_catalog` FROM `word_total` GROUP BY word_catalog";
        $run_select_cat = mysqli_query($con,$run_select_cat);
        $word_count = 0;
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
    }//end if
    //end word not found
    else {
        while ($row_count = mysqli_fetch_assoc($run_querry)) {
            $what_count = $row_count['word_count'];
            $what_cat = $row_count['word_catalog'];

            array_push($data, 
                array("word_cat" => "$what_cat",
                "word_data" => array(
                    "word" => "$value",
                    "word_count" => "$what_count")
                
                )
            
                );

        }//end while
    }
    
    
    
    

}//end foreach

$json_string = json_encode($data, JSON_PRETTY_PRINT);
echo $json_string;

?>