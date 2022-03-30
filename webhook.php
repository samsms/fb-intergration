<?php 
session_start();
 ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 require_once __DIR__ . '/vendor/autoload.php';
$fb = new Facebook\Facebook([
  'app_id' => '467734418431236',
  'app_secret' => '79f8c3442e533b930a0ca9a9084d5019',
  'default_graph_version' => 'v2.10',
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
  $oAuth2Client = $fb->getOAuth2Client();
// Exchanges a short-lived access token for a long-lived one
$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
  $fb->setDefaultAccessToken($_SESSION['facebook_access_token'] );
 $response = $fb->sendRequest('GET', 'kkaalliance', ['fields' => 'access_token'])
          ->getDecodedBody();
print_r($response);
//header("location:fb.php");
  // Now you can redirect to another page and use the
  // access token from $_SESSION['facebook_access_token']
}?>