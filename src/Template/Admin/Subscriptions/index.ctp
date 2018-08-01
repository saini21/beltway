<div class="subscriptions index large-9 medium-8 columns content">
    <h3><?= __('Subscriptions') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('user_id', 'User') ?></th>
            <th scope="col"><?= $this->Paginator->sort('role') ?></th>
            <th scope="col"><?= $this->Paginator->sort('user_type') ?></th>
            <th scope="col"><?= $this->Paginator->sort('price') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($subscriptions as $subscription): ?>
            <tr>
                <td><?= $subscription->user->first_name . ' ' . $subscription->user->last_name ?></td>
                <td><?= h($subscription->role) ?></td>
                <td><?= h($subscription->user_type) ?></td>
                <td><?= h($subscription->price) ?></td>
                <td><?= h($subscription->created) ?></td>
                <td><?= h($subscription->modified) ?></td>
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
