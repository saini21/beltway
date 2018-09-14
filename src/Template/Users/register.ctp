<?php $this->assign('title', __('Register')); ?>
<style>
    .pl-bold::-webkit-input-placeholder { /* WebKit, Blink, Edge */
        font-weight: bold;
    }
    
    .pl-bold:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
        font-weight: bold;
    }
    
    .pl-bold::-moz-placeholder { /* Mozilla Firefox 19+ */
        font-weight: bold;
    }
    
    .pl-bold:-ms-input-placeholder { /* Internet Explorer 10-11 */
        font-weight: bold;
    }
    
    .pl-bold::-ms-input-placeholder { /* Microsoft Edge */
        font-weight: bold;
    }
    
    .pl-bold::placeholder { /* Most modern browsers support this now. */
        font-weight: bold;
    }

</style>
<div class="col-md-1"></div>
<div class="col-md-6">
    <div class="banner-text">
        <?= $this->Html->image('hand-shake.png', ['alt' => SITE_TITLE]); ?>
        Get involved in targeted and productive political debate <br>
        <br>
        <?= $this->Html->image('pensil.png', ['alt' => SITE_TITLE]); ?>
        Safe space for open interaction without fear of personal attacks<br>
        <br>
        <?= $this->Html->image('location.png', ['alt' => SITE_TITLE]); ?>
        User data is secure in a private server and will not be shared
    </div>
</div>
<div class="col-md-5">
    <div class="form-wrapper">
        <h3>Focused Debate and Action drive Results</h3>
        <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'add'], 'id' => 'registerForm', 'class' => "intro-form"]) ?>
        <div class="col-sm-12">
            <div class="radio radio-danger">
                <input type="radio" name="role" id="privateCitizen" value="Private Citizen">
                <label for="privateCitizen"> Private Citizen </label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
                <input type="radio" name="role" id="politician" value="Politician">
                <label for="politician"> Politician </label>
            </div>
            <label for="role" class="error" style="display: none; margin: 0 auto 10px 65px;">Please select your
                type.</label>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <?= $this->Form->input('first_name', ['class' => 'form-control place-me pl-bold', 'label' => false, 'placeholder' => 'First Name']) ?>
            </div>
            <div class="col-md-6">
                <?= $this->Form->input('last_name', ['class' => 'form-control place-me pl-bold', 'label' => false, 'placeholder' => 'Last Name']) ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <?= $this->Form->input('email', ['class' => 'form-control place-me pl-bold', 'type' => 'text', 'label' => false, 'placeholder' => 'Email']) ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <?= $this->Form->input('state', ['class' => 'form-control place-me pl-bold', 'label' => false, 'placeholder' => 'State']) ?>
            </div>
            <div class="col-md-6">
                <?= $this->Form->input('city', ['class' => 'form-control place-me pl-bold', 'label' => false, 'placeholder' => 'City']) ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <?= $this->Form->input('password', ['class' => 'form-control place-me pl-bold', 'label' => false, 'placeholder' => 'Password']) ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <?= $this->Form->button(__('GET VIP ACCESS'), ['id' => 'registerBtn', 'class' => "btn btn-custom btn-sm"]) ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
<?= $this->element('free_membership') ?>
<script>
    $(document).ready(function () {
        
        setTimeout(function () {
            //$('#freeMembership').modal('show');
        }, 1000);
        
        $('#privateCitizen').click(function () {
            $('#city, #state').removeClass('pl-bold');
            $("#state").rules("add", {
                required: false
            });
            $("#city").rules("add", {
                required: false
            });
    
            $('#city, #state').next('label').hide();
        });
        
        $('#politician').click(function () {
            $('#city, #state').addClass('pl-bold');
            $("#state").rules("add", {
                required: true
            });
            $("#city").rules("add", {
                required: true
            });
        });
        
        
        $("#registerForm").validate({
            rules: {
                role: {
                    required: true
                }, first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                },
                city: {
                    required: true
                },
                state: {
                    required: true
                }
                
            },
            messages: {
                role: {
                    required: "Please select your type."
                },
                first_name: {
                    required: "Please enter first name."
                },
                last_name: {
                    required: "Please enter last name."
                },
                email: {
                    required: "Please enter email.",
                    email: "Please enter valid email."
                },
                password: {
                    required: "Please enter password."
                },
                city: {
                    required: "Please enter city."
                },
                state: {
                    required: "Please enter state."
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
