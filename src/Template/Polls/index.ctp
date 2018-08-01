<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav breadcrumb">
        <li><?= $this->Html->link(__('Create Poll'), ['action' => 'create']) ?> </li>
        <li><?= $this->Html->link(__('Exit Polling'), ['action' => 'exitPolling']) ?> </li>
    </ul>
</nav>
<div class="polls index large-9 medium-8 columns content">
    <h3><?= __('My Polls') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('topic') ?></th>
            <th scope="col"><?= $this->Paginator->sort('question') ?></th>
            <th scope="col"><?= $this->Paginator->sort('status') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created', 'Created At') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($polls as $poll): ?>
            <tr>
                <td><?= $this->Number->format($poll->id) ?></td>
                <td><?= h($poll->topic) ?></td>
                <td><?= h($poll->question) ?></td>
                <td><a href="javascript:void(0);" class="change_status"
                       data-id="<?= $poll->id ?>"><?= ($poll->status) ? "Enabled" : "Disabled" ?></a></td>
                <td><?= date(SHORT_DATE, strtotime($poll->created)) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $poll->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $poll->id]) ?>
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
            
            $.getJSON(SITE_URL + '/polls/change-status/' + id, function (response) {
                _this.html(response.status);
            });
        });
    });
</script>
