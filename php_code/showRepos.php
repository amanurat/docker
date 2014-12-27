<?php

$paramList = array_merge($_POST, $_GET);
$user = array_key_exists('uid', $paramList) ? $paramList['uid'] : null;
if (!isset($user)) {
    print_r('Should pass arg uid');
    return;
}

$token = '731b602dc5a58bed1d659811003bef9d6bfe2d7f';

$header = array(
    'Accept: application/vnd.github.v3+json',
    "Authorization: token $token"
);

$ch = curl_init();

//header
curl_setopt($ch, CURLOPT_HTTPHEADER , $header);
curl_setopt($ch, CURLOPT_HEADER, 1);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// request type and params
$formData = http_build_query(array('type' => 'owner'));
curl_setopt($ch, CURLOPT_GET, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $formData);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// user agent
curl_setopt($ch, CURLOPT_USERAGENT, 'ucdream');

curl_setopt($ch, CURLOPT_URL, "https://api.github.com/users/$user/repos");
$result = curl_exec($ch);
curl_close($ch);

print_r("repos for user $user<br>");
print_r($result);

?>
