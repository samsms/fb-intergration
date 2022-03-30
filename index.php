<?php
session_start();
 ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1); 
 error_reporting(E_ALL);
require_once __DIR__ . '/vendor/autoload.php'; // download official fb sdk for php @ https://github.com/facebook/php-graph-sdk

$fb = new Facebook\Facebook([
  'app_id' => '467734418431236',
  'app_secret' => '79f8c3442e533b930a0ca9a9084d5019',
  'default_graph_version' => 'v2.12',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // optional

try {
  if (isset($_SESSION['localhost_app_token'])) {
    $accessToken = $_SESSION['localhost_app_token'];
  } else {
      $accessToken = $helper->getAccessToken();
  }
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
  if (isset($_SESSION['localhost_app_token'])) {
    $fb->setDefaultAccessToken($_SESSION['localhost_app_token']);
  } else {
    // getting short-lived access token
    $_SESSION['localhost_app_token'] = (string) $accessToken;

      // OAuth 2.0 client handler
    $oAuth2Client = $fb->getOAuth2Client();

    // Exchanges a short-lived access token for a long-lived one
    $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['localhost_app_token']);

    $_SESSION['localhost_app_token'] = (string) $longLivedAccessToken;

    // setting default access token to be used in script
    $fb->setDefaultAccessToken($_SESSION['localhost_app_token']);
  }

  // redirect the user back to the same page if it has "code" GET variable
  if (isset($_GET['code'])) {
    header('Location: ./');
  }

  // getting basic info about user
  try {
    $profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
    $profile = $profile_request->getGraphNode()->asArray();
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    session_destroy();
    // redirecting user back to app login page
    header("Location: ./");
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }

  // debugging access token
  $debugToken = $fb->get('/debug_token?input_token='. $_SESSION['localhost_app_token']);
  $debugToken = $debugToken->getGraphNode()->asArray();

  // printing out debugToken response array on screen
  echo "<pre>";
  print_r($debugToken);
  echo "</pre>";
    // Now you can redirect to another page and use the access token from $_SESSION['localhost_app_token']
} else {
  // replace your website URL same as added in the developers.facebook.com/apps e.g. if you used http instead of https and you used non-www version or www version of your website then you must add the same here
  $loginUrl = $helper->getLoginUrl('https://sam-fb.herokuapp.com/', $permissions);
  echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
}