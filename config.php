<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';
$page_id="467734418431236";
$app_secret="79f8c3442e533b930a0ca9a9084d5019";
$page="kkaalliance";
$fb = new Facebook\Facebook([
  'app_id' => $page_id,
  'app_secret' => $app_secret,
  'default_graph_version' => 'v2.10',
  'default_access_token'=>$_SESSION['facebook_page_access_token']
  ]);
function pageid($fb){
    return $fb->get("/$page")->getDecodedBody();
}

?>