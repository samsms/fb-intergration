<?php
header("content-type:application/json");
require('config.php');
try {
$messages=$fb->get("/$page/conversations?fields=senders,messages{message,created_time}");

} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

echo json_encode( new array("messages"=>$messages->getDecodedBody(),"page_id"=>pageid($fb)));

?>
