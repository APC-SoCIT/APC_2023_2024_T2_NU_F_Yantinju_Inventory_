$(document).ready(function(){
    $("#send-btn").on("click", function(){
        $value = $("#data").val();
        $msg = '<li class="chat outgoing"><p>'+ $value +'</p></li>';
        $(".chatbox").append($msg);
        $("#data").val('');
        
        // start ajax code
        $.ajax({
            url: 'message.php',
            type: 'POST',
            data: 'text='+$value,
            success: function(result){
                $replay = '<li class="chat incoming"><span class="material-symbols-outlined">smart_toy</span><p>'+ result +'</p></li>';
                $(".chatbox").append($replay);
                // when chat goes down the scroll bar automatically comes to the bottom
                $(".chatbox").scrollTop($(".chatbox")[0].scrollHeight);
            }
        });
    });
});

const chatbotToggler = document.querySelector(".chatbot-toggler");
const closeBtn = document.querySelector(".close-btn");

const toggleChatbot = () => {
    document.body.classList.toggle("show-chatbot");
};

chatbotToggler.addEventListener("click", toggleChatbot);
closeBtn.addEventListener("click", () => document.body.classList.remove("show-chatbot"));