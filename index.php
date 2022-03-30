<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <head>
 
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
     FB.api(
  '/kkaalliance/conversations',
  'GET',
  {fields: 'senders,messages{message}',
            access_token: 'EAAGpZAufcHQQBAGJoHZBG7fnAZBJWyjUZCsRVr6OtSsF8YRLKqNqsY0VttrAlipeqZAeouUSayGeZCy1bnTld11UzekaTNTpinqIbIdJHGOgV7NrFDc7VDXnZCpdxvTiWBHByDgxlFZAFyLRK9ycdNZBLCtZBBBqOQNpuraZBig7FjcQUAn720NXKSVAWdtfkF6o5kXdzBEEXEIbQZDZD'},
  function(response) {
    var i=0;
     response.data.forEach(function(res){
       

        res.messages.data.forEach(function(message){
          
          //alert(JSON.stringify(message));
           chats.push([++i,res.senders.data[0].name,message.message]);
       });
     

   });
      display(chats);
  //document.getElementById("app").innerHTML=JSON.stringify(chats);

 

  })};
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
    
 <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
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