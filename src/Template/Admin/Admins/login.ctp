<?php $this->assign('title', __('Login')) ?>
<?= $this->Flash->render('auth') ?>

<!-- /.login-logo -->
<div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <?= $this->Form->create('') ?>
    <div class="form-group has-feedback">
        <?= $this->Form->control('email', ['class' => 'form-control', 'placeholder' => 'Email', 'label' => false]) ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <?= $this->Form->control('password', ['type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'label' => false]) ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">
        <div class="col-xs-8">
            <div class="checkbox icheck">
                <label>
                    <input class="form-control" type="checkbox" name="xx"> Remember Me</input>
                </label>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
            <?= $this->Form->button(__('Sign In'), ['class' => 'btn btn-primary btn-block btn-flat']); ?>
        </div>
        <!-- /.col -->
    </div>
    <?= $this->Form->end() ?>
    <?php // $this->Html->link(__('Forgot password?'), ['controller' => 'Admins', 'action' => 'forgotPassword']) ?>

</div>
<br>
<p>
    <a href="<?= SITE_URL ?>">&larr; <?= __('Back to ')?> <?= SITE_TITLE ?></a>
</p>
<!-- /.login-box-body -->



