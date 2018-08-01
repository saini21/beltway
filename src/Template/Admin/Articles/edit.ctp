<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav breadcrumb">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Articles'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="articles form large-9 medium-8 columns content">
    <?= $this->Form->create($article) ?>
    <fieldset>
        <legend><?= __('Edit Article') ?></legend>
        <div class="row">
            <div class="col-lg-1">&nbsp;</div>
            <div class="col-lg-8">
                <?php
                echo $this->Form->control('title', ['class' => 'form-control']);
                echo $this->Form->control('content', ['type' => 'textarea', 'class' => 'form-control']);
                ?>
            </div>
        </div>
    </fieldset>
    <br />
    <div class="row">
        <div class="col-lg-1">&nbsp;</div>
        <div class="col-lg-8 ">
            <?= $this->Form->button(__('Update'), ['class' => 'btn btn-success', 'style' => 'float: left;']) ?>
            <a href="<?= $this->Url->build(['controller' => 'Articles', 'action' => 'index']) ?>" class="btn btn-danger"
               style="float: left; margin-left: 20px;">Cancel</a>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>
