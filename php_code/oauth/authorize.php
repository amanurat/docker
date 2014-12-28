<?php

require_once 'oauth/GitHubRepo.php';

$paramList = array_merge($_POST, $_GET);
print_r($paramList, true);
print_r('<br>');

if ($paramList['state'] != GitHubService::TEMP_STATE) {
    print_r('Code failed to pass verification');
    return;
}

print_r('Code was verified. Retrieving access token...<br>');

$token = GitHubService::getAccessToken($paramList['code']);
if (isset($token)) {
    print_r("got access token: $token");
} else {
    print_r('failed to get access token');
}

?>