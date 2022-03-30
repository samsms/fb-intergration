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
//$permissions = ['email', 'user_likes']; // optional
$loginUrl = $helper->getLoginUrl('https://sam-fb.herokuapp.com/test/webhook.php');
echo '<a href="' . $loginUrl . '">Log in with Facebook! '.$loginUrl.'</a>';

?>

