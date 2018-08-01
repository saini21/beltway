<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Article'), ['action' => 'edit', $article->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Article'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Articles'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Article'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Article Comments'), ['controller' => 'ArticleComments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Article Comment'), ['controller' => 'ArticleComments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Article Likes'), ['controller' => 'ArticleLikes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Article Like'), ['controller' => 'ArticleLikes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="articles view large-9 medium-8 columns content">
    <h3><?= h($article->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $article->has('user') ? $this->Html->link($article->user->id, ['controller' => 'Users', 'action' => 'view', $article->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($article->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($article->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Like Count') ?></th>
            <td><?= $this->Number->format($article->like_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($article->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($article->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $article->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Content') ?></h4>
        <?= $this->Text->autoParagraph(h($article->content)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Article Comments') ?></h4>
        <?php if (!empty($article->article_comments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Comment') ?></th>
                <th scope="col"><?= __('Article Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($article->article_comments as $articleComments): ?>
            <tr>
                <td><?= h($articleComments->id) ?></td>
                <td><?= h($articleComments->comment) ?></td>
                <td><?= h($articleComments->article_id) ?></td>
                <td><?= h($articleComments->user_id) ?></td>
                <td><?= h($articleComments->status) ?></td>
                <td><?= h($articleComments->created) ?></td>
                <td><?= h($articleComments->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ArticleComments', 'action' => 'view', $articleComments->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ArticleComments', 'action' => 'edit', $articleComments->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ArticleComments', 'action' => 'delete', $articleComments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $articleComments->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Article Likes') ?></h4>
        <?php if (!empty($article->article_likes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Article Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($article->article_likes as $articleLikes): ?>
            <tr>
                <td><?= h($articleLikes->id) ?></td>
                <td><?= h($articleLikes->article_id) ?></td>
                <td><?= h($articleLikes->user_id) ?></td>
                <td><?= h($articleLikes->created) ?></td>
                <td><?= h($articleLikes->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ArticleLikes', 'action' => 'view', $articleLikes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ArticleLikes', 'action' => 'edit', $articleLikes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ArticleLikes', 'action' => 'delete', $articleLikes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $articleLikes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
