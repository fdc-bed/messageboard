<?php
  $lastIdMsg = null;
  ?>
<div class="row">
  <div id="messages_body" class="col-lg-12 col-sm-12">
    <div class="card mt-3">
      <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-title text-primary m-0"><?= $recipient['name']; ?></div>
        <div class="col-md-3 px-0 text-right">
          <!-- <a href="javascript:;" id="newMessagebtn" class="btn btn-primary disabled">Create New Message</a> -->
        </div>
      </div>
      <div class="card-body p-0">
        <div class="container">
          <div class="row p-0">
            <div class="col-md-12 border-left border-gray">
              <div class="message_content p-2">
                <div class="row px-4" id="message-content" data-recipient="<?php echo $recipient["id"];?>">
                  <?php $counter = 0; ?>
                  <?php foreach($messages as $message): ?>
                  <?php
                    $btnShowMore = "";
                    if(strlen($message['msg']['content']) >= 50){
                        $btnShowMore = '<span id="delete-msg" data-msgid="'.$message['msg']["id"].'"><i class="fa fa-trash"></i></span><a class="text-decoration-underline" onClick="showMoreMsg(this, `'.htmlspecialchars($message['msg']['content']).'`,'.$message['msg']["id"].')">(see more)</a>';
                    }else{
                        $btnShowMore = '<span id="delete-msg" data-msgid="'.$message['msg']["id"].'"><i class="fa fa-trash"></i></span>';
                    }
                    ?>
                  <?php if(count($messages) > 11){
                    if($counter > 0 && $counter < 11){
                    
                                      $msg = $message['msg'];
                    
                                      if($msg['from_id'] == $recipient['id']){
                                          echo '
                                          <div class="message-area from-msg" id="'.$msg["id"].'">
                                              <figure>
                                              <img src="'.Router::url('/').DS.'uploads/user_'.$msg['from_id'].DS.$recipient['profile_image'].'" alt="profile image"">
                                              </figure>
                                              <p>'.mb_strimwidth($msg['content'], 0, 50, "...".$btnShowMore).'</p>
                      <span class="message_time">'.$this->Custom->datetimeFormatMessage($msg['created_date']).'</span>
                                          </div>
                                      ';
                                      }else{
                                          echo '
                                          <div class="message-area to-msg" id="'.$msg["id"].'">
                                              <figure>
                                              <img src="'.Router::url('/').DS.'uploads/user_'.$current_user['id'].DS.$current_user['profile_image'].'" alt="profile image"">
                                              </figure>
                                              <p>'.mb_strimwidth($msg['content'], 0, 50, "...".$btnShowMore).'</p>
                                              <span class="message_time">'.$this->Custom->datetimeFormatMessage($msg['created_date']).'</span>
                                          </div>
                                      ';
                                      }
                                   }
                                  } else{
                                      $msg = $message["msg"];
                                      if ($msg["from_id"] == $recipient["id"]) {
                                          echo '
                                              <div class="message-area from-msg" id="'.$msg["id"].'">
                                              <figure>
                                              <img src="'.Router::url('/').DS.'uploads/user_'.$msg['from_id'].DS.$recipient['profile_image'].'" alt="profile image"">
                                              </figure>
                                                  <p>'.mb_strimwidth($msg['content'], 0, 50, "...").$btnShowMore.'</p>
                          <span class="message_time">'.$this->Custom->datetimeFormatMessage($msg['created_date']).'</span>
                                              </div>
                                          ';
                                      } else {
                                          echo '
                                              <div class="message-area to-msg" id="'.$msg["id"].'">
                                                  <figure>
                                                  <img src="'.Router::url('/').DS.'uploads/user_'.$current_user['id'].DS.$current_user['profile_image'].'" alt="profile image"">
                                                  </figure>
                                                  <p>'.mb_strimwidth($msg['content'], 0, 50, "...").$btnShowMore.'</p>
                                                  <span class="message_time">'.$this->Custom->datetimeFormatMessage($msg['created_date']).'</span>
                                              </div>
                                          ';
                                      }
                                  }
                                
                                  if ($counter == 1) {
                                      $lastIdMsg = $msg["id"];
                                  }
                    $counter = $counter + 1;
                              ?>
                  <?php endforeach; ?>
                  <?php
                    if (count($messages) > 10) {
                        echo '<button class="btn btn-info mx-auto" id="see-older-msg" data-msgid="'.$lastIdMsg.'">See older message</button>';
                    }?>
                </div>
                <form id="replyMessage" method="POST" action="javascript:;">
                  <div class="py-3">
                    <!-- Reply Message Form Area -->
                    <div class="form-group">
                      <textarea class="form-control" id="message" rows="4" name="content" placeholder="Enter your message" required></textarea>
                      <input type="hidden" name="toID" id="toID" multiple value="<?php echo $recipient['id']; ?>">
                      <input type="hidden" name="message_key" id="message_key"  value="<?php echo $recipient['message_key'];?>">
                      <div class="py-0 border-0 text-right">
                        <button type="submit" class="btn btn-primary">Reply Message</button>
                      </div>
                    </div>
                    <!-- Reply Message Form Area -->
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