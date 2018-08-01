<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                
                <?= $this->Html->image(SITE_URL . $this->request->session()->read('Auth.User.profile_image'), ['class' => 'img-circle', 'alt' => __('User Image')]) ?>
            </div>
            <div class="pull-left info">
                <p><?= $this->request->session()->read('Auth.User.name') ?></p>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header"><?= __('MAIN NAVIGATION') ?></li>
            <li class="<?= $this->request->controller == 'Admins' && $this->request->action == 'dashboard' ? 'active' : '' ?>">
                <?=
                $this->Html->link(
                    '<i class="fa fa-dashboard"></i><span>' . __('Dashboard') . '</span>', ['controller' => 'Admins', 'action' => 'dashboard'], ['escape' => false, 'title' => __('Dashboard')]
                )
                ?>
            </li>
            <li class="<?= $this->request->controller == 'Users' && (strpos(strtolower($this->request->action), 'politician') !== false) ? 'active' : '' ?>">
                <?=
                $this->Html->link(
                    '<i class="fa fa-user"></i><span>' . __('Politician') . '</span>', ['controller' => 'Users', 'action' => 'politicians'], ['escape' => false, 'title' => __('Politician')]
                )
                ?>
            </li>
            <li class="<?= ($this->request->controller == 'Users' && (strpos(strtolower($this->request->action), 'private') !== false)) ? 'active' : '' ?>">
                <?=
                $this->Html->link(
                    '<i class="fa fa-group"></i><span>' . __('Private Citizen') . '</span>', ['controller' => 'Users', 'action' => 'privateCitizens'], ['escape' => false, 'title' => __('Private Citizen')]
                )
                ?>
            </li>
            <li class="<?= ($this->request->controller == 'Polls' || $this->request->action == 'index') ? 'active' : '' ?>">
                <?=
                $this->Html->link(
                    '<i class="fa fa-hand-pointer-o"></i><span>' . __('Active Polls') . '</span>', ['controller' => 'Polls', 'action' => 'index'], ['escape' => false, 'title' => __('Active Polls')]
                )
                ?>
            </li>
            <li class="<?= ($this->request->controller == 'Articles' || $this->request->action == 'index') ? 'active' : '' ?>">
                <?=
                $this->Html->link(
                    '<i class="fa fa-list-alt"></i><span>' . __('Agendas') . '</span>', ['controller' => 'Articles', 'action' => 'index'], ['escape' => false, 'title' => __('Agendas')]
                )
                ?>
            </li>
            <li class="<?= ($this->request->controller == 'Subscriptions' || $this->request->action == 'index') ? 'active' : '' ?>">
                <?=
                $this->Html->link(
                    '<i class="fa fa-money"></i><span>' . __('Subscriptions') . '</span>', ['controller' => 'Subscriptions', 'action' => 'index'], ['escape' => false, 'title' => __('Agendas')]
                )
                ?>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
