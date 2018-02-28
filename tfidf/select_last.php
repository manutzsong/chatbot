<?php

$con = mysqli_connect('localhost','root','128029486','keras');

$uid = $_POST['line_uid'];

$sql_last_record = "SELECT message FROM `chat_log` WHERE `uid` = '$uid' ORDER BY id DESC LIMIT 1";
$sql_record_query = mysqli_query($con,$sql_last_record);
$result_pre = mysqli_fetch_array($sql_record_query);
$result = $result_pre['message'];

$query_insert = "INSERT INTO `chat_log_no` (`id`, `ask`, `answer`) VALUES (NULL, '$result', NULL);";
mysqli_query($con,$query_insert);

echo "Your response has been saved";
?>
