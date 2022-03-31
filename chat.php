<?php 
require('config.php');
 ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>facebook- Bootsnipp.com</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript"> 

$(document).ready(function(){
$('#action_menu_btn').click(function(){
    $('.action_menu').toggle();
});

$('.threads').click(function(){
    $(this).css("background-color",  rgba(0,0,0,0.3));
});
    });


$(function(){  
$.get("https://sam-fb.herokuapp.com/api-chat.php?field=id,subject,message_count,updated_time,unread_count,senders",function(response){
response.data.forEach(function(res){
    var unread=res.unread_count;
    var thread_id=res.id;
    var count=res.message_count;
    var time=res.updated_time;
    var senders=res.senders.data[0];
    var name=senders.name;
    var sender_id=senders.id;
    $("#convs").append(getConversationId(thread_id,"https://bootdey.com/img/Content/avatar/avatar1.png",name,count))
})

//alert(JSON.stringify(response))

})


});
function fetchChats(id){
  //  $("#"+id).css("background-color: rgba(0,0,0,0.3)");
   // var threads=[];
   //var chats=[];
  
  $.get("/read.php?thread_id="+id,function(response){
    var i=0;
    $("#chats").html("");
     response.messages.data.forEach(function(res){
  
        $("#chats").append(displayChats(res.from.id,res.created_time,res.message,""));
        // chats.push([res.from.id,res.created_time,res.message,""]);
     
   });
   
  });

   

};
function displayChats(id,time,message,url){
    if(<?php echo $fb->get("/$page")->getDecodedBody()['id'];?>==id){
         return `<div class="d-flex justify-content-end mb-4">
                        <div class="msg_cotainer_send">
                           ${message}
                            <span class="msg_time_send">${time}</span>
                        </div>
                        <div class="img_cont_msg">
                    <img src="${url}" class="rounded-circle user_img_msg">
                        </div>
                    </div>`;
    }
    else{
        return`<div class="d-flex justify-content-start mb-4">
                        <div class="img_cont_msg">
                            <img src="${url}" class="rounded-circle user_img_msg">
                        </div>
                        <div class="msg_cotainer">
                            ${message}
                            <span class="msg_time">${time}</span>
                        </div>
                    </div>`
    }
   

}
function getConversationId(id,prof_url,name,count){

   var html=` <li class="threads" id="${id}" onclick="fetchChats('${id}')" style="cursor:pointer">
                    <div class="d-flex bd-highlight">
                        <div class="img_cont">
                            <img src="${prof_url}" class="rounded-circle user_img">
                            <span class="online_icon"></span>
                        </div>
                        <div class="user_info" style="overflow: hidden;white-space: nowrap;">
                            <span>${name}</span>
                            <p>${count} messages</p>
                        </div>
                    </div>
                </li>`; 
                    return html;
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script></head>
<body>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<title>Chat</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>



<div class="container-fluid h-100">
    <div class="row justify-content-center h-100">
        <div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
            <div class="card-header">
                <div class="input-group">
                    <input type="text" placeholder="Search..." name="" class="form-control search">
                    <div class="input-group-prepend">
                        <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                    </div>
                </div>
            </div>
            <div class="card-body contacts_body">
                <ui class="contacts" id="convs">
               
                </ui>
            </div>
            <div class="card-footer"></div>
        </div></div>
        <div class="col-md-8 col-xl-6 chat">
            <div class="card">
                <div class="card-header msg_head">
                    <div class="d-flex bd-highlight">
                        <div class="img_cont">
                            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img">
                            <span class="online_icon"></span>
                        </div>
                        <div class="user_info">
                            <span id="title">Chat with Khalid</span>
                            <p id="number"></p>
                        </div>
                        <div class="video_cam">
                            <span><i class="fas fa-video"></i></span>
                            <span><i class="fas fa-phone"></i></span>
                        </div>
                    </div>
                    <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
                    <div class="action_menu">
                        <ul>
                            <li><i class="fas fa-user-circle"></i> View profile</li>
                            <li><i class="fas fa-users"></i> Add to close friends</li>
                            <li><i class="fas fa-plus"></i> Add to group</li>
                            <li><i class="fas fa-ban"></i> Block</li>
                        </ul>
                    </div>
                </div>
                <div class="card-body msg_card_body" id="chats">
                 
                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <div class="input-group-append">
                            <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                        </div>
                        <textarea name="" class="form-control type_msg" placeholder="Type your message..."></textarea>
                        <div class="input-group-append">
                            <span class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>