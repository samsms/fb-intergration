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

$fb->setDefaultAccessToken($_SESSION['facebook_access_token'] );
try {
  $response = $fb->sendRequest('GET', 'kkaalliance', ['fields' => 'access_token'])
          ->getDecodedBody();
  $fb->setDefaultAccessToken($response['access_token']);
  $messages=$fb->get("/kkaalliance/conversations",'senders,messages{message}');


} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

print_r($messages);

?>
