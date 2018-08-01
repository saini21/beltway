<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ArticleComment $articleComment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Article Comment'), ['action' => 'edit', $articleComment->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Article Comment'), ['action' => 'delete', $articleComment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $articleComment->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Article Comments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Article Comment'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Articles'), ['controller' => 'Articles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Article'), ['controller' => 'Articles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="articleComments view large-9 medium-8 columns content">
    <h3><?= h($articleComment->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Article') ?></th>
            <td><?= $articleComment->has('article') ? $this->Html->link($articleComment->article->title, ['controller' => 'Articles', 'action' => 'view', $articleComment->article->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $articleComment->has('user') ? $this->Html->link($articleComment->user->id, ['controller' => 'Users', 'action' => 'view', $articleComment->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($articleComment->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($articleComment->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($articleComment->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $articleComment->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($articleComment->comment)); ?>
    </div>
</div>
