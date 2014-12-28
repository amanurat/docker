<?php

require_once 'oauth/GitHubRepo.php';

?>

<html>
    <meta charset="utf-8">
    <title>Ucdream</title>
    <style>
        .box {
            padding: 12px;
            border: 1px solid;
        }
    </style>
</html>

<h1>Welcom to ucdream</h1>
<div class="box">
    <a href="<?php echo GitHubService::getAuthorizeUrl() ?>">Connect github</a>
</div>
