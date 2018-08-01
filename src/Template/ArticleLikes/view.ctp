<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ArticleLike $articleLike
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Article Like'), ['action' => 'edit', $articleLike->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Article Like'), ['action' => 'delete', $articleLike->id], ['confirm' => __('Are you sure you want to delete # {0}?', $articleLike->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Article Likes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Article Like'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Articles'), ['controller' => 'Articles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Article'), ['controller' => 'Articles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="articleLikes view large-9 medium-8 columns content">
    <h3><?= h($articleLike->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Article') ?></th>
            <td><?= $articleLike->has('article') ? $this->Html->link($articleLike->article->title, ['controller' => 'Articles', 'action' => 'view', $articleLike->article->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $articleLike->has('user') ? $this->Html->link($articleLike->user->id, ['controller' => 'Users', 'action' => 'view', $articleLike->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($articleLike->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($articleLike->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($articleLike->modified) ?></td>
        </tr>
    </table>
</div>
