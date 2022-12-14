<?php
session_start();
header("content-type:application/json");
require('config.php');
if(!isset($_GET['thread_id'])){
  
 die("error");
}
try {
 $id= $_GET['thread_id'];
$messages=$fb->get("$id?fields=messages{message,created_time,from,to}");

} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

echo json_encode( $messages->getDecodedBody());

?>
