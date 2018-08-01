
<?php $this->assign('title', __('Profile')) ?>
<section class="content-header">
    <h1>
        <?= __('Admin') ?>
        <small><?= __('Profile') ?></small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="profile-main-section">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Edit Profile') ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?= $this->Form->create($admin, ['enctype' => 'multipart/form-data']) ?>
                <div class="box-body">
                    <div class="form-group">
                        <label class="required"><?= __('Name') ?></label>
                        <?= $this->Form->control('name', ['class' => 'form-control', 'placeholder' => 'Name', 'label' => false, 'required'=>false]) ?>
                    </div>
                    <div class="form-group">
                        <label class="required"><?= __('Email') ?></label>
                        <?= $this->Form->control('email', ['class' => 'form-control', 'placeholder' => 'Email', 'label' => false, 'required'=>false, 'type' => 'email']) ?>
                    </div>
                    <div class="form-group">
                        <label><?= __('Password') ?></label>
                        <?= $this->Form->control('password', ['value'=>"",'class' => 'form-control', 'placeholder' => 'Password', 'label' => false, 'required' => false]) ?>
                    </div>
                    <div class="form-group">
                        <label><?= __('Phone') ?></label>
                        <?= $this->Form->control('phone', ['class' => 'form-control', 'placeholder' => 'Phone', 'label' => false, 'required'=>false]) ?>
                    </div>
                     <div class="form-group profile-image">
                        <label><?= __('Profile Image') ?></label>                      
                        <div class="fileinput fileinput-new" data-provides="fileinput">
							<span class="btn btn-default btn-file"><span>Choose file</span><input type="file" name="profile_image" class="form-control" id="profile-image" /></span>
							<span class="fileinput-filename"></span><span class="fileinput-new">No file chosen</span>
						</div>
                        <?php if ($admin->profile_image == 'admin-default.png') { ?>
                        <?php } else { ?>
							<?php  if(!empty($admin->profile_image)) { ?>
                            <?= $this->Form->button(__('Delete Profile Image'), ['type' => 'button', 'class' => 'btn btn-danger', 'id'=>'profile_delete', 'data-attr'=>$admin->id]) ?>
                        <?php } } ?>
                        <?php if(!empty($admin->profile_image) && !is_array($admin->profile_image)){ ?>
                        <?= $this->Html->image('/files/Admins/profile_image/' . $admin->profile_image, ['alt' => __('Profile image will display here.'), 'width' => '180']) ?>
                        <?php } ?>
                        <p class="help-block"><?= __('Only these files extension are allowed: .png , .jpeg and .jpg') ?></p>
                    </div>

                </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <?= $this->Form->button(__('Submit'),['class' => 'btn btn-primary']) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col (left) -->
    </div>
    <!-- /.row -->
</section>

