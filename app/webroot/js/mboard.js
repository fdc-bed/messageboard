$(document).ready(function () {
    // MESSAGE VIEW SCROLL DOWN AUTOMATICALLY
    $('#message-content').animate({scrollTop: $('#message-content').prop("scrollHeight")}, 200);

    // BASE URL
    var base_url = window.location.origin+"/messageboard/";

    var $myModal = $('#myModal');
    $('#newMessagebtn').click(function(){
        $myModal.modal('show');
    });

    $('#searchRecipient').select2({
        placeholder: "Search recipient...",
        templateResult: formatUser
    });

    function formatUser(user) {
        if (!user.id) {
            return user.text;
        }
        var userImage = user.element.getAttribute('data-image');

        // Create an image element
        var $img = $('<img class="user-image" />');
    
        // Check if the userImage is not null or an empty string
        if (userImage && userImage.trim() !== '') {
            // The userImage is valid, so use it
            $img.attr('src', `${base_url}uploads/user_${user.id}/${userImage}`);
        } else {
            // The userImage is invalid or empty, use a fallback image
            $img.attr('src', `${base_url}img/profile-dummy.png`);
        }
        var $user = $(
            `<span><img style="width:30px" src="${$img.attr('src')}" class="user-image" />${user.text}</span>`
        );
        return $user;
    }

    // REPLY MESSAGE AJAX
    $('#replyMessage').on('submit', function (event) {
        var recipientVAL = document.getElementById('toID').value;
        var contentVal = document.getElementById('message').value;
        var messageKeyVal = document.getElementById('message_key').value;

        
        $.ajax({
            url: base_url+"reply-message",
            method: "POST",
            data: {to_id: recipientVAL, content: contentVal, message_key: messageKeyVal },
            dataType: "text",
            success: function (data) {
                var rawData = data;
                if (rawData != '') {
                    $('#message-content').append(rawData);
                    $("#message").val("");
                    $('#message-content').animate({scrollTop: $('#message-content').prop("scrollHeight")}, 200);

                }else{
                    $("#see-older-msg").remove();
                }
            },
            error: function () {
                alert('AJAX request failed');
            }
        })
        event.preventDefault(); // Prevent the default form submission 

    });

    // SEE MORE MESSAGE
    $(document).ready(function(){
        $(document).on('click', '#show-more', function(){
            var lastMsg = $(this).data("msg");
            var recipient = document.getElementById("searchMessage").value;

            $("#show-more").html("Loading...");
            $.ajax({
                url: base_url+"get-messages",
                method: "POST",
                data: {lastMsgId: lastMsg, recipientName: recipient},
                dataType: "text",
                success: function(data){
                    var resData = data;
                    if (resData != '') {
                        $('#show-more').remove();
                        $('.messages-con').append(resData);
                    } else {
                        $("#show-more").html("No message available");
                    }
                }
            });
        });

    });


    // SEE OLDER MESSAGES DETAILS
    $(document).ready(function(){
        $(document).on('click', '#see-older-msg', function(e){
            var recipientId = $('#message-content').data("recipient");
            var lastMsgId = $("#see-older-msg").data("msgid");

            $(this).html("Loading...");
            $.ajax({
                url: base_url+"get-message-paginate",
                method: "POST",
                data: {recipient: recipientId, lastMsgId: lastMsgId},
                dataType: "text",
                success: function(data){
                    var resData = data;
                    if (resData != '') {
                        $("#see-older-msg").remove();
                        $('#message-content').prepend(resData);
                    } else {
                        $("#see-older-msg").remove();
                    }
                }
            });
            e.preventDefault();
        });
    });

    // DELETE SINGLE MESSAGE
    $(document).ready(function(){
        $(document).on('click', '#delete-msg', function(e){
            var msgToDelete = $(this).data("msgid");
            // console.log(msgToDelete);
            $.ajax({
                url: base_url+"delete-message",
                method: "POST",
                data: {msgid: msgToDelete},
                dataType: "text",
                success: function(data){
                    if(data == "Success"){
                        $("#"+msgToDelete).fadeOut(300, function() {
                            $("#"+msgToDelete).remove();
                        });
                    } else {
                        alert("Error Occured!");
                    }
                }
            });
            e.preventDefault();
        });
    });

});


    // DELETE ALL MESSAGE - CONVO
    $(document).ready(function(){
        $(document).on('click', '#delete-msg-convo', function(e){
            var mk_id = $(this).data("message_key");
            $.sweetModal.confirm('Are sure you want to delete?!', function() {
               
            $.ajax({
                url: base_url+"delete-messages",
                method: "POST",
                data: {message_key: mk_id},
                dataType: "text",
                success: function(data){
                    if(data == "Success"){
                        $.sweetModal({
                            content: 'Deleted successfully!.',
                            icon: $.sweetModal.ICON_SUCCESS
                        });

                        $("#"+mk_id).fadeOut(300, function() {
                            $("#"+mk_id).remove();
                        });
                    }
                }
            });
            e.preventDefault();
        });

        });

        $(document).ready(function () {
            var page = 2; // Initial page (e.g., page 2, since you have the first page already)
            var loading = false; // Track whether a request is in progress
        
            $('#show-more').click(function () {
                if (loading) return; // Prevent multiple requests
        
                loading = true;
                $('#show-more').text('Loading...');
        
                $.ajax({
                    url: base_url+'get-more-messages/' + page, // Adjust the URL to match your CakePHP action
                    method: 'GET',
                    dataType: 'html',
                    success: function (data) {
                        $('#message-list').append(data);
                        loading = false;
                        $('#show-more').text('Show More');
                        page++;
                    }
                });
            });
        });
          
});