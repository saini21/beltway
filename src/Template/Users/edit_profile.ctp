<?=
$this->Html->script(['app']);
?>
<?php $this->assign('title', __('Edit Profile')); ?>
<?php $url = [ 'controller' => 'Users', 'action' => 'updateSession'] ?>
<div class="user-main-section">
    <div class="edit-user-image">

        <div class="profile-left-side-section">
            <?= $this->Form->create($user, ['url' => ['controller' => 'Users', 'action' => 'changeProfileImage', 'prefix' => API_VERSION], 'id' => 'upload_profile_form', 'enctype' => 'multipart/form-data']) ?>
            <span class="image-user-edit" id="image-user-edit">
                <?= $this->element('profile-image', ['width' => 117, 'height' => 117]) ?> 
                <a href="javascript:void(0)" class="plus-icon-edit" id="upload_profile">
                    <input type="file" name="profile_image" id="profile_image" onChange="showPreview(this);">
                </a>
            </span>
            <?= $this->Form->end() ?>
            <h2>@<?= $user->username ?></h2>
            <em><?= __($user->address) ?></em>
            <p class="stars_rate"><span class="stars"><span id="set_rating"></span></span></p>
        </div>

        <div class="subscribers-outer">
            <div class="subscribers-inner">
                <span class="subscribers-image"><?= $this->Html->image('subscribers-icon.png', ['alt' => 'Subscribers Image']) ?></span>
                <em><?= __(count($user->user_subscriptions) . ' Subscribers') ?></em>
            </div>
            <div class="subscribers-inner">
                <span class="subscribers-image"><?= $this->Html->image('videos.png', ['alt' => 'videos Image']) ?></span>
                <em><?= __(count($user->videos) . ' Videos') ?></em>
            </div>
            <div class="subscribers-inner">
                <span class="subscribers-image"><?= $this->Html->image('subscribed.png', ['alt' => 'Subscribed Image']) ?></span>
                <em><?= __(count($user->hashtag_subscriptions) . ' Subscribed') ?></em>
            </div>
        </div>

    </div>
</div>
<div class="edit-main">
    <div class="danger" id="success_msg" style="display:none;"></div>
    <?= $this->Form->create($user, ['url' => ['controller' => 'Users', 'action' => 'edit', 'prefix' => API_VERSION], 'id' => 'edit_profile_form']) ?>

    <div class="row">
        <div class="col-md-3 profile-input-row">
            <label class="required"><?= __('Name') ?></label>
            <?= $this->Form->input('name', array('class' => 'form-control', 'label' => false)); ?>
        </div>
        <div class="col-md-3 profile-input-row">
            <label class="required"><?= __('Username') ?></label>
            <?= $this->Form->input('username', array('class' => 'form-control', 'label' => false)); ?>
        </div>
        <div class="col-md-3 profile-input-row">
            <label class="required"><?= __('Email') ?></label>
            <?= $this->Form->input('email', array('class' => 'form-control', 'label' => false)); ?>
        </div>
        <div class="col-md-3 profile-input-row"><?= $this->Form->input('address', array('class' => 'form-control')); ?></div>
    </div>
    <div class="row">
        <div class="col-md-3 profile-input-row"><?= $this->Form->input('password', ['class' => 'form-control', 'value' => "", 'required' => false]); ?></div>
        <div class="col-md-3 profile-input-row"><?= $this->Form->input('Verify Password', ['name' => 'verify_password', 'id' => 'verify_password', 'class' => 'form-control', 'type' => 'password']) ?></div>

        <div class="col-md-3 profile-input-row"><?= $this->Form->input('phone', array('class' => 'form-control')); ?></div>
        <div class="col-md-3 profile-input-row"><?= $this->Form->input('timezone', array('class' => 'form-control')); ?></div>
    </div>
    <div class="row">
        <div class="col-md-3 profile-input-row">
            <?php if (!empty($user['facebook_access_token'])) { ?>
                <a href="javascript:void(0);" class="btn btn-success" data-attr="Facebook" >Connected with Facebook - <?= $user['facebook_connected_name'] ?></a>
            <?php } else { ?>
                <?= $this->Html->link(__('Connect with Facebook'), ['controller' => 'Users', 'action' => 'facebookLogin'], ['class' => "btn btn-danger"]) ?>
            <?php } ?>
        </div>
        <div class="col-md-3 profile-input-row">
            <?php if (!empty($user['youtube_access_token'])) { ?>
                <a href="javascript:void(0);" class="btn btn-success" data-attr="GooglePlus">Connected with youTube - <?= $user['youtube_connected_name'] ?></a>
                
            <?php } else { ?>
                <?= $this->Html->link(__('Connect with YouTube'), ['controller' => 'Users', 'action' => 'youtubeLogin'], ['class' => "btn btn-danger"]) ?>
            <?php } ?>
        </div>
        <div class="col-md-3 profile-input-row">
            <?php if (!empty($user['twitter_oauth_token'])) { ?>
                <a href="javascript:void(0);" class="btn btn-success" data-attr="Twitter">Connected with Twitter - <?= $user['twitter_connected_name'] ?></a>
            <?php } else { ?>
                <?= $this->Html->link(__('Connect with Twitter'), ['controller' => 'Users', 'action' => 'twitterLogin'], ['class' => "btn btn-danger"]) ?>
            <?php } ?>
        </div>
        <div class="col-md-3 profile-input-row">
            <?php if (!empty($user['instagram_access_token'])) { ?>
                <a href="javascript:void(0);" class="btn btn-success" >Connected with Instagram - <?= $user['instagram_connected_name'] ?></a>
            <?php } else { ?>
                <?= $this->Html->link(__('Connect with Instagram'), ['controller' => 'Users', 'action' => 'instagramLogin'], ['class' => "btn btn-danger"]) ?>
            <?php } ?>
        </div>
    </div>
    <div class="login-button"> <?= $this->Form->button(__('Update Profile <em></em>'), ['id' => 'edit_profile_btn', 'class' => 'loader-btn']) ?></div>
    <?= $this->Form->end() ?>
