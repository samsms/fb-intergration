<?php
require('config.php');
$recipient=$_POST['recipient'];
$message=$_POST['msg'];
try {
 $id= $_GET['thread_id'];
$messages=$fb->get("$id?fields=messages{message,created_time,from,to}");

} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
    echo json_encode("error");
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
    echo json_encode("error");
  exit;
}

try {

$data=[
  "recipient"=> ["id"=> $recipient],
  "message"=> ["text"=>$message]
];

//die(json_encode($page));
$id=$fb->get("/$page")->getDecodedBody()['id'];
$messages=$fb->post("/$id/messages",$data);

} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo json_encode("error");
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
 
   echo json_encode("error");
}

echo json_encode( $messages->getDecodedBody());
);
