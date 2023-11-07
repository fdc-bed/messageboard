<?php
$notAllowPage = array("thankYou");

/**
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 */

$cakeDescription = __d('cake_dev', 'MessageBoard App');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->css('bootstrap.min.css');
		echo $this->Html->css('jquery.sweet-modal.min.css');
		echo $this->Html->css('fontawesome.min.css');
		echo $this->Html->css('datepicker.css');
		echo $this->Html->css('select2.min.css');
		echo $this->Html->css('custom');
		echo $this->Html->css('media');
		echo $this->Html->script('https://kit.fontawesome.com/4b1fdca523.js');
		echo $this->Html->meta('icon');
		echo $this->Html->css('style');
	?>
</head>
<body>
	<div class="container">  
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<a href="<?php echo Router::url('/'); ?>" class="navbar-brand">Message Board</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
		<?php if(!in_array($this->request->params['action'], $notAllowPage)){ ?>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto align-items-center">
				<?php if(AuthComponent::user()===NULL): ?>
                <li class="nav-item">
					<?php echo $this->Custom->activeLink('Login','Users','login'); ?>
                </li>
                <li class="nav-item"> 
					<?php echo $this->Custom->activeLink('Register','Users','register'); ?>
                </li>
				<?php else: ?>
				<li class="nav-item">
					<?php echo $this->Custom->activeLink('Messages','Messages','index'); ?>
                </li>
				<li class="nav-item d-flex justify-content-center align-items-center mx-2 px-2 border-left border-right border-dark">
					<figure class="nav-img">
					<?php if($current_user['profile_image'] != NULL): ?>
					<img src="<?php echo 'uploads/user_'.$current_user['id'].DS.$current_user['profile_image']; ?>" alt="profile thumb" class="img-thumbnail p-0">
					<?php else: ?>
					<img src="img/profile-dummy.png" alt="Profile Picture" class="img-thumbnail p-0" />
					<?php endif; ?>
					</figure>
					<?php echo $this->Custom->activeLink(AuthComponent::user("name"),'Users','profile'); ?>
                </li>
                <li class="nav-item rounded btn btn-danger p-0">
					<?php //echo $this->Custom->activeLink('Logout','Users','logout'); ?>
					<a href="javascript:;" id="logout_modal" class="nav-link">Logout <i class="fa fa-sign-out"></i></a>
                </li>
				<?php endif; ?>
            </ul>
        </div>
		<?php  } ?>
    </nav>	
	<?php echo $this->fetch('content'); ?>

	<?php echo $this->element('sql_dump'); ?>
	<!-- Footer -->
	<footer class="bg-dark text-white text-center py-2 mt-4">
	<?php echo $this->element('footer_content'); ?>
    </footer>
	</div>
	<?php
		echo $this->Html->script('jquery-3.4.1.min.js');
		echo $this->Html->script('jquery.sweet-modal.min.js');
		echo $this->Html->script('bootstrap.min.js');
		echo $this->Html->script('datepicker.js');
		echo $this->Html->script('select2.min.js');
		echo $this->Html->script('custom.js');
		echo $this->Html->script('mboard.js');
	?>
	<script>
	jQuery(document).ready(function($) {
		$('.alert').alert();

		$('#logout_modal').click(function(){
			var base_url = window.location.origin + "/messageboard/logout";
			$.sweetModal.confirm('Are you sure to logout?', function() {
				window.location.href = base_url;
			});
			
		});
	});
	</script>
	
	<script>
		$(document).ready(function () {
        // Check if the element with id "flashMessage" exists
        if ($('#flashMessage').length) {
            // Display the flash message inside the container
				if ($('.message_sent').length) {
					$.sweetModal({
					content: 'Message sent!',
					icon: $.sweetModal.ICON_SUCCESS
					});
				}
			}
    });
	</script>




</body>
</html>
