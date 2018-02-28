<?php

$con = mysqli_connect('localhost','root','128029486','keras');

//receive_line = $_POST['line_text']; //Webhook receive data from line.

$receive_line = "Can you tell me about Data Mining course ?";


$row_answer_lower = strtolower($receive_line);
$re = '/(?<=[a-zA-z])\s+(?=\d)/'; //Regex
$text_regex = preg_replace($re,"",$row_answer_lower);
//Filter out all weird sign and split with space
$array_answer = preg_split('/((^\p{P}+)|(\p{P}*\s+\p{P}*)|(\p{P}+$))/', $text_regex, -1, PREG_SPLIT_NO_EMPTY);

//echo "<br>";
//print_r($array_answer);
$data = array();
foreach ($array_answer as $seperate_word) {
    $select_query = "SELECT * FROM `word_total` WHERE `word_name` = '$seperate_word'";
    $run_query = mysqli_query($con,$select_query);
    $total = 0;



    while ($row = mysqli_fetch_assoc($run_query)) {
        $b4_word = $row['word_name'];
        $b4_word_count = $row['word_count'];




        array_push($data, array(
            "word" => "$b4_word",
            "word_count" => "$b4_word_count"));

        

    }//End while
}//End foreach

//print_r($data);
//echo($data);
echo(json_encode($data));
echo "/n";

//https://stackoverflow.com/questions/2699086/sort-multi-dimensional-array-by-value
usort($data, function($a, $b) {
    return $a['word_count'] <=> $b['word_count'];
});

//print_r($data);

//Matching with another Table

$array_length_pre = sizeof($data);
//$array_length_cur = $array_length_pre - 2;
//$array_length = $array_length_pre - $array_length_cur;
//GET P

    $word_query = array();
    for($i=0;$i<=1;$i++) {
        //echo $data[$i]['word'];
        $word_query_each = $data[$i]['word'];
        array_push($word_query, array(
            "word" => "$word_query_each",
                )
        );

    }


$first_word = $word_query[0]['word'];
$second_word = $word_query[1]['word'];
print_r($word_query);
$select_id_query = "SELECT * FROM `word_count` WHERE `$first_word` != 0 LIMIT 1";

echo $select_id_query;

//echo $select_id_query;
//echo "<br>";

$select_id_result = mysqli_query($con,$select_id_query);

$what_id = "";
while($row_select = mysqli_fetch_assoc($select_id_result)) { 
    $what_id = $row_select['id_primary_key'];
    echo $what_id;


}
$select_answer_query = "SELECT * FROM answer WHERE id = $what_id";
$run_answer_query = mysqli_query($con,$select_answer_query);

while ($row_answer = mysqli_fetch_assoc($run_answer_query)) {
    echo $row_answer['answer'];

}
//foreach ($data as $sep_word) {
//    echo $sep_word['word'];
//};



?>
