<div class="row">
    <div id="messages_body" class="col-lg-12 col-sm-12">
        <div class="card mt-3">
            <div class="card-header d-flex justify-content-between align-items-center">

                <div class="card-title text-primary m-0">Messages <i class="fa fa-bubble"></i></div>
                <div class="col-md-3 px-0 text-right">
                    <!-- <a href="javascript:;" id="newMessagebtn" class="btn btn-primary">Create New Message</a> -->
                    <a href="create-new-message" class="btn btn-primary">Create New Message</a>
                </div>
            </div>
            <div class="card-body p-0">
            <div class="container">
                    <div class="row p-0">
                        <div class="col-md-12">
                            <div class="message_content p-2">
                            
                            </div>
                        </div>
                    </div>
                </div>
                </div>
        </div>
    </div>
</div>
<?php echo $this->Session->flash(); ?>
<!-- <div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Compose Message</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="messageForm" method="POST" action="">
            <div class="modal-body">
 
                <div class="form-group">
                    <label for="recipient">Recipient:</label>
                    <select class="form-control" id="searchRecipient" name="toId[]" multiple="multiple" required>
                        <?php
                            // foreach ($getUsers as $user) {
                            //     $user_img = ($user["User"]["profile_image"] == NULL) ? 'profile-dummy.png' : $user["User"]["profile_image"];
                            //     echo '<option value="' . $user["User"]["id"] . '" data-image="' . $user["User"]["profile_image"] . '">' . $user["User"]["name"] . '</option>';
                            // }
                        ?>
                        
                    </select>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea class="form-control" id="message" rows="4" name="content" placeholder="Enter your message" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </div>
            </form>
        </div>
    </div>
</div> -->

