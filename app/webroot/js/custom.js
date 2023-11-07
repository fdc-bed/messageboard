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


