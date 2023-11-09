// SHOW IMAGE BEFORE UPLOAD
var base_url = window.location.origin + "/messageboard/";
$("#imgFile").change(function (e) {
	if (this.files && this.files[0]) {
		var img = document.querySelector('.figure_img img'); 
		img.src = URL.createObjectURL(this.files[0]);
	}
});

$(".figure_img").click(function() {
	// Trigger a click event on the hidden file input
	$("#imgFile").click();
});


$('#birthdate').datepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: "-100:-0", // Allow selecting from the last 100 years to the current year
		dateFormat: "yy-mm-dd" // Date format (adjust as needed)
});

var submitButton = $('.register-btn');

$('#UserPassword, #UserConfirmPassword').on('input', function() {
	var password1 = $('#UserPassword').val();
	var password2 = $('#UserConfirmPassword').val();
	var passwordInput1 = $('#UserPassword');
	var passwordInput2 = $('#UserConfirmPassword');
	var passwordMatchError = $('#password-match-error');

	if (password1 === password2) {
		submitButton.removeAttr('disabled');
		passwordInput1.css('border', '1px solid #ccc');
		passwordInput2.css('border', '1px solid #ccc');
		passwordMatchError.text(''); // Clear the error message
		passwordMatchError.removeClass('alert alert-warning');
	} else {
		submitButton.attr('disabled', 'disabled');
		passwordInput1.css('border', '1px solid #ccc');
		passwordInput2.css('border', '1px solid red');
        passwordMatchError.text('Passwords do not match!');
		passwordMatchError.addClass('alert alert-warning');
	}

});

$('#UserName').on('input', function() {
    var name = $('#UserName').val();
    var nameInput = $('#UserName');
    var submitButton = $('#submit-button');
    var nameError = $('#name-error');
	
    if (name.length >= 5 && name.length <= 20) {
        submitButton.removeAttr('disabled');
        nameInput.css('border', '1px solid #ccc');
        nameError.text(''); // Clear the error message
		nameError.removeClass('alert alert-warning');
    } else {
        submitButton.attr('disabled', 'disabled');
        nameInput.css('border', '1px solid red');
        nameError.text('Name is required and should be 5-20 characters.');
		nameError.addClass('alert alert-warning');

    }
});

	$('#UserEmail').on('input', function() {
		var email = $('#UserEmail').val();
		var emailInput = $('#UserEmail');
	
		if (email.length > 0) {
			emailInput.css('border', '1px solid #ccc'); // Reset to default border color
		} else {
			submitButton.attr('disabled', 'disabled');
			emailInput.css('border', '1px solid red'); // Apply red border for empty input
		}
	});
	

	  function showMoreMsg($this, msg, key) {
		var parentTxt = $($this).closest('.message-area').find('p');
		var hideFunc = hideMsg(this, `${msg}`);
		var newMsgHtml = msg + `<span id="delete-msg" data-msgid="${key}"><i class="fa fa-trash"></i></span>` + `<a class="text-decoration-underline" onclick="hideMsg(this, \`${msg}\`)">(see less)</a>`;

		parentTxt.html(newMsgHtml)
	  }

	  function hideMsg($this, msg, key) {
		var parentTxt = $($this).closest('.message-area').find('p');
		var newMsgHtml = msg.substring(0, 50) + `...<a class="text-decoration-underline" onclick="showMoreMsg(this, \`${msg}\`)">(see more)</a>`+ `<span id="delete-msg" data-msgid="${key}"><i class="fa fa-trash"></i></span>`;
		
		parentTxt.html(newMsgHtml)
	  }

	  $('#checkUpdatePass').change(function () {
		if (this.checked || $(this).prop('checked')) {
			$('#UserPasswordUpdate').removeAttr('disabled');
			$('#UserConfirmPasswordUpdate').removeAttr('disabled');
		} else {
			$('#UserPasswordUpdate, #UserConfirmPasswordUpdate').attr('disabled', 'disabled');
		}
	});
	