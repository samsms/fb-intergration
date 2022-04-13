<?php
require('config.php');

try {

$data=[
  "recipient"=> ["id"=> $recipient],
  "message"=> ["text"=>$message]
];

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
