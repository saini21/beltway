<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php $this->assign('title', __('Forgot Password')); ?>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="form-wrapper">
            <h3>Forgot Password</h3>
            <?= $this->Form->create('Users', ['url' => ['controller' => 'Users', 'action' => 'forgotPassword'], 'class' => 'intro-form', 'id' => 'forgotPasswordForm']) ?>
            <div class="form-group">
                <div class="col-md-12 main-instruction">
                    <p>Enter your email address that you used to register. We'll send you an email with a
                        link to reset your password.</p>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-12 login-input-row">
                    <?= $this->Form->input('email', ['class' => 'form-control', 'label' => false, 'value' => "", 'required' => false, 'placeholder'=>'Email']); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    &nbsp;&nbsp;&nbsp;&nbsp;<label for="email" class="error" style="display: none;">Please enter email.</label>
                </div>
            </div>
    
            <div class="form-group">
                <div class="col-md-12" style="text-align: center;">
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']); ?>">Login</a>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-12">
                    <button id="resetPasswordBtn" class="btn btn-custom btn-submit btn-sm" type="submit">GET VIP ACCESS</button>
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
        
        $("#forgotPasswordForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: {
                    required: 'Please enter email.',
                    minlength: 'Please enter valid email.',
                }
            },
            submitHandler: function (form) {
                $.ajax({
                    url: SITE_URL + "/users/forgot-password-api",
                    type: "POST",
                    data: $("#forgotPasswordForm").serialize(),
                    dataType:"json",
                    success: function (response) {
                        if (response.code == 200) {
                            $('.login-input-row').html('<h3>' + response.message + '</h3>');
                            $('#resetPasswordBtn, .main-instruction').remove();
                        } else {
                            $().showFlashMessage("error", response.message);
                            $('#resetPasswordBtn').button('<Reset Password <em></em>');
                        }
                    },
                    complete: function () {
                    }
                });
                
                $('#resetPasswordBtn').button('loading');
                $("#forgotPasswordForm").find(":input").filter(function () {
                    return !this.value;
                }).attr("disabled", "disabled");
                
                return false;
            }
        });
        
        
    });
</script>

