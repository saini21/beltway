<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Politicians') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table">
        <thead>
        <tr>
            <th scope="col"><?= _('Profile') ?></th>
            <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('last_name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('email') ?></th>
            <th scope="col"><?= $this->Paginator->sort('non_governmental_email') ?></th>
            <th scope="col"><?= $this->Paginator->sort('city') ?></th>
            <th scope="col"><?= $this->Paginator->sort('state') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><img src="<?= PROFILE_IMAGE_PATH .  $user->profile_image ?>" width="50"/></td>
                <td><?= h($user->first_name) ?></td>
                <td><?= h($user->last_name) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->non_governmental_email) ?></td>
                <td><?= h($user->city) ?></td>
                <td><?= h($user->state) ?></td>
                <td><?= date( SHORT_DATE, strtotime($user->created)) ?></td>
                <td><?= date( SHORT_DATE, strtotime($user->modified)) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'politician', $user->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'editPolitician', $user->id]) ?>
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
