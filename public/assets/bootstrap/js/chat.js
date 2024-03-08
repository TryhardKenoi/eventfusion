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
                  return;
              }
              msgList.push(msg); 
              const messageTime = new Date(msg.time);
              const formattedTime = messageTime.toLocaleString([], { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' });
              const messageItem = "<li class='my-4 d-flex flex-column align-items-" + (userId == msg.user_id ? 'end' : 'start') + "'><span class='text-muted'>" + formattedTime + "</span><div><strong>" + msg.first_name + " " + msg.last_name + ":</strong> " + msg.message + "</div></li>";
              chat.append(messageItem);
              
              // Posunout scrollování na maximální hodnotu
              var chatContainer = $(".chat");
              chatContainer.scrollTop(chatContainer[0].scrollHeight);
          });
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