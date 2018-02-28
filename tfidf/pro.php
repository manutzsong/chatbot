<?php

$con = mysqli_connect('localhost','root','128029486','keras');


//$receive_text = "anything assosiate with data structure ?";
$receive_text = $_POST['line_text'];

$row_answer_lower = strtolower($receive_text);
//$re = '/(?<=[a-zA-z])\s+(?=\d)/'; //Regex
//$text_regex = preg_replace($re,"",$row_answer_lower);
//Filter out all weird sign and split with space
//$array_answer = preg_split('/((^\p{P}+)|(\p{P}*\s+\p{P}*)|(\p{P}+$))/', $text_regex, -1, PREG_SPLIT_NO_EMPTY);
$array_answer = explode(" ", $row_answer_lower);
$no_result = array();
$match_db = array();
foreach ($array_answer as $piece) {
    $query_search_prob = "SELECT $piece FROM `word_prob`";
    $result_prob = mysqli_query($con,$query_search_prob);
    if (!$result_prob) {

        //echo "Not $piece match";

        //array_push($no_result,$piece);
        //array_unique($no_result);
    }
    else {
        array_push($match_db,$piece);
    }

}//end foreach
$what_to_query = implode("` * `",$match_db);
$again_add = "`$what_to_query`";
//echo $again_add;

$search_prob_match = "SELECT SUM($again_add) as result_prob, its_cat FROM `word_prob` GROUP BY `its_cat` ORDER BY result_prob DESC LIMIT 5";
//echo "<br><br> $search_prob_match";
$result_of_query = mysqli_query($con,$search_prob_match);

while ($row = mysqli_fetch_assoc($result_of_query)) {
    if ($row['result_prob'] > 0 && $row['result_prob'] != 1) {
        $what_ans_id = $row['its_cat'];
        //echo $row['its_cat'] . "with probability " . $row['result_prob'] . "\n <br>";
        $query_select_ans = "SELECT answer FROM `answer` WHERE `id` = $what_ans_id";
        $query_ans = mysqli_query($con,$query_select_ans);
        $result_ans = mysqli_fetch_array($query_ans);
        $answer_it_is = $result_ans['answer'];
        echo $row['its_cat'] . " : " . substr($answer_it_is,0,20) . " with probability " . $row['result_prob'] . "\n";
    }
}

?>
