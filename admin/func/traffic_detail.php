<?php
include('conf.php');
set_include_path('../SSHa');
include('Net/SSH2.php');


$ssh = new Net_SSH2($host_ssh);
if (!$ssh->login($user_ssh, $pw_ssh)) {
    exit('Login Failed');
}

echo nl2br($ssh->exec('cat /home'.$path.'stats2_out.log'));






?>