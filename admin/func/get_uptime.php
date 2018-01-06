<?php
set_include_path('../SSHa');
include('Net/SSH2.php');


$ssh = new Net_SSH2('dreamcatcherbkk.me');
if (!$ssh->login('root', '128029486')) {
    exit('Login Failed');
}

echo $ssh->exec('uptime -p');






?>