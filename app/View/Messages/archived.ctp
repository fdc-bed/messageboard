<?php foreach($messages as $msg): ?>
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
                                <hr>
                            <?php endforeach; ?>