<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit Politician') ?></legend>
        <div class="row">
            <div class="col-lg-1">&nbsp;</div>
            <div class="col-lg-8">
                <?php
                echo $this->Form->control('first_name', ['class' => 'form-control']);
                echo $this->Form->control('last_name', ['class' => 'form-control']);
                echo $this->Form->control('email', ['class' => 'form-control']);
                echo $this->Form->control('non_governmental_email', ['class' => 'form-control']);
                echo $this->Form->control('city', ['class' => 'form-control']);
                echo $this->Form->control('state', ['class' => 'form-control']);
                ?>
            </div>
        </div>
    </fieldset>
    <br/>
    <div class="row">
        <div class="col-lg-1">&nbsp;</div>
        <div class="col-lg-8 ">
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success', 'style'=>'float: left;']) ?>
            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'politicians']) ?>" class="btn btn-danger" style="float: left; margin-left: 20px;">Cancel</a>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>