</div>

<div id="flagModal" class="modal fade" role="dialog">
    <div class="modal-dialog flagModal">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">YouTube Connect</h4>
            </div>
            <div class="modal-body">
                <div class="form-group" id="flag-input">
                    <p>YouTube Connect feature is under development.</p>
                </div> 
            </div> 
            <div class="modal-footer modal-footer-flag">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<script>
    function showPreview(objFileInput) {
        if (objFileInput.files[0]) {

            var fileReader = new FileReader();
            fileReader.onload = function (e) {
                //~ $('#blah').attr('src', e.target.result);

                $(".user-menu-img").attr('src', e.target.result);
                $("#image-user-edit").css('opacity', '0.7');

            }
            fileReader.readAsDataURL(objFileInput.files[0]);
            //~ alert(HOOTY_API_ENDPOINT);
            //~ var form = $('#upload_profile_form').get(0);
            //~ var fd = new FormData(form);
            $("#upload_profile_form").submit();


        }
    }

    function updateSession(response) {
        $.ajax({
            url: "<?= $this->Url->build($url) ?>",
            type: "POST",
            data: {'response': response},
            success: function (res) {
                if (response.code = 200) {
                    console.log(res);

                }

            },
            complete: function () {
            }
        });
    }
    function showResponse(responseText, statusText, xhr, $form) {
        if (responseText.code == 200) {
            $("#edit_profile_btn").button('reset');
            $("#edit_profile_form").find(":input").filter(function () {
                return !this.value;
            }).attr("disabled", false);
            $().showFlashMessage("success", responseText.message);
            $("#successBox").addClass('blue-success');
        } else {
            $("#edit_profile_btn").button('reset');
            $("#edit_profile_form").find(":input").filter(function () {
                return !this.value;
            }).attr("disabled", false);
            $().showFlashMessage("error", responseText.message);
        }

    }

    $(document).ready(function () {
        var star_width = $(".stars").width();

        var star_cal = (star_width / 5) * "<?= $user->average_rating ?>";

        $("#set_rating").css('width', star_cal);
        var options = {
            // target element(s) to be updated with server response 
            // pre-submit callback 
            success: showResponse, // post-submit callback 

            // other available options: 
            //url:       url         // override for form's 'action' attribute 
            //type:      type        // 'get' or 'post', override for form's 'method' attribute 
            //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
            //clearForm: true        // clear all form fields after successful submit 
            //resetForm: true        // reset the form after successful submit 

            // $.ajax options can be used here too, for example: 
            //timeout:   3000 
        };
        1

        $("#upload_profile_form").on('submit', (function (e) {

            $.ajax({
                url: "<?= HOOTY_API_ENDPOINT ?>Users/changeProfileImage",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                enctype: 'multipart/form-data',
                success: function (response) {

                    if (response.code == 200) {
                        $().showFlashMessage("success", response.message);
                        updateSession(response.data);
                    } else {
                        $().showFlashMessage("error", response.message);
                    }

                },
                complete: function () {
                }
            });
            return false;
        }));
        
        
		$(".btn-success").on('click', (function (e) {
			if (confirm('Are you sure you want to disconnect from this social profile?')) {
			$.ajax({
					url: "<?= HOOTY_API_ENDPOINT ?>Users/disconnectSocialMedia",
					type: "POST",
					data: {'type': $(this).attr('data-attr') },					
					success: function (response) {
						if (response.code == 200) {
							 //$().showFlashMessage("success", 'You have successfully logout from this social profile.');							 					
							//$("#successBox").addClass('blue-success');														
						} else {
							//$().showFlashMessage("error", 'An error occured, Please try again later.');
							//window.location.href=window.location.href;
							//$("#successBox").addClass('blue-success');							
						}
						window.location.href=window.location.href;							
					},
					complete: function () {
					}
				});
			 } else {
				return false;
			 }
        }));
        

        $("#edit_profile_form").validate({
            rules: {
                email: {required: true, email: true},
                name: {required: true},
            },
            messages: {
                email: {required: "Please enter email.", email: "Please enter valid email."},
                name: {required: "Please enter name."},
            }
        });

        $(document).on("click", "#edit_profile_btn", function (e) {
            //~ e.preventDefault();
            //~ alert($.cookie("token"));
            //~ return false;
            if ($("#edit_profile_form").valid() == true) {
                $(this).button('loading');
                $("#edit_profile_form").find(":input").filter(function () {
                    return !this.value;
                }).attr("disabled", "disabled");
                $("#edit_profile_form").ajaxSubmit(options);
                return false;

            }

        });

    });
</script>

