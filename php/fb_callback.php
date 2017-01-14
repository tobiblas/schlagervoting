<?php
    require_once __DIR__ . '/php-graph-sdk-5.0.0/src/Facebook/autoload.php';
    session_start();
    
    

# login-callback.php
$fb = new Facebook\Facebook([
                            'app_id' => '1615633848746410', // Replace {app-id} with your app id
                            'app_secret' => 'c6105888a635b10a5800f1f261d80e34',
                            'default_graph_version' => 'v2.2',
                            ]);

$helper = $fb->getRedirectLoginHelper();
try {
    $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (isset($accessToken)) {
    // Logged in!
    $_SESSION['facebook_access_token'] = (string) $accessToken;
    echo (string) $accessToken;
    // Now you can redirect to another page and use the
    // access token from $_SESSION['facebook_access_token']
}
    
    try {
        $response = $fb->get('/me?fields=id,name', $accessToken );
        $userNode = $response->getGraphUser();
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
    
    #TODO get picture as http://graph.facebook.com/userid_here/picture
    
    #echo 'Logged in as ' . $userNode->getName();
    
    #CREATE TABLE USERS(ID INTEGER PRIMARY KEY AUTOINCREMENT, NAME TEXT UNIQUE NOT NULL, PASSWORD TEXT, FBID INTEGER, MELLOTOKEN TEXT);
    
    #LOGIN TO MELLO
    #1 GENERATE MELLOTOKEN,
    $token = getGUID();
    $name = $userNode->getName();
    $fbid = $userNode->getId();
    
    $sql = "insert or replace into users (name, fbid, mellotoken) values (" . $name . "," . $fbid . "," . $token . ")";
    
    $dbh->query($sql);

    #upsert user in database. id = incerease, fbId = facebookid, name = Facebookname
    
    #set cookie an redirect to index page.
    
    function getGUID(){
        if (function_exists('com_create_guid')){
            return com_create_guid();
        }else{
            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid = substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12);
            return $uuid;
        }
    }
    
    ?>