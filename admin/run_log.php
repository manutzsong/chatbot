<?php

$con = mysqli_connect('localhost','root','128029486','keras');

$query_lastrun = "SELECT * FROM last_script";
$result_lastrun = mysqli_query($con,$query_lastrun);
$run_query = mysqli_fetch_array($result_lastrun);
echo "Last run : " . $run_query['chat'] . "<br>";

$last_run = $run_query['chat'];
$last_chat_id = $run_query['chat_id'];

echo "THIS IS CHAT ID " . $last_chat_id;
$query = "SELECT * FROM `chat_log` WHERE id > $last_chat_id";
$result = mysqli_query($con,$query);


if (mysqli_num_rows($result)==0) { 
    echo "BREAK no new record !";
    exit();

 };
$last_row_id = "";
while ($row_chatlog = mysqli_fetch_assoc($result)) {
	$last_row_id = $row_chatlog['id'];
	echo "Processing : ".$row_chatlog['message']."<br>";


	$text_to_insert_b4 = $row_chatlog['message'];
	$text_to_insert = mysqli_real_escape_string($con,$text_to_insert_b4);
	
	echo "Escape String Result : ";
	echo $text_to_insert;
    //Filter out all weird sign and split with space
    $array_answer = explode(",", $text_to_insert);
	
	foreach ($array_answer as $seperate_word) {
		$sql_count = "INSERT INTO `chat_total` (`id`, `word`, `word_count`) VALUES (NULL, '$seperate_word', '1') ON DUPLICATE KEY UPDATE word_count = word_count + 1;";
		mysqli_query($con,$sql_count);
		echo "<br>Insert $seperate_word";
	}
	echo "<br><br>Done : ".$row_chatlog['message']."<br>";
}

$update_lastrun = "UPDATE `last_script` SET `chat` = NOW() , `chat_id` = '$last_row_id' WHERE `last_script`.`id` = 1;";
mysqli_query($con,$update_lastrun);


echo "<br>Success run log at : " . $run_query['chat'];

?>