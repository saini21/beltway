<div class="articles index large-9 medium-8 columns content">
    <h3><?= __('Articles') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('like_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('comment_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
            <tr>
                <td><?= h($article->title) ?></td>
                <td><?= $this->Number->format($article->like_count) ?></td>
                <td><?= $this->Number->format($article->comment_count) ?></td>
                <td><a href="javascript:void(0);" class="change_status"
                       data-id="<?= $article->id ?>"><?= ($article->status) ? "Enabled" : "Disabled" ?></a></td>
                <td><?= date( SHORT_DATE, strtotime($article->created)) ?></td>
                <td><?= date( SHORT_DATE, strtotime($article->modified)) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $article->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $article->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
<script>
    $(function () {
        
        $('.change_status').click(function () {
            var _this = $(this);
            var id = _this.attr('data-id');
            
            $.getJSON(SITE_URL + '/admin/articles/changeStatus/' + id, function (response) {
                _this.html(response.status);
            });
        });
    });
</script>
