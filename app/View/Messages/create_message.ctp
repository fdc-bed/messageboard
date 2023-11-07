<div class="row">
    <div id="messages_body" class="col-lg-12 col-sm-12">
        <div class="card mt-3">
            <div class="card-header d-flex justify-content-between align-items-center">

                <div class="card-title text-primary m-0">Create New Messages <i class="fa fa-bubble"></i></div>
                <div class="col-md-3 px-0 text-right">
                    <!-- <a href="javascript:;" id="newMessagebtn" class="btn btn-primary disabled">Create New Message</a> -->
                </div>
            </div>
            <div class="card-body p-0">
            <div class="container">
                    <div class="row p-0">
                        <div class="col-md-12 border-left border-gray">
                            <div class="message_content p-2">
                            <form id="messageForm" method="POST" action="">
                            <div class="modal-body">
                                <!-- Input fields for composing the message -->
                                <div class="form-group">
                                    <label for="searchRecipient">Recipient:</label>
                                    <select class="form-control" id="searchRecipient" name="toId[]" multiple="multiple" required>
                                        <?php
                                            foreach ($users as $user) {
                                                $user_img = ($user["User"]["profile_image"] == NULL) ? 'profile-dummy.png' : $user["User"]["profile_image"];
                                                echo '<option value="' . $user["User"]["id"] . '" data-image="' . $user["User"]["profile_image"] . '">' . $user["User"]["name"] . '</option>';
                                            }
                                        ?>
                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="content">Message:</label>
                                    <textarea class="form-control" id="message" rows="4" name="content" placeholder="Enter your message" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Send Message</button>
                            </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
        </div>
    </div>
</div>
