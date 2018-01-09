<?php
@include "conf.php";

$yes = $_POST['del_id'];

$query = "DELETE FROM `mute` WHERE `mute`.`id` = $yes";

$what = mysqli_query($con,$query);

?>