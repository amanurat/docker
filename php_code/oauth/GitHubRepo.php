<?php

class GitHubService {
    const ACCESS_TOKEN = '731b602dc5a58bed1d659811003bef9d6bfe2d7f';
    const CLIENT_ID = '44f394bbec284f60b224';
    const CLIENT_SECRET = '72f315fda524369a236a01c2d60bf9ab64a0474d';
    
    const SCOPE = 'repo';
    
    // should be generated for each user
    const TEMP_STATE = '123456789';
    
    const URI_AUTHORIZE = 'https://github.com/login/oauth/authorize';
    const URI_AUTH_REDIRECT = 'http://www.ucdream.com/oauth/authorize.php';
    const URI_AUTH_TOKEN = 'https://github.com/login/oauth/access_token';
    const URI_WEBHOOK = 'http://www.ucdreamcom/oauth/payload.php';
    
    const USER_AGENT = 'ucdream';
    
    public static function createWebhook($userId, $repo) {
        $hookUrl = self::getURL("/repos/$userId/$repo/hooks");
        
        $payload = json_encode(array(
            'active' => true,
            'config' => array(
                'content_type' => 'json',
                'url' => self::URI_WEBHOOK
            ),
            'events' => array('push'),
            'name' => 'web'
        ));
        
        $header = array('Content-Type:application/json', 'Authorization: token ' . self::ACCESS_TOKEN);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        
        //header
        curl_setopt($ch, CURLOPT_HTTPHEADER , $header);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        
        // user agent
        curl_setopt($ch, CURLOPT_USERAGENT, self::USER_AGENT);
        
        // request type
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        
        curl_setopt($ch, CURLOPT_URL, $reposUrl);
        
        $result = curl_exec($ch);
        curl_close($ch);
        
        return json_decode($ch);
        
    }
    
    public static function getAccessToken($gitCode) {
        $data = http_build_query(array(
            'code' => $gitCode,
            'client_id' => self::CLIENT_ID,
            'client_secret' => self::CLIENT_SECRET,
            'redirect_uri' => self::URI_AUTH_REDIRECT
        ));
        
        $context = stream_context_create(array(
            'http' => array(
                'content' => $data,
                'header' => "Accept: application/json\r\nContent-type: application/x-www-form-urlencoded\r\nContent-Length:" . strlen($data) . "\r\n",
                'method' => 'POST',
                'User-Agent' => self::USER_AGENT
            )
        ));
        
        $result = file_get_contents(self::URI_AUTH_TOKEN, false, $context);
        $result = json_decode($result, true);
        
        return array_key_exists('access_token', $result) ? $result['access_token'] : null;
    }
    
    public static function getAuthorizeUrl() {
        $dataStr = http_build_query(array(
            'client_id' => self::CLIENT_ID,
            'client_secret' => self::CLIENT_SECRET,
            'redirect_uri' => self::URI_AUTH_REDIRECT,
            'scope' => self::SCOPE,
            'state' => self::TEMP_STATE
        ));
        
        return self::URI_AUTHORIZE . "?$dataStr";
    }
    
    public static function getURL($path) {
        return 'https://api.github.com' . $path;
    }
    
    public static function getUserRepositories($userId) {
        $reposUrl = self::getURL("/users/$userId/repos?type=owner");
        
        $header = array(
            'Accept: application/vnd.github.v3+json',
            'Authorization: token ' . self::ACCESS_TOKEN
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        
        //header
        curl_setopt($ch, CURLOPT_HTTPHEADER , $header);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        
        // user agent
        curl_setopt($ch, CURLOPT_USERAGENT, self::USER_AGENT);
        
        // request type
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        
        curl_setopt($ch, CURLOPT_URL, $reposUrl);
        
        $result = curl_exec($ch);
        curl_close($ch);
        
        return json_decode($result);
    }
}


?>