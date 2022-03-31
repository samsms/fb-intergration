<?php
header("content-type:application/json");
session_start();
 ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$recipient=$_POST['recipient'];
$message=$_POST['message'];
 require_once __DIR__ . '/vendor/autoload.php';
$fb = new Facebook\Facebook([
  'app_id' => '467734418431236',
  'app_secret' => '79f8c3442e533b930a0ca9a9084d5019',
  'default_graph_version' => 'v2.10',
  'default_access_token'=>$_SESSION['facebook_page_access_token']
  ]);


try {

$data=[
  "recipient"=> "{id: $recipient}",
  "message"=> "{text:$message}"
];

$messages=$fb->post("/kkaalliance/messages}",$data);


} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

echo json_encode($messages->getDecodedBody());

?>