var loadPage = 1;
var loadingData = false;
var loadMessageManually = true;
var sendMessageManually = false;

var socket = io('http' + '://' + HOST_IP + ':' + SOCKET_PORT);

socket.io.on('connect_error', function (err) {
    // handle server error here
    loadMessageManually = false;
    sendMessageManually = true;
    var mainDiv = document.getElementById("chatWindow");
    if ((mainDiv.scrollTop + mainDiv.clientHeight) == mainDiv.scrollHeight && !loadingData) {
        loadPage = 1;
        getMessage();
    }
});

socket.emit('join_room', {room: TOKEN, auth_token: userToken});

socket.on('new_message', function (resp) {

    var message = {
        user_id: resp.user_id,
        message: resp.message,
        profile_image: chat.chat_members[resp.user_id].profile_image,
        name: chat.chat_members[resp.user_id].name,
    }
    prepareMesage(message, true, 'append');
});

function prepareMesage(message, scroll, type) {
    scroll = (typeof  scroll === "undefined") ? true : scroll;
    type = (typeof  scroll === "undefined") ? 'append' : type;

    if (message.user_id == mainId) {
        $.template("messageTemplate", $('#mineMessage').html());
    } else {
        $.template("messageTemplate", $('#theirMessage').html());
    }
    if (type == 'append') {
        $.tmpl("messageTemplate", [message]).appendTo("#chatWindow");
        if (scroll) {
            $('#chatWindow').animate({scrollTop: document.getElementById("chatWindow").scrollHeight}, 1000);
        }
    } else {
        $.tmpl("messageTemplate", [message]).prependTo("#chatWindow");

    }

}

function getMessage() {
    loadingData = true;
    scroll = typeof  scroll == "undefined" ? true : scroll;

    $.ajax({
        url: SITE_URL + "/chats/messages/" + TOKEN + "/?page=" + loadPage,
        type: "POST",
        dataType: "json",
        success: function (response) {
            if (response.code == 200 && response.data.messages.length > 0) {
                var messages = [];
                if (loadPage == 1) {
                    $("#chatWindow").html('');
                }
                $.each(response.data.messages, function (index, message) {
                    var msg = {
                        user_id: message.user_id,
                        message: message.message,
                        profile_image: chat.chat_members[message.user_id].profile_image,
                        name: chat.chat_members[message.user_id].name,
                    }

                    prepareMesage(msg, false, 'prepend');
                });

                if (loadPage == 1) {
                    $('#chatWindow').animate({scrollTop: document.getElementById("chatWindow").scrollHeight}, 1000);
                }
                loadingData = false;
                loadPage = loadPage + 1;
            } else {
                if (loadPage > 1) {
                    $("#chatWindow").prepend('<h4 class="no-more-message">No more message found</h4>');
                }
            }
        }
    });
}

function getFormData(form) {
    var unIndexedArray = form.serializeArray();
    var indexedArray = {};

    $.map(unIndexedArray, function (n, i) {
        indexedArray[n['name']] = n['value'];
    });
    indexedArray.auth_token = userToken;
    indexedArray.room = TOKEN;
    indexedArray.main_id = mainId;
    return indexedArray;
}

function sendMessage(data){
    $.ajax({
        url: SITE_URL + "/chats/newMessage",
        type: "POST",
        dataType: "json",
        data:data,
        success: function (response) {

            var resp = response.data.message;

            var message = {
                user_id: resp.user_id,
                message: resp.message,
                profile_image: chat.chat_members[resp.user_id].profile_image,
                name: chat.chat_members[resp.user_id].name,
            }

            console.log(message);

            prepareMesage(message, true, 'append');

        }
    });
}

$(function () {
    setTimeout(function () {
        if (loadMessageManually) {
            getMessage();
        }
    }, 1000);

    $('#sendMessageForm').validate({
        rules: {
            message: {
                required: true
            }
        },
        messages: {
            message: {
                required: ""
            }
        },
        submitHandler: function (form) {
            var formData = getFormData($(form));
            if(sendMessageManually){
               sendMessage(formData);
            } else {
                socket.emit('post_message', formData);
            }
            $('#messageArea').val('');
        }
    });

    $("#chatWindow").scroll(function () {
        if (document.getElementById("chatWindow").scrollTop <= 2) {
            if (!loadingData) {
               getMessage();
            }
        }
    });

});
