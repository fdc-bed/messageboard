<!-- <?php echo debug($messages); ?> -->
<div class="row">
    <div id="messages_body" class="col-lg-12 col-sm-12">
        <div class="card mt-3">
            <div class="card-header d-flex justify-content-between align-items-center">

                <div class="card-title text-primary m-0">Messages <i class="fa fa-bubble"></i></div>
                <div class="col-md-3 px-0 text-right">
                    <a href="create-new-message" class="btn btn-primary">Create New Message</a>
                </div>
            </div>
            <div class="card-body p-0">
            <div class="container">
                    <div class="row p-0">
                        <div class="col-md-12">
                            <div class="message_content p-2">
                        
                            <div id="message-list">
                                <?php foreach ($messages as $msg): ?>
                                    <div class="row" id="<?php echo $msg['messages']['message_key']; ?>">
                                        <div class="col-md-3 d-flex justify-content-start align-items-center">
                                            <figure class="m-0">
                                                <?php if($msg['users']['profile_image']!=NULL){ ?>
                                                <img style="width:40px" src="uploads/user_<?php echo $msg['users']['id'].DS.$msg['users']['profile_image'];?>" alt="Profile Image">
                                                <?php }else{ ?>
                                                <img style="width:40px" src="img/profile-dummy.png" alt="Profile Image">
                                                <?php } ?>
                                            </figure>
                                            <div class="user_name pl-3 font-weight-bold">
                                            <?= $msg['users']['name']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        <p class="ellipsis mb-0"><?= $msg['messages']['content'] ;?><?php if($msg['messages']['to_id']==$msg['users']['id']): echo '(You)'; endif; ?></p>
                                        <span class="message_time font-italic"><?= $this->Custom->datetimeFormatMessage($msg['messages']['created_date']); ?></span>
                                    </div>
                                    <div class="col-md-3 d-flex justify-content-end align-items-center">
                                        <a href="messages/view/<?php echo $msg['users']['id']; ?>/<?php echo $msg['messages']['message_key']; ?>" class="btn btn-sm btn-success"><i class="fa fa-envelope"> View Message</i></a>
                                        <a href="javascript:;" class="btn btn-sm btn-danger ml-2" id="delete-msg-convo" data-message_key="<?php echo $msg['messages']['message_key']; ?>"><i class="fa fa-trash"></i></a>
                                    </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <button id="show-more">Show More</button>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
        </div>
    </div>
</div>
<?php echo $this->Session->flash(); ?>