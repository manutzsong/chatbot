

<?php

$con = mysqli_connect('localhost','root','128029486','keras');


$del_count = "TRUNCATE table word_count_total";
mysqli_query($con,$del_count);

$query_sum_each = "select sum(`word_count`) as each_count,`word_catalog` from word_total group by `word_catalog`";
$query_wordname = mysqli_query($con,$query_sum_each);

while($row_count_each = mysqli_fetch_assoc($query_wordname)) {

    $each_count = $row_count_each['each_count'];
    $group_name = $row_count_each['word_catalog'];


    $run_wordtotal = "INSERT INTO `word_count_total` (`id`, `word`, `count`) VALUES (NULL, '$group_name', '$each_count');";
    mysqli_query($con,$run_wordtotal);


    echo $each_count . " words in " . $group_name . "<br>";



}//end while select *



?>
