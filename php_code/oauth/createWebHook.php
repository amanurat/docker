<?php

$paramList = array_merge($_POST, $_GET);
$userId = array_key_exists('uid', $paramList) ? $paramList['uid'] : null;
if (!isset($userId)) {
    print_r('Should pass arg uid');
    return;
}

print_r("repos for user $userId<br>");

require_once 'GitHubRepo.php';

$repos = GitHubService::getUserRepositories($userId);
if (count($repos) < 1) {
    print_r('no repos!');
    return;
}

// create a webhook for first repo
$repoName = $repos[0]['name'];
print_r("Createing webhook for repo $repoName<br>");

$result = GitHubService::createWebhook($userId, $name);
print_r($result);

?>
