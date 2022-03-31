<?php
session_start();
if(!isset($_SESSION['facebook_page_access_token'])){

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
$loginUrl = $helper->getLoginUrl('https://sam-fb.herokuapp.com/webhook.php');
header("location:$loginUrl"); 

}


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <head>
 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


 
  <script>
    var threads=[];
   var chats=[];
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '467734418431236',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v13.0'
    });
  fetch("/fb.php").then(res=>res.json).then(response=>{
    var i=0;
     response.data.forEach(function(res){
       

        res.messages.data.forEach(function(message){
          
          //alert(JSON.stringify(message));
           chats.push([++i,res.senders.data[0].name,message.message]);
       });
     

   });
      display(chats);
  //document.getElementById("app").innerHTML=JSON.stringify(chats);

 

  });
}
function display(c){

   $('#chats').DataTable( {
        data: c,
        columns: [
            {title:"id"},
            { title: "sender" },
            { title: "message" },
            
        ]
    } );
  
}
</script>

<style type="text/css">
  th{
    background-color:#2196F3 ;
    color: #fff;
  }
</style>
</head>
<body>
<div id="app" class="container " style="margin-top:10px ;">
  <table id="chats" class="display">
    
  </table>
</div>
</body>
</html>