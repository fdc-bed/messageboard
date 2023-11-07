<div class="row">
    <div class="col-lg-10 mt-2 mx-auto">
    <div class="row">
    <div class="col-md-3 border-right">
    <?php echo $this->element('profile_nav'); ?>
    </div>
        <div class="col-lg-9 col-sm-12">
            <div class="row text-center">
            <div class="col-md-12">
                <figure class="figure_img_profile">
                    <?php if($userData['profile_image'] != NULL): ?>
                        <img src="<?php echo 'uploads/user_'.$current_user['id'].DS.$current_user['profile_image']; ?>" alt="<?php echo $current_user['name'].'-'.'Profile Picture'; ?>" class="img-thumbnail">
                    <?php else: ?>
                    <?php echo $this->Html->image('profile-dummy.png', 
                        array('alt' => 'Profile Picture', 'class' => 'img-thumbnail')) ?>
                    <?php endif; ?>
                </figure>
            </div>
            <div class="col-md-12">
                <h1><?php echo $userData['name']; ?>, 
                <?php echo $this->Custom->ageDisplay($userData['birthdate']); ?></h1>
                <p><strong>Gender:</strong> <?php echo $this->Custom->genderDisplay($userData['gender']); ?></p>
                <p><strong>Birthdate:</strong> <?php echo $this->Custom->birthdateFormat($userData['birthdate']); ?></p>
                <p><strong>Joined:</strong> <?php echo $this->Custom->datetimeFormat($userData['created_date']); ?></p>
                <p><strong>Last Login:</strong> <?php echo $this->Custom->datetimeFormat($userData['last_login_datetime']); ?></p>
                <p><strong>Hobby:</strong> <?php echo $this->Custom->hobbyDisplay($userData['hobby']); ?></p>
            </div>
            </div>
        </div>

    </div>
    </div>
</div>