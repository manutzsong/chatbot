


<?php

$access_token = '34af60e6f8414c698257f96b2a1dd5fe';
$intent_id = $_POST['intent_what'];
$url = 'https://api.dialogflow.com/v1/intents/'.$intent_id.'?v=20150910';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

$events = json_decode($result,true);
//print_r($events[responses][0][messages][0][speech]);

$before_return = $events[responses][0][messages][0][speech];
$return_after = json_encode($before_return);
echo $return_after;
//print_r($events);
