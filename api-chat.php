<?php
header("content-type:application/json");
require('config.php');
$path="";
if(isset($_GET['path'])){
  $path="/".$_GET['path'];
}
try {

$field=$_GET["field"];
$messages=$fb->get("/$page/conversations$path?fields=$field");
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

echo json_encode($messages->getDecodedBody());

?>
