<?php


const CLIENT_ID = '44f394bbec284f60b224';
const CLIENT_SECRET = '72f315fda524369a236a01c2d60bf9ab64a0474d';
const SCOPE = 'repo';
const AUTH_URI = 'https://github.com/login/oauth/authorize';
const REDIRECT_URI = 'http://www.ucdream.com/oauth/github.php';

$authUrl = AUTH_URI . '?' . 'client_id=' . CLIENT_ID
    . '&client_secret=' .CLIENT_SECRET
    . '&scope=' . SCOPE
    . '&redirect_uri=' . REDIRECT_URI
    . '&state=123456789';

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
    <a href="<?php echo $authUrl ?>">Connect github</a>
</div>
