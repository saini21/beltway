<header>
    <div class="row">
        <div class="col-md-4">
            <div class="logo">
                <a href="<?= SITE_URL ?>" title="index">
                    <?= $this->Html->image('logo.png', ['alt' => SITE_TITLE]); ?>
                </a>
            </div>
        </div>
        
        <div class="col-md-4" style="margin-top: 28px;">
            <?php if($this->request->params['action'] == 'platform') {  ?>
            <form action="javascript:void(0);">
                <div class="input-group  mb-3">
                    <input type="text" class="form-control" name="searchKey" id="searchKey"
                           placeholder="Search Articles ..." aria-label="Search Articles ..."
                           aria-describedby="basic-addon2">
                    <div class="input-group-addon">
                        <span class="input-group-text"><i class="fa fa-search"></i> </span>
                    </div>
                </div>
            </form>
            <?php } ?>
        </div>
        
        <div class="col-md-4">
            <nav id="top-nav" class="inner-nav">
                <ul>
                    <li><a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'contactUs']); ?>">Contact
                            us</a></li>
                    <li>
                        <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'aboutUs']); ?>">About</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><?= strlen($authUser['first_name']) <= 9 ? $authUser['first_name'] : substr($authUser['first_name'], 0, 8) . ".." ?>
                            <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        <ul>
                            <li>
                                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'profile']); ?>">Profile</a>
                            </li>
                            <!-- li><a href="<?= $this->Url->build(['controller' => 'Polls', 'action' => 'index']); ?>">My Polls</a></li -->
                            <li>
                                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']); ?>">Logout</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Articles', 'action' => 'platform']); ?>">Platform</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
