<?php

const CLIENT_ID = '44f394bbec284f60b224';
const CLIENT_SECRET = '72f315fda524369a236a01c2d60bf9ab64a0474d';
const SCOPE = 'repo';
const AUTH_URI = 'https://github.com/login/oauth/access_token';
const REDIRECT_URI = 'http://www.ucdream.com/oauth/github.php';
const STATE = '123456789';

$paramList = array_merge($_POST, $_GET);
print_r($paramList, true);
print_r('<br>');

if ($paramList['state'] != STATE) {
    print_r('Code failed to pass verification');
    return;
}

print_r('Code was verified. Retrieving access token...<br>');
    
// send post request and get access token
$data = http_build_query(array(
    'client_id' => CLIENT_ID,
    'client_secret' => CLIENT_SECRET,
    'code' => $paramList['code'],
    'redirect_uri' => REDIRECT_URI
));

$context = stream_context_create(array(
    'http' => array(
        'content' => $data,
        'header' => "Accept: application/json\r\nContent-type: application/x-www-form-urlencoded\r\nContent-Length:" . strlen($data) . "\r\n",
        'method' => 'POST',
        'User-Agent' => 'ucdream'
    )
));

$result = file_get_contents(AUTH_URI, false, $context);
print_r($result);

?>