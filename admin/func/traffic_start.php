<?php
include('conf.php');
set_include_path('../SSHa');
include('Net/SSH2.php');


$ssh = new Net_SSH2($host_ssh);
if (!$ssh->login($user_ssh, $pw_ssh)) {
    exit('Login Failed');
}

$ssh->exec('rm /home'.$path.'stats2_out.log');

$ssh->exec('supervisorctl restart stats');

$result_ssh = $ssh->exec('supervisorctl status stats');
$exploded=preg_split('/\s+/',$result_ssh); //Limit is unspecified, so it will return all the substrings;	

if ($exploded[1] == 'RUNNING') {
	echo ('work');
}
else {
	echo ('no');
}
;

?>