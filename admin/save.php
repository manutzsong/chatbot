<?php

@include "db.php";

$yes = $_POST['textbox'];

$query = "INSERT INTO `register` (`id`, `uid`, `date_create`) VALUES (NULL, '$yes', CURRENT_TIMESTAMP);";
//$query = "DELETE FROM `mute` WHERE `mute`.`id` = $yes";

$what = mysqli_query($con,$query);


?>