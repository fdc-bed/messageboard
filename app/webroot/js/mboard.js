$(document).ready(function () {
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



});
