<?php
require('config.php');
$recipient=$_POST['recipient'];
$message=$_POST['msg'];

try {

$data=[
  "recipient"=> ["id"=> $recipient],
  "message"=> ["text"=>$message]
];

die(json_encode($page));

$messages=$fb->post("/$page/messages",$data);

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
