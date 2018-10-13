<header>
    <div class="col-md-5">
        <div class="logo">
            <a href="<?= SITE_URL ?>" title="index">
                <?= $this->Html->image('logo.png', ['alt' =>SITE_TITLE]);  ?>
            </a>
        </div>
    </div>
    <div class="col-md-7">
        <nav id="top-nav" class="inner-nav">
            <ul>
                <li><a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'contactUs']); ?>">Contact us</a></li>
                <li><a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'aboutUs']); ?>">About</a></li>
                <li><a href="javascript:void(0);"><?= strlen($authUser['first_name']) <= 9 ? $authUser['first_name'] : substr($authUser['first_name'],0,8) .".." ?> <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                    <ul>
                        <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'profile']); ?>">Profile</a></li>
                        <!-- li><a href="<?= $this->Url->build(['controller' => 'Polls', 'action' => 'index']); ?>">My Polls</a></li -->
                        <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']); ?>">Logout</a></li>
                    </ul>
                </li>
                <li><a href="<?= $this->Url->build(['controller' => 'Articles', 'action' => 'platform']); ?>">Platform</a></li>
            </ul>
        </nav>
    </div>
</header>
