<?php $this->assign('title', __('Login')); ?>
<style>
    
    /* The container */
    .checkbox-c {
        display: block;
        position: relative;
        padding-left: 35px;
        cursor: pointer;
        font-size: 16px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        font-weight: normal;
    }
    
    /* Hide the browser's default checkbox */
    .checkbox-c input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }
    
    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 20px;
        width: 20px;
        background-color: #eee;
    }
    
    /* On mouse-over, add a grey background color */
    .checkbox-c:hover input ~ .checkmark {
        background-color: #ccc;
    }
    
    /* When the checkbox is checked, add a blue background */
    .checkbox-c input:checked ~ .checkmark {
        background-color: #d9534f;
    }
    
    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }
    
    /* Show the checkmark when checked */
    .checkbox-c input:checked ~ .checkmark:after {
        display: block;
    }
    
    /* Style the checkmark/indicator */
    .checkbox-c .checkmark:after {
        left: 7px;
        top: 2px;
        width: 7px;
        height: 13px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>
<div class="col-md-1"></div>
<div class="col-md-6">
    <div class="banner-text">
        <?= $this->Html->image('forum.png', ['alt' => SITE_TITLE, 'style'=>"position:relative; top:-10px;"]); ?>
        A forum dedicated to political debate <br>
        <br>
        <?= $this->Html->image('hand-shake.png', ['alt' => SITE_TITLE]); ?>
        Connect directly with politicians and other members of the electorate<br>
        <br>
        <?= $this->Html->image('pensil.png', ['alt' => SITE_TITLE]); ?>
        Safe space for open interaction without fear of personal attacks<br>
        <br>
        <?= $this->Html->image('location.png', ['alt' => SITE_TITLE]); ?>
        User data is secure in a private server and will not be shared.
    </div>
</div>
<div class="col-md-5">
    <div class="form-wrapper">
        <h3>Login</h3>
        <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'login'], 'id' => 'loginForm', 'class' => "intro-form"]) ?>
    
        <div class="form-group">
            <div class="col-md-12">
                &nbsp;
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-md-12">
                <?= $this->Form->input('email', ['class' => 'form-control place-me', 'type' => 'text', 'label' => false, 'placeholder' => 'Email']) ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <?= $this->Form->input('password', ['class' => 'form-control place-me', 'label' => false, 'placeholder' => 'Password']) ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label class="checkbox-c" for="rememberMe">
                    
                    <?= $this->Form->input('remember_me', ['class' => 'form-control place-me', 'label' => false, 'type' => 'checkbox', 'value'=>'true', 'id'=>'rememberMe', 'templates' => ['inputContainer' => '{{content}}']]) ?>
                    <span class="checkmark"></span>Remember Me
                </label>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'forgotPassword']); ?>">Forgot password?</a>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <?= $this->Form->button(__('GET VIP ACCESS'), ['id' => 'registerBtn', 'class' => "btn btn-custom btn-login btn-sm"]) ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
<script>
    $(document).ready(function () {
        
        
        $("#loginForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                email: {
                    required: "Please enter email.",
                    email: "Please enter valid email."
                },
                password: {
                    required: "Please enter password."
                }
            }
        });
        
        $(document).on("click", "#register_btn", function () {
            if ($("#register_form").valid() == true) {
                $("#register_form").submit();
            }
            
        });
    });
</script>
