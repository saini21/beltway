<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Articles'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Article Comments'), ['controller' => 'ArticleComments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Article Comment'), ['controller' => 'ArticleComments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Article Likes'), ['controller' => 'ArticleLikes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Article Like'), ['controller' => 'ArticleLikes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="articles form large-9 medium-8 columns content">
    <?= $this->Form->create($article) ?>
    <fieldset>
        <legend><?= __('Add Article') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('title');
            echo $this->Form->control('content');
            echo $this->Form->control('like_count');
            echo $this->Form->control('comment_count');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
