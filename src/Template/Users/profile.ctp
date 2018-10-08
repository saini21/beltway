<h1><?= $authUser['first_name']; ?> <?= $authUser['last_name']; ?></h1>
<br/>

<form class="img-form" id="uploadProfileForm"
      action="<?= $this->Url->build(['controller' => 'Users', 'action' => 'changeProfileImage']); ?>"
      enctype="multipart/form-data">
    <div class="form-group">
        <div class="row">
            <div class="col-lg-1">
                <?= $this->Html->image(
                    '/files/Users/profile_image/thumbnail-' . $authUser['profile_image'], ['width' => 80, 'height' => 80, 'class' => 'user-menu-img', 'title' => $authUser['first_name']]); ?>
            </div>
            <div class="col-lg-5">
                <input type="file" class="custom-file-upload form-control" style="width: 200px; margin: 15px 0 0 0;"
                       name="profile_image">
                <input type="submit" style="margin:12px 0 0 0px; float: right;" class="upload"
                       value="Update Profile Image">
            </div>
            <div class="col-lg-6" style="text-align: right"></div>
        </div>
    </div>
</form>


<br/>
<?= $this->Form->create($user, ['url' => ['controller' => 'Users', 'action' => 'editProfile'], 'id' => 'editProfileForm', 'class' => ""]) ?>
<div class="form-group">
    <div class="col-md-6">
        <?= $this->Form->input('first_name', ['class' => 'form-control place-me', 'placeholder' => 'First Name']) ?>
    </div>
    <div class="col-md-6">
        <?= $this->Form->input('last_name', ['class' => 'form-control place-me', 'placeholder' => 'Last Name']) ?>
    </div>
</div>
<div class="form-group">
    <div class="col-md-12">
        <?= $this->Form->input('email', ['class' => 'form-control place-me', 'type' => 'text', 'placeholder' => 'Email']) ?>
    </div>
</div>
<div class="form-group">
    <div class="col-md-6">
        <?= $this->Form->input('state', ['class' => 'form-control place-me pl-bold', 'type'=>'select', 'options'=>$usaStates, 'empty'=>'Select State']) ?>
    </div>
    <div class="col-md-6">
        <?= $this->Form->input('city', ['class' => 'form-control place-me', 'placeholder' => 'City']) ?>
    </div>
</div>
<div class="form-group">
    <div class="col-md-12">
        <?= $this->Form->input('password', ['class' => 'form-control place-me', 'placeholder' => 'Password']) ?>
    </div>
</div>
<div class="form-group">
    <div class="col-md-12">
        <?= $this->Form->button(__('UPDATE'), ['id' => 'registerBtn', 'class' => "btn btn-success btn-lg"]) ?>
    </div>
</div>
<?= $this->Form->end() ?>
</div>

