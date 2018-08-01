<div class="users view large-9 medium-8 columns content">
    <h3><img src="<?= PROFILE_IMAGE_PATH .  $user->profile_image ?>" width="150"/> <?= h($user->first_name) ?> <?= h($user->last_name) ?></h3>
    <table class="vertical-table table">
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= h($user->city) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= h($user->state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= date( SHORT_DATE, strtotime($user->created)) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
        </tr>
        <tr>
            <th scope="row"><?= __('Registration Steps Done') ?></th>
            <td><?= $user->registration_steps_done ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $user->active ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row">&nbsp;</th>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th scope="row">&nbsp;</th>
            <td><a href="<?= $this->request->referer() ?>" class="btn btn-danger" style="float: left; margin-left: 20px;">Back</a></td>
        </tr>
    </table>
</div>
