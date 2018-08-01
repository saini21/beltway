<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php $this->assign('title', __('Reset Password')); ?>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="form-wrapper">
            <h3>Reset Password</h3>
            <?= $this->Form->create('Users', ['url' => ['controller' => 'Users', 'action' => 'resetPasswordApi'], 'class' => 'intro-form', 'id' => 'resetPasswordForm']) ?>
            <div class="form-group">
                <div class="col-md-12 main-instruction">
                    <?= $this->Form->input('forgot_password_token', ['type' => 'hidden', 'value' => $forgotPasswordToken, 'required' => false]); ?>
                </div>
            </div>
            <div id="setMessage">
                <div class="form-group">
                    <div class="col-md-12 login-input-row">
                        <?= $this->Form->input('password', ['class' => 'form-control', 'label' => false, 'value' => "", 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'New Password']); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 login-input-row">
                        <?= $this->Form->input('Confirm Password', ['name' => 'verify_password', 'id' => 'verify_password', 'class' => 'form-control', 'label' => false, 'type' => 'password', 'autocomplete' => 'off', 'placeholder' => 'Confirm Password']) ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-12">
                        <button id="resetPasswordBtn" class="btn btn-custom btn-reset-password btn-sm" type="submit">GET VIP ACCESS
                        </button>
                    </div>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<div class="row">
    <div class="col-md-12">
        <div style="width:100%; height:250px;  float: left;"></div>
    </div>
</div>
<script>
    $(function () {
        
        $("#resetPasswordForm").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 8,
                },
                verify_password: {
                    required: true,
                    equalTo: '#password'
                }
            },
            messages: {
                password: {
                    required: 'Please enter password.',
                    minlength: 'Please enter atleast 8 characters.',
                },
                verify_password: {
                    required: 'Please verify your password.',
                    equalTo: 'Password does not match'
                }
            },
            submitHandler: function (form) {
                $.ajax({
                    url: SITE_URL + "/users/reset-password-api",
                    type: "POST",
                    data: $("#resetPasswordForm").serialize(),
                    dataType: "JSON",
                    success: function (response) {
                        if (response.code == 200) {
                            $('#setMessage').html('<h3>' + response.message + ' <a href="<?= SITE_URL ?>/users/login">Login</a></h3> ');
                            $('#resetPasswordBtn').remove();
                        } else {
                            $().showFlashMessage("error", response.message);
                        }
                    },
                    complete: function () {
                    }
                });
            }
        });
    });
</script>

