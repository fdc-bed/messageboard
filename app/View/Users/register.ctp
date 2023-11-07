<div class="row">
<div class="col-lg-12 col-sm-12">
    <div class="card mt-3">
        <div class="card-body">
        <h5 class="card-title text-primary">Registration </h5>
        <?php //echo $this->Session->flash(); ?>
        <?php if (!empty($validationErrors)): ?>
            <div class="error-messages">
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
        <?php
            echo $this->Form->create('User', array('url' => array('controller' => 'Users', 'action' => 'register')), array('class' => 'form-horizontal'));
            echo $this->Form->input('name', array('label' => 'Name', 'class' => 'form-control', 'error'=> false, 'placeholder'=>'Name'));
            echo $this->Form->input('email', array('label' => 'Email', 'class' => 'form-control', 'error'=> false, 'placeholder'=> 'Email Address'));
            echo $this->Form->input('password', array('label' => 'Password', 'class' => 'form-control', 'placeholder'=> 'Password','error'=> false,));
            echo $this->Form->input('confirm_password', array('label' => 'Confirm Password', 'class' => 'form-control', 'type'=>'password', 'placeholder'=>'Confirm Password','error'=> false,));
            echo $this->Form->input('Submit', array('class' => 'btn btn-success', 'type'=>'submit', 'label'=>false));
            echo $this->Form->end();
        ?>
        </div>
    </div>
</div>
</div>