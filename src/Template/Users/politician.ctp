<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php $this->assign('title', __('Forgot Password')); ?>

<div class="col-md-2">

</div>
<div class="col-md-8">
    <div class="pc">
        <h4>Politician</h4>
        <div class="form-part-one pulbox">
            <div class="row" style="margin: -20px 10px 30px -15px ">
                <div class="col-lg-11 "><h5> Credentials </h5></div>
                <div class="col-lg-1 right-align">
                    <a class="btn btn-danger right-align" title="Skip"
                       href="<?= $this->Url->build(['controller' => 'Articles', 'action' => 'platform']); ?>">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            
            <?php if (!empty($this->request->session()->read('Auth.User.profile_image')) && $this->request->session()->read('Auth.User.profile_image') != "default-user.png") { ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <?= $this->Html->image(
                                '/files/Users/profile_image/' . $authUser['profile_image'], ['width' => 80, 'height' => 80, 'class' => 'user-menu-img', 'title' => $authUser['first_name']]); ?>
                        </div>
                        <div class="col-lg-9">
                            <form class="newemail-form" id="nonGovernmentalEmailForm" action="Javascript:void(0)">
                                
                                <div class="col-md-9">
                                    <label>Non-governmental email address</label>
                                    <input type="text" style="height:40px" class="form-control"
                                           id="nonGovernmentalEmail" name="non_governmental_email"
                                           placeholder="Email Address"
                                           value="<?= empty($authUser['non_governmental_email']) ? '' : $authUser['non_governmental_email'] ?>"/>
                                    <label for="nonGovernmentalEmail" class="error"
                                           style="margin: 10px 0 0 5px; display: none;">Please enter valid
                                        email.</label>
                                </div>
                                <div class="col-md-3" id="emailSaved" style="display: none;">
                                    <i class="fa fa-check" style="margin: 30px 0 0 0; color:#63bd5c; font-size: 30px;"
                                       title="Saved"></i>
                                </div>
                            
                            
                            </form>
                        </div>
                    </div>
                </div>
            
            <?php } else { ?>
                <form class="img-form" id="uploadProfileForm"
                      action="<?= $this->Url->build(['controller' => 'Users', 'action' => 'changeProfileImage']); ?>"
                      enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-3"><label class="upimage">Upload Image</label></div>
                            <div class="col-lg-3"><input type="file" class="custom-file-upload" name="profile_image">
                            </div>
                            <div class="col-lg-6" style="text-align: right">
                                <input type="submit" style="margin:-10px 0 0 0px; float: right;" class="upload"
                                       value="Upload File">
                            </div>
                        </div>
                    </div>
                </form>
                <form class="newemail-form" id="nonGovernmentalEmailForm" action="Javascript:void(0)">
                    <div class="form-group newemail">
                        <div class="col-md-9">
                            <label>Non-governmental email address</label>
                            <input type="text" style="height:40px" class="form-control" id="nonGovernmentalEmail"
                                   name="non_governmental_email" placeholder="Email Address"
                                   value="<?= empty($authUser['non_governmental_email']) ? '' : $authUser['non_governmental_email'] ?>"/>
                            <label for="nonGovernmentalEmail" class="error"
                                   style="margin: 10px 0 0 5px; display: none;">Please enter valid email.</label>
                        </div>
                        <div class="col-md-3" id="emailSaved" style="display: none;">
                            <i class="fa fa-check" style="margin: 30px 0 0 0; color:#63bd5c; font-size: 30px;"
                               title="Saved"></i>
                        </div>
                    </div>
                
                </form>
            
            <?php } ?>
            
            
            <h5> Membership <br> <br></h5>
            
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="on0" value="Member Status">
                <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
                <input type="text" name="return" id="returnUrl" value="<?= SITE_URL?>/users/politician-api/?uid=<?= $authUser['id']; ?>&type=Politician">
                <div class="form-group">
                    <div class="radio radio-danger vikas">
                        <input type="radio" class="user_type" name="os0" value="Politician" checked="checked">
                        <label for="radio20" class="new-label"> Politician</label>
                        <p><span class="icon-a"><i class="fa fa-caret-right" aria-hidden="true"></i></span> Access to
                            platform<br>
                            <span class="icon-a"><i class="fa fa-caret-right" aria-hidden="true"></i></span> Monitor all
                            posts<br>
                            <span class="icon-a"><i class="fa fa-caret-right" aria-hidden="true"></i></span> Interact
                            with electorate (citizens must pay extra fee)<br>
                            <span class="icon-a"><i class="fa fa-caret-right" aria-hidden="true"></i></span>
                            $49.99/month</p>
                        <br>
                    </div>
                </div>
                <!-- div class="form-group">
                    <div class="radio radio-danger vikas">
                        <input type="radio" id="radio22" name="radio8">
                        <label for="radio22" class="new-label"> Pay with PayPal</label>
                        <br>
                        <input type="radio" id="radio23" name="radio8">
                        <label for="radio23" class="new-label"> Pay with Credit Card</label>
                    </div>
                </div -->
                <div class="form-group">
                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif"
                           border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1"
                         height="1">
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        
        $('#nonGovernmentalEmail').blur(function () {
            $('#nonGovernmentalEmailForm').submit();
        });
        
        if (typeof userDetail == "object") {
            $.each(userDetail, function (i, key) {
                $('input[name="' + i + '"][value="' + key + '"]').attr('checked', 'checked');
            });
        }
        
        $("#nonGovernmentalEmailForm").validate({
            rules: {
                non_governmental_email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                non_governmental_email: {
                    required: 'Please enter email.',
                    email: 'Please enter valid email.'
                }
            },
            submitHandler: function (form) {
                $.ajax({
                    url: SITE_URL + "/users/non-governmental-email-api",
                    type: "POST",
                    data: $("#nonGovernmentalEmailForm").serialize(),
                    dataType: "json",
                    success: function (response) {
                        if (response.code == 200) {
                            $('#emailSaved').fadeIn();
                        } else {
                            $().showFlashMessage("error", response.message);
                            $('#resetPasswordBtn').button('<Reset Password <em></em>');
                        }
                    },
                    complete: function () {
                    }
                });
                
                //$("#memberStatus").attr("disabled", "disabled");
                return false;
            }
        });
        
        $('.user_type').click(function () {
            var type = $(this).val();
            var url = "<?= SITE_URL?>/users/private-citizen-api/?uid=<?= $authUser['id']; ?>&type=";
            $('#returnUrl').val(url + type);
        });
        
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
    });
</script>
