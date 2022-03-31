<?php
session_start();
if(!isset($_SESSION['facebook_page_access_token'])){
require("config.php");
$helper = $fb->getRedirectLoginHelper();
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
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    var threads=[];
   var chats=[];
  $.get("/read.php",function(response){
    var i=0;
     response.data.forEach(function(res){
        res.messages.data.forEach(function(message){
           chats.push([++i,res.senders.data[0].name,message.message,message.created_time]);
       });
   });
      display(chats);
  });

function display(c){

   $('#chats').DataTable( {
        data: c,
        columns: [
            {title:"id"},
            { title: "sender" },
            { title: "message" },
            {title: "time" },
            
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