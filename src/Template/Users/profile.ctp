<h1><?= $authUser['first_name']; ?> <?= $authUser['last_name']; ?></h1>
<br />

    <form class="img-form" id="uploadProfileForm" action="<?= $this->Url->build(['controller' => 'Users', 'action' => 'changeProfileImage']); ?>"
          enctype="multipart/form-data">
        <div class="form-group">
            <div class="row">
                <div class="col-lg-1">
                    <?= $this->Html->image(
                    '/files/Users/profile_image/thumbnail-' . $authUser['profile_image'], ['width' => 80, 'height' => 80, 'class' => 'user-menu-img', 'title' => $authUser['first_name']]); ?>
                </div>
                <div class="col-lg-5">
                    <input type="file" class="custom-file-upload form-control" style="width: 200px; margin: 15px 0 0 0;" name="profile_image">
                    <input type="submit" style="margin:12px 0 0 0px; float: right;" class="upload" value="Update Profile Image">
                </div>
                <div class="col-lg-6" style="text-align: right"></div>
            </div>
        </div>
    </form>
        
        
        <br />
        <?= $this->Form->create($user, ['url' => ['controller' => 'Users', 'action' => 'editProfile'], 'id' => 'editProfileForm', 'class' => ""]) ?>
        <div class="form-group">
            <div class="col-md-6">
                <?= $this->Form->input('first_name', ['class' => 'form-control place-me',  'placeholder' => 'First Name']) ?>
            </div>
            <div class="col-md-6">
                <?= $this->Form->input('last_name', ['class' => 'form-control place-me',  'placeholder' => 'Last Name']) ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <?= $this->Form->input('email', ['class' => 'form-control place-me', 'type' => 'text',  'placeholder' => 'Email']) ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <?= $this->Form->input('state', ['class' => 'form-control place-me',  'placeholder' => 'State']) ?>
            </div>
            <div class="col-md-6">
                <?= $this->Form->input('city', ['class' => 'form-control place-me',  'placeholder' => 'City']) ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <?= $this->Form->input('password', ['class' => 'form-control place-me',  'placeholder' => 'Password']) ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <?= $this->Form->button(__('UPDATE'), ['id' => 'registerBtn', 'class' => "btn btn-success btn-lg"]) ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
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
                },first_name: {
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
    
        
    });
</script>
