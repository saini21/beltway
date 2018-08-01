<div class="polls form large-9 medium-8 columns content">
    <?= $this->Form->create($poll) ?>
    <fieldset>
        <legend><?= __('Edit Poll') ?></legend>
        <div class="row">
            <div class="col-lg-1">&nbsp;</div>
            <div class="col-lg-8">
                <?php
                echo $this->Form->control('topic', ['class' => 'form-control']);
                echo $this->Form->control('question', ['type' => 'textarea', 'class' => 'form-control']);
                echo $this->Form->control('answer1', ['class' => 'form-control']);
                echo $this->Form->control('answer2', ['class' => 'form-control']);
                echo $this->Form->control('answer3', ['class' => 'form-control']);
                echo $this->Form->control('answer4', ['class' => 'form-control']);
                ?>
            </div>
        </div>
    </fieldset>
    <br/>
    <div class="row">
        <div class="col-lg-1">&nbsp;</div>
        <div class="col-lg-8 ">
            <?= $this->Form->button(__('Update'), ['class' => 'btn btn-success', 'style' => 'float: left;']) ?>
            <a href="<?= $this->Url->build(['controller' => 'Polls', 'action' => 'index']) ?>" class="btn btn-danger"
               style="float: left; margin-left: 20px;">Cancel</a>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>
