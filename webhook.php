<?php 
session_start();
require('config.php');
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
  $_SESSION['facebook_page_access_token'] =$response['access_token'];
//echo($response['access_token']);
header("location:index.php");
  // Now you can redirect to another page and use the
  // access token from $_SESSION['facebook_access_token']
}?>