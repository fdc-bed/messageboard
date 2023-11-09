<div class="row">
    <div class="col-lg-10 mt-2 mx-auto">
    <div class="row">
    <div class="col-md-3 border-right">
    <?php echo $this->element('profile_nav'); ?>
    </div>

        <div class="col-lg-9 col-sm-12">
            <div class="row text-left">
                <div class="col-md-12">
                    <h1 class="card-title h4">Account Settings <i class="fa fa-gear h4"></i></h1>
                    <p>Update your account settings here. You can change your email address and update your password. To confirm the new password, please enter it twice in the fields below.</p>
                    <!-- VALIDATTION -->
                    <?php if ($this->Session->check('Message.flash')) { ?>
                    <div class="error-messages mx-auto ">
                        <div class="alert alert-success text-sm alert-dismissible fade show mb-2" role="alert">
                            <?php echo $this->Session->flash('flash'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <   span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <?php } ?> 
            
                    <?php if (!empty($validationErrors)): ?>
                    <div class="error-messages mx-auto ">
                    <?php foreach ($validationErrors as $field => $errors): ?>
                            <?php foreach ($errors as $error): ?>
                                <div class="alert alert-danger text-sm alert-dismissible fade show mb-2" role="alert">
                                    <?= $error ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                            <?php endforeach; ?>
                    <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <!-- END VALIDATION -->

                    <!-- ACCOUNT SETTING FORM -->
                    <form action="" method="post">
                    <div class="form-group">
                    <label for="UserEmail">Email:</label>
                    <input type="email" class="form-control" id="UserEmail" name="email" 
                    value="<?php if(!isset($postData['email'])){ echo $userData['email']; }else{ echo $postData['email']; }?>" placeholder="Enter your email" required>
                    </div>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-white border-0">
                        <input type="checkbox" id="checkUpdatePass" <?php if(isset($postData['checktoupdate'])){ echo 'checked'; }?> name="checktoupdate" aria-label="Check if you want to update your password?">
                        </div>
                    </div>
                    Check if you want to update your password?
                    </div>
                    <div class="form-group">
                    <label for="UserPassword">Password:</label>
                    <input type="password" class="form-control" disabled id="UserPasswordUpdate" value="************" name="password" placeholder="Enter your password" required>
                    </div>

                    <div class="form-group">
                    <label for="UserConfirmPassword">Confirm Password:</label>
                    <input type="password"  disabled class="form-control" id="UserConfirmPasswordUpdate" value="************" name="confirm_password" placeholder="Confirm your password" required>
                    </div>
                    <button type="submit" class="btn btn-success">Update Account</button>
                    </form>
                    <!-- ENDACCOUNT SETTING FORM -->Q
                </div>
            </div>
        </div>

    </div>
    </div>
</div>