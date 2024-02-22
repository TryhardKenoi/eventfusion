$(document).ready(() => {
  const chat = $('.chat-list');
  let msgList = [];

  function fetchChat() {
    $.ajax({
      url: "/chat?evid="+window.location.href.split("/")[4],
      type: "GET",
      success: function(data) {
        const parse = JSON.parse(data);
        parse.messages.forEach((msg) => {
          if (msgList.some(e => e.id === msg.id)) {
              
          }else {
            msgList.push(msg); 
            if(userId == msg.user_id) {
              chat.append("<li class='my-4 d-flex'><div class='ml-auto d-block text-break'><strong>"+msg.first_name+" "+msg.last_name+":</strong> "+msg.message+"</div></li>");
            }else {                
              chat.append("<li class='my-4 d-flex'><div class='mr-auto d-block text-break'><strong>"+msg.first_name+" "+msg.last_name+":</strong> "+msg.message+"</div></li>");
            }
          }
        })
      }
    });
  }
  setInterval(fetchChat,2000);

  $('#chatSendForm').submit((e) => {
    e.preventDefault();

    const message = $('#chatMessage').val();
    const ch = $('#chid').val();



    if(message) {
      $.ajax({
        url: "http://localhost/chat",
        type: "POST",
        data: {message,uid:userId,chid:ch},
        success: function(data) {
          $('#chatMessage').val("");
        }
      });
    }
  });
});