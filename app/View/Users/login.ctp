<div class="row">
<div class="col-lg-12 col-sm-12">
    <div class="card mt-3">
        <div class="card-body">
        <h5 class="card-title text-primary">Login <i class="fa fa-login"></i></h5>
            <?php if($this->Session->check('Message.flash')): ?>
            <div class="error-messages">
                <div class="alert alert-danger text-sm alert-dismissible fade show mb-2" role="alert">
                <?php echo $this->Session->flash(); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
            </div>
        <?php endif; ?>
        <?php
            echo $this->Form->create('User', array('url' => array('controller' => 'Users', 'action' => 'login')), array('class' => 'form-horizontal'));
            echo $this->Form->input('email', array('label' => 'Email', 'class' => 'form-control', 'error'=> false, 'placeholder'=> 'Email Address'));
            echo $this->Form->input('password', array('label' => 'Password', 'class' => 'form-control', 'placeholder'=> 'Password','error'=> false,));
            echo $this->Form->input('Login', array('class' => 'btn btn-success mt-2', 'type'=>'submit', 'label'=>false));
            echo $this->Form->end();
        ?>
        </div>
    </div>
</div>
</div>