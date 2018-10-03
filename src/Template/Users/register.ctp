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
        <?= $this->Html->image('forum.png', ['alt' => SITE_TITLE]); ?>
        A forum dedicated to political debate <br>
        <br>
        <?= $this->Html->image('hand-shake.png', ['alt' => SITE_TITLE]); ?>
        Connect directly with politicians and other members of the electorate <br>
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
        <!-- h3>Focused Debate and Action drive Results</h3 -->
        <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'add'], 'id' => 'registerForm', 'class' => "intro-form"]) ?>
        <div class="col-sm-12">
            <div class="radio radio-danger">
                <input type="radio" name="role" id="privateCitizen" value="Private Citizen">
                <label for="privateCitizen"> Electorate </label>
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
                <?= $this->Form->input('state', ['class' => 'form-control place-me pl-bold', 'type'=>'select', 'options'=>$usaStates, 'empty'=>'Select State', 'label' => false, 'style'=>'background: #c3d8eb;']) ?>
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
                <label class="checkbox-c" for="iAgree">
                    <input type="checkbox" id="iAgree" name="i_agree" value="true">
                    <span class="checkmark"></span>
                    I agree <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'termsOfService']); ?>" target="_blank">Terms of Service</a>
                    and
                    <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'privacyPolicy']); ?>" target="_blank">Privacy Policy</a>
                </label>
                <label for="i_agree" class="error" style="margin:5px 0 0 36px; display: none;">Please agree terms and conditions and privacy policy.</label>
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
        <?php if(!isset($this->request->query['show'])){ ?>
            setTimeout(function () {
                $('#freeMembership').modal('show');
            }, 1000);
        <?php } ?>
        
        $('#politician').click(function () {
            $('#city, #state').removeClass('pl-bold');
            $("#state").rules("add", {
                required: false
            });
            $("#city").rules("add", {
                required: false
            });
            
            $('#city, #state').next('label').hide();
        });
        
        $('#privateCitizen').click(function () {
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
                },
                i_agree: {
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
                },
                i_agree: {
                    required: "Please agree terms and conditions and privacy policy."
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
