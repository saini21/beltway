<div class="articles view large-9 medium-8 columns content">
    <h3><?= h($article->title) ?></h3>
    <table class="vertical-table table">
        <tr>
            <td scope="row" colspan="2"><?= $this->Text->autoParagraph(h($article->content)); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Likes') ?></th>
            <td><?= $this->Number->format($article->like_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Comments') ?></th>
            <td><?= $this->Number->format($article->comment_count) ?></td>
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
    <div class="related">
        <h4><?= __('Comments') ?></h4>
        <?php if (!empty($article->article_comments)): ?>
            <table cellpadding="0" cellspacing="0" class="table">
                <tr>
                    <th scope="col"><?= __('Comment By') ?></th>
                    <th scope="col"><?= __('Comment') ?></th>
                    <th scope="col"><?= __('Comment At') ?></th>
                </tr>
                <?php foreach ($article->article_comments as $articleComments): ?>
                    <tr>
                        <?php if ($articleComments->user['role'] == "Politician") { ?>
                            <td>
                               
                               <a href="<?= $this->Url->build(['controller'=>'Users', 'action'=>'politician', $articleComments->user['id']]) ?>"> <?= $articleComments->user['first_name'] ?> <?= $articleComments->user['last_name'] ?>
                               </a>
                            </td>
                        <?php } else { ?>
                            <td>
                                <a href="<?= $this->Url->build(['controller'=>'Users', 'action'=>'privateCitizen', $articleComments->user['id']]) ?>">
                                    <?= $articleComments->user['first_name'] ?> <?= $articleComments->user['last_name'] ?>
                                </a>
                            </td>
                        <?php } ?>
                        <td><?= h($articleComments->comment) ?></td>
                        <td><?= date(SHORT_DATE, strtotime($articleComments->created)) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <a href="<?= $this->request->referer() ?>" class="btn btn-danger" style="float: left; margin-left: 20px;">Back</a>
        </div>
    </div>
    
</div>