<?php if ($authUser['role'] == "Private Citizen") { ?>
    <div id="stepTwo" class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="pc">
                <h4>Electorate - <?= (empty($authUser['user_type'])) ? "Not a Member" : $authUser['user_type'] ?></h4>
                <div class="form-part-one pulbox">
                    <div class="row">
                        <div class="col-lg-11 "></div>
                        <div class="col-lg-1 right-align">
                            <!-- a class="btn btn-danger right-align" style="margin: -50px 0 0 0;"
                           href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'dashboard']); ?>">
                            <i class="fa fa-times"></i>
                        </a -->
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="radio radio-danger vikas">
                            <p><span class="icon-a"><i class="fa fa-caret-right" aria-hidden="true"></i></span> Comment
                                <br>
                                <span class="icon-a"><i class="fa fa-caret-right" aria-hidden="true"></i></span> upload
                                articles and other content <br>
                                <span class="icon-a"><i class="fa fa-caret-right" aria-hidden="true"></i></span>
                                Interact with politicians<br/>
                                <span class="icon-a"><i class="fa fa-caret-right" aria-hidden="true"></i></span>
                                                                $0.99/month<br>
                                </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php /* if($authUser['role'] == "Private Citizen") { ?>
<div id="stepTwo" class="row" >
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="pc">
            <h4>Electorate - <?= (empty($authUser['user_type'])) ? "Not a Member" : $authUser['user_type'] ?></h4>
            <div class="form-part-one pulbox">
                <div class="row">
                    <div class="col-lg-11 "></div>
                    <div class="col-lg-1 right-align">
                        <!-- a class="btn btn-danger right-align" style="margin: -50px 0 0 0;"
                           href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'dashboard']); ?>">
                            <i class="fa fa-times"></i>
                        </a -->
                    </div>
                </div>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="on0" value="Member Status">
                    <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
                    <input type="hidden" name="return" id="returnUrl"
                           value="<?= SITE_URL ?>/users/private-citizen-api/<?= $authUser['id']; ?>/Citizen">
                    <div class="form-group">
                        <h5> Member Status </h5>
                    </div>
                    <div class="form-group">
                        <div class="radio radio-danger vikas">
                            <input type="radio" class="user_type" name="os0" id="radio20" value="Citizen"
                                   <?php if($authUser['user_type'] == "Citizen") { ?>checked="checked" <?php } ?>>
                            <label for="radio20" class="new-label"> Citizen</label>
                            <p><span class="icon-a"><i class="fa fa-caret-right" aria-hidden="true"></i></span> Comment
                                <br>
                                <span class="icon-a"><i class="fa fa-caret-right" aria-hidden="true"></i></span> upload
                                articles and other content <br>
                                <span class="icon-a"><i class="fa fa-caret-right" aria-hidden="true"></i></span> answer
                                poll questions<br>
                                <span class="icon-a"><i class="fa fa-caret-right" aria-hidden="true"></i></span>
                                $0.99/month</p>
                            <br>
                            <input type="radio" class="user_type" name="os0" id="radio21" value="Activist" <?php if($authUser['user_type'] == "Activist") { ?>checked="checked" <?php } ?>>
                            <label for="radio21" class="new-label"> Activist</label>
                            <p><span class="icon-a"><i class="fa fa-caret-right" aria-hidden="true"></i></span> Comment
                                <br>
                                <span class="icon-a"><i class="fa fa-caret-right" aria-hidden="true"></i></span> upload
                                articles and other content <br>
                                <span class="icon-a"><i class="fa fa-caret-right" aria-hidden="true"></i></span> answer
                                poll questions<br>
                                <span class="icon-a"><i class="fa fa-caret-right" aria-hidden="true"></i></span> Create
                                polls<br>
                                <span class="icon-a"><i class="fa fa-caret-right" aria-hidden="true"></i></span> Set
                                agenda and "News of the Day"<br>
                                <span class="icon-a"><i class="fa fa-caret-right" aria-hidden="true"></i></span>
                                Interact with politicians<br>
                                <span class="icon-a"><i class="fa fa-caret-right" aria-hidden="true"></i></span> Create
                                private forums for focused debate and invite other users <br>
                                <span class="icon-a"><i class="fa fa-caret-right" aria-hidden="true"></i></span>
                                $4.99/month </p>
                        </div>
                    </div>
                    <!-- div class="form-group">
                        <div class="radio radio-danger vikas">
                            <input type="radio" id="radio22" name="radio6">
                            <label for="radio22" class="new-label"> Pay with PayPal</label>
                            <br>
                            <input type="radio" id="radio23" name="radio6">
                            <label for="radio23" class="new-label"> Pay with Credit Card</label>
                        </div>
                    </div -->
                    <div class="form-group">
                        <!-- div class="col-md-12">
                            <button class="pr-submit">MEMBER STATUS
                                <span>
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </span>
                            </button>
                        </div -->
                        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif"
                               border="0" name="submit"
                               alt="PayPal - The safer, easier way to pay online!">
                        <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1"
                             height="1">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php } */ ?>
<script type="text/javascript">
    $(function () {
        
        $("#uploadProfileForm").on('submit', (function (e) {
            
            $.ajax({
                url: SITE_URL + "/users/change-profile-image",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                enctype: 'multipart/form-data',
                success: function (resp) {
                    var response = JSON.parse(resp);
                    if (response.code == 200) {
                        window.location.reload();
                        //$().showFlashMessage("success", response.message);
                        //updateSession(response.data);
                    } else {
                        // $().showFlashMessage("error", response.message);
                    }
                    
                },
                complete: function () {
                }
            });
            return false;
        }));
        
        $("#editProfileForm").validate({
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
                state: {
                    required: true
                },
                city: {
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
                state: {
                    required: "Please enter your state."
                },
                city: {
                    required: "Please enter your city."
                }
            }
        });
    
        $('.user_type').click(function () {
            var type = $(this).val();
            var url = "<?= SITE_URL?>/users/private-citizen-api/<?= $authUser['id']; ?>/";
            $('#returnUrl').val(url + type);
        });
    });
</script>
