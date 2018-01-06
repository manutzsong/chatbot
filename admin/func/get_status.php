
<?php

set_include_path('../SSHa');
include('Net/SSH2.php');


$ssh = new Net_SSH2('dreamcatcherbkk.me');
if (!$ssh->login('root', '128029486')) {
    exit('Login Failed');
}

$result_ssh = $ssh->exec('supervisorctl status chatbot');
			
$exploded=preg_split('/\s+/',$result_ssh); //Limit is unspecified, so it will return all the substrings;	
	//print_r($exploded);



$result->name = $exploded[0];
$result->status = $exploded[1];
$result->pid = $exploded[3];
$result->uptime = $exploded[5];


$result_json = json_encode($result);

//echo $result_json;
echo json_encode($exploded);
?>