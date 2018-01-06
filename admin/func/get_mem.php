<?php

    $free = shell_exec('free');
    $free = (string)trim($free);
    $free_arr = explode("\n", $free);
    $mem = explode(" ", $free_arr[1]);
    $mem = array_filter($mem);
    $mem = array_merge($mem);
    $memory_usage1 = $mem[2]/$mem[1]*100;
	$memory_usage = number_format((float)$memory_usage1, 2, '.', '');
	
	
	$load = sys_getloadavg();
    $load[0];
	
	
	
	
	$bytes = disk_free_space("."); 
    $si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
    $base = 1024;
    $class = min((int)log($bytes , $base) , count($si_prefix) - 1);
    //echo $bytes . '<br />';
    $space = sprintf('%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class];
	
	
	$disk_total = disk_total_space("/");
	$class_total = min((int)log($bytes , $base) , count($si_prefix) - 1);
	$space_total = sprintf('%1.2f' , $disk_total / pow($base,$class_total)) . ' ' . $si_prefix[$class_total];
	//echo $space_total;
	$result = [$memory_usage.' %',$load[0].' %',$space,$space_total];
	
    echo json_encode($result);
		
	
	?>