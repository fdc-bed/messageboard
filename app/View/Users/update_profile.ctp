<div class="row">
   <div class="col-lg-10 mt-2 mx-auto">
      <div class="row">
         <div class="col-md-3 border-right">
            <?php echo $this->element('profile_nav'); ?>
         </div>
         <div class="col-lg-9 col-sm-12">
            <h1 class="card-title h4">
               Update Profile 
               <div class="fa h5 fa-pen"></div>
            </h1>
            <div class="row text-center">
               <?php if ($this->Session->check('Message.flash')) { ?>
               <div class="error-messages mx-auto ">
                  <div class="alert alert-success text-sm alert-dismissible fade show mb-2" role="alert">
                     <?php echo $this->Session->flash('flash'); ?>
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
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
               <div class="col-md-12">
                  <figure class="figure_img">
                     <?php if($current_user['profile_image'] != NULL): ?>
                     <img src="<?php echo 'uploads/user_'.$current_user['id'].DS.$current_user['profile_image']; ?>" alt="<?php echo $current_user['name'].'-'.'Profile Picture'; ?>" class="img-thumbnail" />
                     <?php else: ?>
                     <img src="img/profile-dummy.png" alt="Profile Picture" class="img-thumbnail" />
                     <?php endif; ?>
                     <span class="label_upload font-weight-bold"><i class="fa fa-upload d-block"></i> Update Profile</span>
                  </figure>
               </div>
               <div class="col-md-6 mx-auto text-left">
                  <form action="" method="POST" enctype="multipart/form-data">
                     <div class="form-group profile_upload">
                        <input type="file" style="display:none" class="form-control-file border p-2" id="imgFile" name="profile_image" value="test" accept=".jpg, .gif, .png, .jpeg">
                     </div>
                     <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" 
                           value="<?php if(!isset($post_data)){ echo $current_user['name']; }else{ echo $post_data['name']; }?>">
                     </div>
                     <div class="form-group">
                        <label for="birthdate">Birthdate</label>
                        <input type="text" class="form-control" id="birthdate" name="birthdate" 
                           value="<?php if(!isset($post_data)){ echo $current_user['birthdate'];}else{ echo $post_data['birthdate']; }?>">
                     </div>
                     <div class="form-group">
                        <?php function getGenderChecked($gender, $i){ return ($gender == $i) ? 'checked' : ''; } ?>
                        <label>Gender</label>
                        <div class="form-inline">
                           <div class="form-check form-group mr-2">
                              <input type="radio" 
                                 <?php if($current_user['gender']!=NULL){
                                    if(!isset($post_data)){
                                        echo getGenderChecked($current_user['gender'],'M'); }
                                    else{ echo getGenderChecked($post_data['gender'],'M');
                                    } } ?> 
                                 class="form-check-input" id="male" name="gender" value="M">
                              <label class="form-check-label" for="male">Male</label>
                           </div>
                           <div class="form-check form-group">
                              <input type="radio" 
                                 <?php if($current_user['gender']!=NULL){
                                    if(!isset($post_data)){ echo getGenderChecked($current_user['gender'],'F'); }
                                    else{ echo getGenderChecked($post_data['gender'],'F'); }} ?> 
                                 class="form-check-input" id="female" name="gender" value="F">
                              <label class="form-check-label" for="female">Female</label>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="hobby">Hobby</label>
                        <textarea type="text" class="form-control" id="hobby" name="hobby" rows="3"><?php if(!isset($post_data)){ echo $current_user['hobby'];}else{ echo $post_data['hobby'];} ?></textarea>
                     </div>
                     <button type="submit" class="btn btn-primary">Update Profile</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>