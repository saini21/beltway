<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ArticleLike $articleLike
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $articleLike->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $articleLike->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Article Likes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Articles'), ['controller' => 'Articles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Article'), ['controller' => 'Articles', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="articleLikes form large-9 medium-8 columns content">
    <?= $this->Form->create($articleLike) ?>
    <fieldset>
        <legend><?= __('Edit Article Like') ?></legend>
        <?php
            echo $this->Form->control('article_id', ['options' => $articles]);
            echo $this->Form->control('user_id', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
